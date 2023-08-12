@extends('dashboard.app')
@section('content')
<div class="container">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Add Student Details
  </button>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('post_student') }}" method="POST">
                    @csrf
                    <label for="username"><b>Student Name</b></label>
                    <input type="text" placeholder="Enter Student Name" class="form-control" name="studentname">
                    @error('studentname')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>

                    @enderror
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" class="form-control" id="email">
                    @error('email')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                    <label for="department"><b>Department</b></label>
                    <select class="form-control" name='department'>
                        <option value="">Select Department</option>
                        <option value="IT">IT Department</option>
                        <option value="Admin">Admin Department</option>
                        <option value="HR">HR Department</option>
                        <option value="OtherDepartment">Other Department</option>
                    </select>
                    @error('department')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                    <br>
                    <button type="submit" class="btn btn-primary form-control">Register</button>
                </form>
            </div>

            </div>
        </div>
        </div>
  </div>


  <table class="table">
    <thead>
      <tr>
        <th>Studentname</th>
        <th>Email</th>
        <th>Department</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @forelse($studentlist as $studentlists)
      <tr>
        <td>{{ $studentlists->studentname }}</td>
        <td>{{ $studentlists->email }}</td>
        <td>{{ $studentlists->department }}</td>
        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editexampleModal_{{$studentlists->id}}">
            Edit Student Details
          </button></td>
        <td><a href="{{ route('remove_data', ['id'=>$studentlists->id]) }}">Delete</a></td>
      </tr>




      {{-- EDIT FORM MODEL --}}
      <div class="modal fade" id="editexampleModal_{{$studentlists->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('edit_student', ['studentlist'=>$studentlists->id]) }}" method="POST">
                    @csrf
                    <label for="username"><b>Student Name</b></label>
                    <input type="text" placeholder="Enter Student Name" class="form-control" name="studentname" value="{{$studentlists->studentname}}">
                    @error('studentname')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>

                    @enderror
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" class="form-control" id="email" value="{{$studentlists->email}}">
                    @error('email')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                    <label for="department"><b>Department</b></label>
                    <select class="form-control" name='department'>
                        <option value="">Select Department</option>
                        <option value="IT" {{ $studentlists->department=='IT' ? 'selected="selected"' : '' }}>IT Department</option>
                        <option value="Admin"{{ $studentlists->department=='Admin' ? 'selected="selected"' : '' }}>Admin Department</option>
                        <option value="HR"{{ $studentlists->department=='HR' ? 'selected="selected"' : '' }}>HR Department</option>
                        <option value="OtherDepartment"{{ $studentlists->department=='OtherDepartment' ? 'selected="selected"' : '' }}>Other Department</option>
                    </select>
                    @error('department')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                    <br>
                    <button type="submit" class="btn btn-primary form-control">Edit Student</button>
                </form>
            </div>

            </div>
        </div>
        </div>
  </div>
  {{-- END EDIT FORM MODEL --}}

  @empty
      <tr>
        <td colspan="3" style="text-align:center">No Data</td>
      </tr>

      @endforelse
    </tbody>
  </table>
</div>



@endsection
