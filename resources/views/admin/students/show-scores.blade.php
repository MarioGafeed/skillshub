@extends('admin.layout')

@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Show Scores {{ $student->name }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('dashboard/students') }}">Students</a></li>
              <li class="breadcrumb-item active">Show Scores</li>
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
                        <th>Exam</th>
                        <th>Score</th>
                        <th>Time (min)</th>
                        <th>At</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($exams As $exam)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $exam->jname('en') }}</td>
                        <td>{{ $exam->pivot->score }} %</td>
                        <td>{{ $exam->pivot->time_mins }} M</td>
                        <td>{{ $exam->pivot->created_at }}</td>
                        <td>{{ $exam->pivot->status }}</td>
                        <td>
                            @if($exam->pivot->status == 'closed')
                            <a href="{{ url("dashboard/students/open-exam/$student->id/$exam->id") }}" class="btn btn-sm btn-success"><i class="fas fa-lock-open"></i></a>
                            @else
                            <a href="{{ url("dashboard/students/close-exam/$student->id/$exam->id") }}" class="btn btn-sm btn-danger"><i class="fas fa-lock"></i></a>
                            @endif
                        </td>
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
