@extends('admin.layout')

@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $exam->jname('en') }} / Questions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('dashboard/exams') }}">exams</a></li>
              <li class="breadcrumb-item"><a href="{{ url("dashboard/exams/show/$exam->id") }}">{{ $exam->name }}</a></li>
              <li class="breadcrumb-item active">{{ $exam->jname('en') }} Questions</li>
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
          <!-- <div class="col-md-10 offset-md-1 pb-3"> -->
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Exam Question</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>options</th>
                    <th>Right Ans.</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($exam->questions As $ques)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="ques-name">{{ $ques->title }}</td>
                    <td class="ques-op1">
                      {{ $ques->op1 }} |<br>
                      {{ $ques->op2 }} |<br>
                      {{ $ques->op3 }} |<br>
                      {{ $ques->op4 }} |
                    </td>
                    <td class="ques-name">{{ $ques->right_ans }}</td>
                    <td>
                      <a href="{{ url("dashboard/exams/toggle/$exam->id") }}" class="btn btn-sm btn-secondry"><i class="fas fa-toggle-on"></i></a>
                       <a href="{{ url("dashboard/exams/show/$exam->id") }}" class="btn btn-sm btn-info"  >
                           <i class="fas fa-eye"></i>
                      </a>
                      <a href="{{ url("dashboard/exams/show/$exam->id/questions") }}" class="btn btn-sm btn-success">
                          <i class="fas fa-question"></i>
                     </a>
                     <a href="{{ url("dashboard/exams/edit/$exam->id") }}" class="btn btn-sm btn-info"  >
                         <i class="fas fa-edit"></i>
                    </a>
                        <a href="{{ url("dashboard/exams/delete/$exam->id") }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <a class="btn btn-sm btn-info" href="{{ url()->previous() }}"> Back </a>
            <a class="btn btn-sm btn-primary" href="{{ url("dashboard/exams") }}"> Back to all exams </a>
            <!-- /.card-body -->
          </div>
        <!-- </div> -->
      </div>
      <div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
