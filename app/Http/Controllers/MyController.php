<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\otpModel;
use App\Models\StudentData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MyController extends Controller
{
    public function registration()
    {
        $usercode = rand(0000000,999999);
        //return view('registration', ['usercode'=>$usercode]);
        return view('registration', compact('usercode'));
    }

    public function postRegistration(Request $request)
    {
        $datavalidation = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:2050',
            'usercode' => 'required|integer|unique:users',
            'username' => 'required|string',
            'email' => 'required|email|unique:users',
            'department' => 'required|string',
            'password' => 'required|string|min:3|max:8|required_with:password_repeat|           same:password_repeat',
            'password_repeat' => 'required|string|min:3|max:8',
        ]);

        DB::beginTransaction();
        try
        {
            $userdata = new User;
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = $image->getClientOriginalName();
                $image->move('uploads', $filename);
            }
            $userdata->image = $filename;
            $userdata->usercode = $request->usercode;
            $userdata->name = $request->username;
            $userdata->email = $request->email;
            $userdata->department = $request->department;
            $userdata->password = Hash::make($request->password);
            $userdata->save(); // Eloquent ORM

            DB::commit();
            return redirect()->back()->with('status', 'Registration Successfully');
        }
        catch(Exception $error)
        {
            DB::rollback();
            return redirect()->back()->with('status', 'Registration Failed');
        }
    }

    public function loginPost(Request $request)
    {
        $userdata = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        //if(Auth::attempt(['email' => $email, 'password' => $password]))
        if(Auth::attempt($userdata))
        {
            $user = user::where('email', $request->email)->first();

            $otp = new otpModel;
            $otp->user_id = $user->id;
            $otp->otp = random_int(10000, 99999);
            $otp->save(); // Eloquent ORM
            return view('otp_view', ['chunme_otp' => $otp->otp]);
            // return redirect('home')->with('success', 'Login Success');
        }
        else
        {
            return redirect()->back()->with('status', 'Login Failed');
        }
    }

    public function handleOtp(Request $request)
    {
        $auth_user = auth()->user();
        $latest_otp = $auth_user->latestOtp();
        $user_otp = $request->otp;
        if($user_otp != NULL && $user_otp == $latest_otp->otp)
        {
            $latest_otp->update(['status' => 'verified']);
            $latest_otp->save();
            session(['isOtpVerified' => 'verified']);
            return redirect()->route('home');
        }
        else
        {
            Auth::logout();
            return redirect()->route('login');
        }
    }

    public function studentDetails(Request $request)
    {
        //dd($request);
        $datavalidation = $request->validate([
            'studentname' => 'required|string',
            'email' => 'required|email|unique:student_data',
            'department' => 'required|string',
        ]);

        DB::beginTransaction();
        try
        {
            $studentdata = new StudentData;
            $studentdata->studentname = $request->studentname;
            $studentdata->email = $request->email;
            $studentdata->department = $request->department;

            $studentdata->save(); // Eloquent ORM

            DB::commit();
            return redirect()->back()->with('status', 'Saved Successfully');
        }
        catch(Exception $error)
        {
            DB::rollback();
            return redirect()->back()->with('status', 'Registration Failed');
        }
        return $request;
    }

    public function listStudent()
    {
        //$studentdata = StudentData::where('studentname', '=', 'test')->get();
        $studentdata = StudentData::all();
        return view('project.student', ['studentlist'=>$studentdata]);
    }

    public function editStudent(Request $request, StudentData $studentlist)
    {
        $datavalidation = $request->validate([
            'studentname' => 'required|string',
            'email' => 'required|email|unique:student_data',
            'department' => 'required|string',
        ]);
        DB::beginTransaction();
        try
        {
            $studentlist->studentname = $request->studentname;
            $studentlist->email = $request->email;
            $studentlist->department = $request->department;
            $studentlist->save(); // Eloquent ORM

            DB::commit();
            return redirect()->back()->with('status', 'Updated Successfully');
        }
        catch(Exception $error)
        {
            DB::rollback();
            return redirect()->back()->with('status', 'Registration Failed');
        }
        return $request;
        //return $studentlist;
    }

    public function removeData(StudentData $id)
    {
        $id->delete();
        return redirect()->back()->with('status', 'Removed Successfully');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
