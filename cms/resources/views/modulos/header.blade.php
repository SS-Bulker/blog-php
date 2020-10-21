<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
          <p class="nav-link" href="{{url('/')}}">
            @foreach($administradores as $element)

            @if($_COOKIE['email_login'] == $element->email)
              Hola, {{ $element->name}}
            @endif

            @endforeach
          </p>
        </li>

      <li class="nav-item">
      <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i>
        </a>
        <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
        @csrf
        </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->