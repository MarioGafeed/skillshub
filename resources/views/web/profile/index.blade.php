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
              <th>{{ __('web.examname') }}</th>
              <th>{{ __('web.score') }}%</th>
              <th>{{ __('web.score') }}/</th>
              <th>{{ __('web.timeM') }}</th>
            </tr>
          </thead>

          <tbody>
            @foreach(Auth::user()->exams As $exam)
              <tr>
                <td> {{ $exam->jname() }} </td>
                <td> {{ $exam->pivot->score }} %</td>
                <td> <span><b>{{ number_format($exam->pivot->score * $exam->questions_no / 100) }}</b></span> / {{ $exam->questions_no }} </td>               
                <td> {{ $exam->pivot->time_mins }} {{ __('web.m') }}</td>
                <td><a href="{{ url("profile/show_answers/$exam->id") }}" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-percent"></i></a></td>
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
