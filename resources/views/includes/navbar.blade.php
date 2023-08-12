<nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route("home") }}">Logo</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="{{ route("home") }}">Home</a></li>
          {{-- <li><a href="{{ route('add.student') }}">Add-Student</a></li> --}}
          <li><a href="{{ route("student_list") }}">Student</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{ route('logout') }}"><span class="glyphicon glyphicon-log-in"></span> logout</a></li>
        </ul>
      </div>
    </div>
  </nav>
