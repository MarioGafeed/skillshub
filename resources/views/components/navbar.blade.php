<nav id="nav">
  <form id="logout-form" action="{{ url('/logout') }}" method="post" style="Display:None;">
    @csrf
  </form>

  <ul class="main-menu nav navbar-nav navbar-right">
    <li><a href="{{ url('/') }}">{{ __('web.home') }}</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{__('web.cats')}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      @foreach($cats As $cat)
                      <li><a href="{{ url("categories/show/{$cat->id}") }}">
                         @if(App::getlocale() == "en")
                         {{  json_decode($cat->name)->en }}
                        @else
                         {{  json_decode($cat->name)->ar }}
                        @endif -->

                      {{ $cat->jname() }}
                       </a></li>
                      @endforeach
                    </ul>
                </li>
                <li><a href="{{ url('/contact') }}">{{ __('web.contact') }}</a></li>

                @guest
                  <li><a href="{{ url('/login') }}">{{ __('web.signin') }}</a></li>
                  <li><a href="{{ url('/register') }}">{{ __('web.signup') }} </a></li>
                @endguest
                <!-- <input type="submit" name="" value="{{ __('web.signout') }}"> -->
                @auth

                @if(Auth::user()->role->name == 'student' )
                <li><a id="  " href="{{url('/profile')}}">{{ __('web.profile') }} </a></li>
                @else
                <li><a id="  " href="{{url('/dashboard')}}">{{ __('web.dashboard') }} </a></li>
                @endif
                  <li><a id="logout-link" href="#">{{ __('web.signout') }} </a></li>

                @endauth


                @if (App::getlocale() == "en")
                  <li><a href=" {{ url('/lang/set/ar') }} ">عربي</a></li>
                @else
                  <li><a href="{{ url('/lang/set/en')  }}">EN</a></li>
                @endif


  </ul>
</nav>
