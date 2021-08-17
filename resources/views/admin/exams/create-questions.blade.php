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
          <!-- <div class="col-md-10 offset-md-1 pb-3"> -->

        <div class="col-12 pb-3">

          @include('admin.inc.errors')

          <form method="post" action="{{ url("dashboard/exams/store-questions/{$exam_id}") }}">
            @csrf
            <div class="card-body">
              @for($i=1; $i <= $questions_no; $i++)
                <h5>Question {{$i}}</h5>

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title[]" class="form-control"  placeholder="Enter Title for Question" >
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label>Right Answer.</label>
                    <input type="number" name="right_ans[]" max="4" min="1" class="form-control"  placeholder="Enter the right answer" >
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label>Option 1</label>
                    <input type="text" name="op1[]" class="form-control"  placeholder="Enter the option" >
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label>Option 2</label>
                    <input type="text" name="op2[]" class="form-control"  placeholder="Enter the option" >
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label>Option 3</label>
                    <input type="text" name="op3[]" class="form-control"  placeholder="Enter the option" >
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label>Option 4</label>
                    <input type="text" name="op4[]" class="form-control"  placeholder="Enter the option" >
                  </div>
                </div>
              </div>
               <hr>
                @endfor
                <div>
                  <button type="submit" class="btn btn-success">Submit</button>
                  <!-- <a href="{{ url()->previous() }}" class="btn btn-primary">back</a> -->
                </div>
            </div>
          </form>
        </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
