@extends('web.layout')


@section('title')
 {{ __('web.verify_email') }}
@endsection

@section('section')



  <!-- Contact -->
  <div id="contact" class="section">
    <div class="alert alert-success">
      {{ __('web.verify_mail') }}
    </div>

    <!-- container -->
    <div class="container">

      <!-- row -->
      <div class="row">

        <!-- login form -->
        <div class="col-md-3 col-md-offset-3">
          <div class="contact-form">
            <div class="alert alert-danger">
              {{__('web.verify_problem')}}
            <form  action="{{ url('/email/verification-notification') }}" method="post">
               @csrf
             <button type="submit"  class="main-button icon-button pull-right" name="button">{{ __('web.resend_mail') }}</button>
            </form>
          </div>
        </div>
      </div>
      </div>
        <!-- /login form -->

    </div>
      <!-- /row -->

    </div>
    <!-- /container -->








@endsection
