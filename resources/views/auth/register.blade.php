@extends('web.layout')


@section('title')
 {{ __('web.signup') }}
@endsection

@section('section')

<!-- Hero-area -->
<div class="hero-area section">

  <!-- Backgound Image -->
  <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('web/img/page-background.jpg') }})"></div>
  <!-- /Backgound Image -->

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1 text-center">
        <ul class="hero-area-tree">
          <li><a href="{{ url('/') }}">{{ __('web.home') }}</a></li>
          <li>{{ __('web.signup') }}</li>
        </ul>
        <h1 class="white-text">{{ __('web.signup_estimate') }}</h1>

      </div>
    </div>
  </div>

</div>
<!-- /Hero-area -->

<!-- Contact -->
<div id="contact" class="section">

  <!-- container -->
  <div class="container">

    <!-- row -->
    <div class="row">

      <!-- login form -->
      <div class="col-md-6 col-md-offset-3">
        <div class="contact-form">
          <h4>{{ __('web.signup') }}</h4>

          @include('web.inc.messages')

          <form method="post" action="{{ url('/register') }}">
            @csrf            
            <input class="input" type="text" name="name" placeholder="{{ __('web.name') }}">
            <input class="input" type="text" name="phone" placeholder="{{ __('web.phone') }}">
            <input class="input" type="email" name="email" placeholder="{{ __('web.email') }}">            
            <input class="input" type="password" name="password" placeholder="{{ __('web.password') }}">
            <div>              
              <select name="city_id" id="city" class="form-control" required>
                  <option value="">Select City</option>
                  @foreach($cities as $city)
                      <option value="{{ $city->id }}">{{ $city->name }}</option>
                  @endforeach
              </select>
          </div>
            <div>              
              <select name="type" id="type" class="form-control" required>
                  <option >{{ __('web.division') }}</option>                 
                  <option value="علوم">علوم</option>
                  <option value="رياضة">رياضة</option>
                  <option value="ادبي">ادبي</option>
              </select>
          </div>
            <button type="submit" class="main-button icon-button pull-right">{{ __('web.signup') }}</button>
          </form>
        </div>
      </div>
      <!-- /login form -->

    </div>
    <!-- /row -->

  </div>
  <!-- /container -->

</div>
<!-- /Contact -->


@endsection
