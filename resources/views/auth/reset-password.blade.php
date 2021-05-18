@extends('web.layout')


@section('title')
 {{ __('web.reset-password') }}
@endsection

@section('section')



<!-- Contact -->
<div id="contact" class="section">

  <!-- container -->
  <div class="container">

    <!-- row -->
    <div class="row">

      <!-- login form -->
      <div class="col-md-6 col-md-offset-3">
        <div class="contact-form">
          <h4>{{__('web.reset-password')}}</h4>

          @include('web.inc..messages')

          <form method="post" action="{{ url('/reset-password') }}">
            @csrf
            <input class="input" type="email" name="email" placeholder="{{__('web.email')}}">
            <input class="input" type="password" name="password" placeholder="{{ __('web.password') }}">
            <input class="input" type="password" name="password_confirmation" placeholder="{{ __('web.password_confirm') }}">
            <input type="hidden" name="token" value="{{ request()->route('token') }}">
          </br>
            <button type="submit" class="main-button icon-button pull-right">{{__('web.submit')}}</button>
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
