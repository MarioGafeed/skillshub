@extends('web.layout')


@section('title')
 {{ __('web.profile') }}: {{ Auth::user()->name }}
@endsection

@section('section')

<!-- Hero-area -->
<div class="hero-area section">

  <!-- Backgound Image -->
  <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('web/img/page-background.jpg') }}) "></div>
  <!-- /Backgound Image -->

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1 text-center">
        <ul class="hero-area-tree">
          <li><a href="{{ url('/') }}">{{__('web.home')}}</a></li>
          <li>{{ __('web.profile') }}</li>
        </ul>
        <h1 class="white-text">{{ Auth::user()->name }} </h1>
        <h3 class="white-text">{{ $exam->jname() }} </h3>

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
        <table class="table">
          <thead>
            <tr>
              <th>{{ __('web.ID') }}</th>
              <th>{{ __('web.question') }}</th>
              <th>{{ __('web.question_op1') }}</th>
              <th>{{ __('web.question_op2') }}</th>
              <th>{{ __('web.question_op3') }}</th>
              <th>{{ __('web.question_op4') }}</th>
              <th>{{ __('web.your_answer') }}</th>
              <th>{{ __('web.right_answer') }}</th>            
            </tr>
          </thead>

          <tbody>
            @foreach( $questions As $question)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td> {{ $question->title }} </td>
                <td> {{ $question->op1 }} </td>
                <td> {{ $question->op2 }} </td>
                <td> {{ $question->op3 }} </td>
                <td> {{ $question->op4 }} </td>
                <td> {{ $question->pivot->user_answer }} </td>
                <td> {{ $question->pivot->right_ans }} </td>                                                
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /login form -->

    </div>
    <!-- /row -->

  </div>
  <!-- /container -->

</div>
<!-- /Contact -->


@endsection
