@extends('web.layout')

@section('section')


			<!-- Home -->
			<div id="home" class="hero-area">

				<!-- Backgound Image -->
				<div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('/web/img/home-background.jpg') }})"></div>
				<!-- /Backgound Image -->

				<div class="home-wrapper">
					<div class="container">
						<div class="row">
							<div class="col-md-8">
								<h1 class="white-text">{{ __('web.heroTitle') }}</h1>
								<p class="lead white-text">{{ __('web.heroDesc') }}</p>
								<a class="main-button icon-button" href="{{ url("/login") }}">{{ __('web.heroDesc') }}</a>
							</div>
						</div>
					</div>
				</div>

			</div>
			<!-- /Home -->

			<!-- Courses -->
			<div id="courses" class="section">

				<!-- container -->
				<div class="container">

					<!-- row -->
					<div class="row">
						<div class="section-header text-center">
							<h2>{{ __('web.popularExamsTitle') }}</h2>
							<p class="lead">{{ __('web.heroDesc') }}</p>
						</div>
					</div>
					<!-- /row -->

					<!-- courses -->
					<div id="courses-wrapper">
							@foreach($exams As $exam)
							<!-- single course -->
							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="course">
									<a href="{{ url("exams/show/{$exam->id}") }}" class="course-img">
										<img src="{{ asset('uploads/'.$exam->img) }}" alt="{{ $exam->jname('en') }}" height="200px">
										<i class="course-link-icon fa fa-link"></i>
									</a>
									<a class="course-title" href="{{ url("exams/show/{$exam->id}") }}">{{ $exam->jname('en') }}</a>

									<div class="course-details">
									   	<span class="course-category">  {{ $exam->skill->jname('en') }}
											</span>
									</div>
								</div>
							</div>
							<!-- /single course -->
							@endforeach
					</div>
					<!-- /courses -->

					<div class="row">
						<div class="center-btn">
							<a class="main-button icon-button" href="#">{{ __('web.moreCourses') }}</a>
						</div>
					</div>

				</div>
				<!-- container -->

			</div>
			<!-- /Courses -->



			<!-- Contact CTA -->
			<div id="contact-cta" class="section">

				<!-- Backgound Image -->
				<div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('web/img/home-background.jpg') }})"></div>
				<!-- Backgound Image -->

				<!-- container -->
				<div class="container">

					<!-- row -->
					<div class="row">

						<div class="col-md-8 col-md-offset-2 text-center">
							<h2 class="white-text">{{ __('web.contactUs') }}</h2>
							<p class="lead white-text">{{__('web.contactTitle')}} </p>
							<a class="main-button icon-button" href="{{ url("/contact") }}" target="_blank">{{__('web.contactUsNow')}}</a>
						</div>

					</div>
					<!-- /row -->

				</div>
				<!-- /container -->

			</div>
			<!-- /Contact CTA -->

@endsection
