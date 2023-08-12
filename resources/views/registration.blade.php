<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password], select, input[type=file] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus, select, input[type=file] {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}



.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>
<div style="width:50%" class="container">
    @if (Session::has('status'))

        <div class="alert alert-success" role="alert">
            {{ Session::get('status') }}
        </div>

    @endif

<form action="{{ route('postregistration') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="image"><b>Image</b></label>
    <input type="file" name="image" id="image">


    <label for="usercode"><b>User Code</b></label>
    <input type="text" placeholder="Enter code"  name="usercode" value="{{ $usercode }}" id="usercode">

    <label for="username"><b>User Name</b></label>
    <input type="text" placeholder="Enter Name" name="username">

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email">

    <label for="department"><b>Department</b></label>
    <select class="form-control" name='department'>
        <option value="">Select Department</option>
        <option value="IT">IT Department</option>
        <option value="Admin">Admin Department</option>
        <option value="HR">HR Department</option>
        <option value="OtherDepartment">Other Department</option>
    </select>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password">

    <label for="password-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="password_repeat" id="password_repeat">


    <button type="submit" class="btn btn-primary form-control">Register</button>

  <div class="container signin">
    <p>Already have an account? <a href="{{ route('login') }}">Sign in</a>.</p>
  </div>
</form>
</div>
</body>
</html>
