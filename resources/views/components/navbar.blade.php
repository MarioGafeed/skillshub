<nav id="nav">
  <ul class="main-menu nav navbar-nav navbar-right">
    <li><a href="index.html">{{ __('web.home') }}</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{__('web.cats')}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      @foreach($cats As $cat)
                      <li><a href="{{ url("(categories/show/{$cat->id})") }}">
                        <!-- @if(App::getlocale() == "en")
                         {{  json_decode($cat->name)->en }}
                        @else
                         {{  json_decode($cat->name)->ar }}
                        @endif -->

                      {{ $cat->jname() }}
                       </a></li>
                      @endforeach
                    </ul>
                </li>
                <li><a href="contact.html">{{ __('web.contact') }}</a></li>
                <li><a href="login.html">{{ __('web.signin') }}</a></li>
                <li><a href="register.html">{{ __('web.signup') }} </a></li>

                @if (App::getlocale() == "en")
                  <li><a href=" {{ url('/lang/set/ar') }} ">عربي</a></li>
                @else
                  <li><a href="{{ url('/lang/set/en')  }}">EN</a></li>
                @endif


  </ul>
</nav>
