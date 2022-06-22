<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="javascript:void(0)">CW CODE TEST</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse flex-grow-1 text-right" id="mynavbar">
        <ul class="navbar-nav ms-auto flex-nowrap">
            @if(!isset($login))   
            <li class="nav-item">
              <a class="nav-link" href="{{ URL::to('login') }}">Login</a>
            </li>
            @endif

            @if(!isset($register))
            <li class="nav-item">
              <a class="nav-link" href="{{ URL::to('register') }}">Register</a>
            </li>
            @endif  
        </ul>
      </div>
    </div>
  </nav>