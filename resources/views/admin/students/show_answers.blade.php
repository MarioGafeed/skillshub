@extends('admin.layout')

@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Show Answers for {{ $student->name }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('dashboard/students') }}">Students</a></li>
              <li class="breadcrumb-item active">Show Answers</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @include('admin.inc.messages')
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"> Scores </h3>
                </div>
                <!-- card header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Question</th>
                        <th>Option1</th>
                        <th>Option2</th>
                        <th>Option3</th>
                        <th>Option4</th>
                        <th>Student's Answer</th>
                        <th>Right Answer</th>                                               
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($questions As $question)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $question->title }}</td>
                        <td>{{ $question->op1 }}</td>
                        <td>{{ $question->op2 }}</td>
                        <td>{{ $question->op3 }}</td>
                        <td>{{ $question->op4 }}</td>                        
                        <td>{{ $question->pivot->user_answer }}</td>
                        <td>{{ $question->pivot->right_ans }}</td>                                                
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
