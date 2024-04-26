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
      <div class="col-md-9 col-md-offset-1">
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
              <th>{{ __('web.Updated_at') }}</th>           
              <th>{{ __('web.exam') }}</th>                         
                          
            </tr>
          </thead>

          <tbody>
            @foreach( $questions As $question)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td> {{ strip_tags($question->title) }} </td>
                <td> {{ strip_tags($question->op1) }} </td>
                <td> {{ strip_tags($question->op2) }} </td>
                <td> {{ strip_tags($question->op3) }} </td>
                <td> {{ strip_tags($question->op4) }} </td>
                <td> {{ $question->pivot->user_answer }} </td>
                <td> {{ $question->pivot->right_ans }} </td>   
                <td> {{ $question->pivot->updated_at }} </td>   
                @if(App::getlocale() == "en")
                <td> {{  json_decode($question->exam->name)->en }} </td>
               @else
               <td> {{  json_decode($question->exam->name)->ar }} </td>
               @endif                                                                                                            
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
