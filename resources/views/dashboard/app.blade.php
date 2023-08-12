@include('includes.header');
@include('includes.navbar');
<div class="container-fluid text-center">
  <div class="row content">
    @if (Session::has('status'))

        <div class="alert alert-success" role="alert">
            {{ Session::get('status') }}
        </div>

    @endif
    <div class="col-sm-8 text-left">
        <main class="container-fluid">
            @yield('content')
        </main>
    </div>

    </div>
  </div>
</div>
