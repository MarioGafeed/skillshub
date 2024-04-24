@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add exam Step2</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">home</a></li>
                            <li class="breadcrumb-item active">Add Questions</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 pb-3">
                        @include('admin.inc.errors')

                        <form method="post" action="{{ url("dashboard/exams/store-questions/{$exam_id}") }}">
                            @csrf
                            <div class="card-body">
                                @for ($i = 1; $i <= $questions_no; $i++)
                                    <h5>Question {{ $i }}</h5>

                                    <div class="row">
                                        <div class="col-6">
                                          <div class="form-group">
                                            <label>title</label>
                                            <textarea name="title[{{ $i }}]" id="title">{{ old('title.' . $i) ?? null }}</textarea>
                                         </div>

                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Right Answer.</label>
                                                
                                                <input type="number" name="right_ans[{{ $i }}]" max="4"
                                                    min="1" class="form-control" placeholder="Enter the right answer"
                                                    value="{{ old('right_ans.' . $i) ?? null }}">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Option 1</label>
                                                <textarea name="op1[{{ $i }}]" id="op1">{{ old('op1.' . $i) ?? null }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Option 2</label>
                                                <textarea name="op2[{{ $i }}]" id="op2">{{ old('op2.' . $i) ?? null }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Option 3</label>
                                                <textarea name="op3[{{ $i }}]" id="op3">{{ old('op3.' . $i) ?? null }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Option 4</label>
                                                <textarea name="op4[{{ $i }}]" id="op4">{{ old('op4.' . $i) ?? null }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endfor
                                <div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    @endsection

    @section('scripts')
        <script>
             $(document).ready(function() {
                $('textarea[name^="title"]').each(function() {
                    CKEDITOR.replace(this);
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('textarea[name^="op1"]').each(function() {
                    CKEDITOR.replace(this);
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('textarea[name^="op2"]').each(function() {
                    CKEDITOR.replace(this);
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('textarea[name^="op3"]').each(function() {
                    CKEDITOR.replace(this);
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('textarea[name^="op4"]').each(function() {
                    CKEDITOR.replace(this);
                });
            });
        </script>
    @endsection
