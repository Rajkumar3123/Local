<?php
use App\Http\Controllers\MyController;
use Illuminate\Support\Facades\Route;
use App\Facade\FacadeFile;

//Testing for GIT I have done Changes in git

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'guest'], function()
{
    Route::get('/', function ()
    {
        return view('welcome');
       // return FacadeServiceProvider::getText();
    });

    Route::get('registration', [MyController::class, 'registration'])->name('register');

    Route::post('registration', [MyController::class, 'postRegistration'])->name('postregistration');

    Route::get('login', function () { return view('login'); })->name('login');

    Route::post('postlogin', [MyController::class, 'loginPost'])->name('postlogin');
});

Route::group(['middleware' => 'auth'], function()
{
    Route::post('handle.otp', [MyController::class, 'handleOtp'])->name('handle.otp');

    Route::get('logout', [MyController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'otp.check'], function()
{
    Route::get('home', function(){ return view('dashboard.app'); })->name('home');
    // Route::get('student-list', function(){ return view('project.student'); })->name('student_list');
    Route::get('student-list', [MyController::class, 'listStudent'])->name('student_list');
    Route::post('post.student', [MyController::class, 'studentDetails'])->name('post_student');
    Route::post('edit-student{studentlist}', [MyController::class, 'editStudent'])->name('edit_student');
    Route::get('remove{id}', [MyController::class, 'removeData'])->name('remove_data');
});


// Route::post('edit-student{studentlist?}', [MyController::class, 'editStudent'])->name('edit_student');
// if Question Mark is used it means optional
