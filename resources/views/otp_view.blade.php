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

<form action="{{ route('handle.otp') }}" method="POST" autocomplete="off">
    @csrf
    <h1>Enter OTP</h1>
    <hr>
    {{ $chunme_otp }} <br>
    <label for="otp"><b>Enter OTP</b></label>
    <input type="number" placeholder="Enter OTP" name="otp" class="form-control">
    <br>
    <button type="submit" class="btn btn-primary form-control">OTP</button>

</form>
</div>
</body>
</html>
