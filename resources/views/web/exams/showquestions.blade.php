@extends('web.layout')


@section('title')
   {{ __('web.exams') }} : {{ $exam->jname() }} = Questions
@endsection

@section('styles')
   <link href="{{ asset('web/css/TimeCircles.css') }}" rel="stylesheet">
@endsection


@section('section')

  		<!-- Hero-area -->
  		<div class="hero-area section">

  			<!-- Backgound Image -->
  			<div class="bg-image bg-parallax overlay" style="background-image:urlurl({{ asset('web/img/blog-post-background.jpg') }}) "></div>
  			<!-- /Backgound Image -->

  			<div class="container">
  				<div class="row">
  					<div class="col-md-10 col-md-offset-1 text-center">
  						<ul class="hero-area-tree">
  							<li><a href="{{url('/')}}">{{ __('web.home') }}</a></li>
  							<li><a href="category.html">{{ $exam->skill->cat->jname() }}</a></li>
  							<li><a href="category.html">{{ $exam->skill->jname() }}</a></li>
  							<li>{{ $exam->jname() }}</li>
  						</ul>
  						<h1 class="white-text">{{ $exam->jname() }}</h1>
  						<ul class="blog-post-meta">
  							<li>{{ Carbon\Carbon::parse($exam->created_at)->format('d M Y') }}</li>
  							<li class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i> {{ $exam->users()->count() }}</a></li>
  						</ul>
  					</div>
  				</div>
  			</div>

  		</div>
  		<!-- /Hero-area -->

  		<!-- Blog -->
  		<div id="blog" class="section">

  			<!-- container -->
  			<div class="container">

  				<!-- row -->
  				<div class="row">

  					<!-- main blog -->
  					<div id="main" class="col-md-9">
              <form id="exam-submit-form" action="{{ url("exams/submit/{$exam->id}") }}" method="post">
                  @csrf
              </form>

  						<!-- blog post -->
  						<div class="blog-post mb-5">
  							<p>
                                  @foreach($exam->questions As $index =>  $ques )
                                  <div class="panel panel-default">
                                      <div class="panel-heading">
                                        <h3 class="panel-title"> {{$index+1}}- {{$ques->title}}</h3>
                                      </div>
                                      <div class="panel-body">
                                          <div class="radio">
                                              <label>
                                                <input type="radio" name="answers[{{$ques->id}}]"  value="1" form="exam-submit-form">
                                                {{ $ques->op1 }}
                                              </label>
                                          </div>
                                          <div class="radio">
                                              <label>
                                                <input type="radio" name="answers[{{$ques->id}}]" value="2"  form="exam-submit-form">
                                                {{ $ques->op2 }}
                                              </label>
                                          </div>
                                          <div class="radio">
                                              <label>
                                                <input type="radio" name="answers[{{$ques->id}}]" value="3" form="exam-submit-form">
                                                {{ $ques->op3 }}
                                              </label>
                                          </div>
                                          <div class="radio">
                                              <label>
                                                <input type="radio" name="answers[{{$ques->id}}]" value="4" form="exam-submit-form">
                                                {{ $ques->op4 }}
                                              </label>
                                          </div>
                                      </div>
                                  </div>
                                  @endforeach


                </p>
  						</div>
  						<!-- /blog post -->

                          <div>
                              <button type="submit" form="exam-submit-form" class="main-button icon-button pull-left">Submit</button>
                              <button class="main-button icon-button btn-danger pull-left ml-sm">Cancel</button>
                          </div>
  					</div>
  					<!-- /main blog -->

            <!-- aside blog -->
            <div id="aside" class="col-md-3">

              <!-- exam details widget -->
                          <ul class="list-group">
                              <li class="list-group-item">Skill: {{ $exam->skill->jname() }}</li>
                              <li class="list-group-item">Questions: {{ $exam->questions_no }}</li>
                              <li class="list-group-item">Duration: {{ $exam->duration_mins }} mins</li>
                              <li class="list-group-item">Difficulty:
                                @for($i=1; $i<=$exam->diff; $i++)
                                <i class="fa fa-star"></i>
                                @endfor
                                @for($i=5; $i>$exam->diff; $i--)
                                <i class="fa fa-star-o"></i>
                                @endfor
                              </li>
                          </ul>
              <!-- /exam details widget -->

                <!-- Time down Js via timecircles js -->
              <div class="duration-countdown" data-timer=" 20 "></div>



            </div>
            <!-- /aside blog -->

  				</div>
  				<!-- row -->

  			</div>
  			<!-- container -->

  		</div>
  		<!-- /Blog -->



@section('scripts')
    <script type="text/javascript" src=" {{ asset('web/js/TimeCircles.js') }} "></script>

    <script>
        $(".duration-countdown").TimeCircles(
           { time:
              {
          Days: { show: false },
        },
             count_past_zero:  false ,
      } ).addListener(function(unit, value, total) {
            if(total <= 0)
            // alert('Time Up');
            $('#exam-submit-form').submit()
        });
    </script>
@endsection
