@extends('web.layout')


@section('title')
    Exams - {{ $exam->jname() }}
@endsection

@section('section')
    <!-- Hero-area -->

    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url(./img/blog-post-background.jpg)"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="{{ url('/') }}">{{ __('web.home') }}</a></li>
                        <li><a href="category.html">{{ $exam->skill->cat->jname() }}</a></li>
                        <li><a href="category.html">{{ $exam->skill->jname() }}</a></li>
                        <li>{{ $exam->jname() }}</li>
                    </ul>
                    <h1 class="white-text">{{ $exam->jname() }}</h1>
                    <ul class="blog-post-meta">
                        <li>{{ Carbon\Carbon::parse($exam->created_at)->format('d M Y') }}</li>
                        <li class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i>
                                {{ $exam->users()->count() }}</a></li>
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

                    @include('web.inc.messages')
                    <!-- blog post -->
                    <div class="blog-post mb-5">
                        <p>
                            {!! $exam->jdesc() !!}
                        </p>
                    </div>
                    <!-- /blog post -->


                    @if (!$startShowexambtn)
                        <div class="alert alert-info" role="alert">
                            {{ __('web.exam_before') }}
                        </div>
                    @else
                        <form action="{{ url("exams/start/{$exam->id}") }}" method="post">
                            @csrf
                            <button type="submit"
                                class="main-button icon-button pull-left">{{ __('web.start_exam') }}</button>
                        </form>
                    @endif


                </div>
                <!-- /main blog -->

                <!-- aside blog -->
                <div id="aside" class="col-md-3">

                    <!-- exam details widget -->
                    <ul class="list-group">
                        <li class="list-group-item">{{ __('web.skill') }} {{ $exam->skill->jname() }}</li>
                        <li class="list-group-item">{{ __('web.question') }} {{ $exam->questions_no }}</li>
                        <li class="list-group-item">{{ __('web.duration') }} {{ $exam->duration_mins }}
                            {{ __('web.min') }}</li>
                        <li class="list-group-item">{{ __('web.diff') }}
                            @for ($i = 1; $i <= $exam->diff; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            @for ($i = 5; $i > $exam->diff; $i--)
                                <i class="fa fa-star-o"></i>
                            @endfor
                        </li>
                    </ul>
                    <!-- /exam details widget -->



                </div>
                <!-- /aside blog -->

            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->
@endsection
