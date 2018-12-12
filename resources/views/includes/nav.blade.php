<nav class="navbar navbar-expand-lg navbar-dark bg-dark animated fadeInDown" style="z-index: 1000 !important;">
  <div class="container">
    <a class="navbar-brand" href="#">{{ env('APP_NAME')}}</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
              <a class="nav-link" href="{{ url('feed') }}">Feed</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ url('websites') }}">Websites</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              @guest
                <i class="fa fa-user-times"></i>
              @else
                <i class="fa fa-user-check"></i>
                {{ Auth::user()->name }}
              @endguest
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @guest
                <a class="dropdown-item" href="{{ route('login') }}">Log in <i class="fa fa-lock-open float-right mt-1"></i></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('register') }}">Register <i class="fa fa-user float-right mt-1"></i></a>
              @else
                <a class="dropdown-item" href="#">Account <i class="fa fa-user float-right mt-1"></i></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Settings <i class="fa fa-cog float-right mt-1"></i></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                      Logout <i class="fa fa-lock float-right mt-1"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              @endguest

            </div>
          </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" method="GET" action="">
          <select name="category" id="category" class="form-control mr-sm-2">
              <option value="select">-- Select Category --</option>
              @isset($categories)
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                @endforeach
              @endisset
          </select>
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Select</button>
      </form>
    </div>
  </div>
</nav>