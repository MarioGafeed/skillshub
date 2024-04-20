@extends('web.layout')

@section('section')


			<!-- Home -->
			<div id="home" class="hero-area">

				<!-- Backgound Image -->
				<div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('/web/img/home-background.jpg') }})"></div>
				<!-- /Backgound Image -->

				<div class="home-wrapper">
					<div class="container" style="text-align: center">
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
			<div class="callus dir">
                <div class="row no-gutters">
                    <div class="col-4" class="container" style="text-align: center;">
                       <h2>
						<a class="site-btn2" href="https://api.whatsapp.com/send?&amp;phone=201096389912&amp;text=انا مهتم بالعرض الذهبي على الامتحانات هل من الممكن مساعدتي وكيفية الاستفادة بالعرض؟" target="_blank"><i class="fa fa-whatsapp"></i>العرض الذهبي اكثر من 30 امتحان لغة انجليزية لأبطال 3ث فقط ثلاثون 30 مصرياً لا غير للتفاصيل والإشتراك اضغط هنا</a>
					   </h2>
                    </div>
                    <div class="col-4">
                        <a href="tel:+201096389912" class="calling text-white d-block"><i class="fa fa-phone"></i></a>
                    </div>
                    <div class="col-4">
                        <a href="#form" class="message text-white d-block"><i class="fa fa-envelope"></i></a>
                    </div>
                </div>
            </div>

			{{-- ai --}}
			 <!-- Modal popup -->
			 <div id="popup" class="popup">
				<div class="popup-content">
				  <h2>العرض الذهبي</h2> 				
				  <a  href="https://api.whatsapp.com/send?&amp;phone=+201096389912&amp;text=انا مهتم بالعرض الدهبي للحريت والإستفادة بأكثر من 30 امتحان في المادة ممكن المزيد من التفاصيل؟" target="_blank"><i class="fa fa-whatsapp"></i>العرض الذهبي اكثر من 30 امتحان لأبطال 3ث فقط ثلاثون جنيهاً مصرياً لا غير للتفاصيل والإشتراك اضغط هنا.</a>
				  
				  <button id="whatsapp-btn" > 
				  للتفاصيل للإستفادة بالعرض إضغط هنا
				  </button>			
				  <button id="close-btn">اغلاق</button>	  
				</div>
			  </div>

			<!-- Courses -->
			<div id="courses" class="section">

				<!-- container -->
				<div class="container" style="text-align: center;">

					<!-- row -->
					<div class="row" >
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


			

<!-- Modal -->
<style>
	.popup {
  position: fixed;
  top: 0; 
  left: 0;
  width: 100%;
  height: 100%;
  background:  rgba(87, 78, 75, 0.5);
  display: none;
}

.popup-content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: hsl(60, 59%, 70%);
  padding: 20px;
  border-radius: 5px;
  text-align: center;
}
</style>

<script>
// Get DOM elements
const popup = document.getElementById('popup');
const closeBtn = document.getElementById('close-btn');
const whatsappBtn = document.getElementById('whatsapp-btn');

// Show popup 
popup.style.display = 'block';

// Close popup
closeBtn.addEventListener('click', () => {
  popup.style.display = 'none'; 
});

// Open WhatsApp chat
whatsappBtn.addEventListener('click', () => {
  window.open('https://wa.me/+201096389912');
});

</script>

@endsection