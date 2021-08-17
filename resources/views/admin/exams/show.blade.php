@extends('admin.layout')

@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $exam->jname('en') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('dashboard/exams') }}">exams</a></li>
              <li class="breadcrumb-item active">{{ $exam->jname('en') }}</li>
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

          <div class="card-body p-0">
                <table class="table table-md">
                  <!-- <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th>Progress</th>
                      <th style="width: 40px">Label</th>
                    </tr>
                  </thead> -->

                  <tbody>
                    <tr>
                      <th>Name (en) </th>
                      <td>{{ $exam->jname('en') }}</td>
                    </tr>
                    <tr>
                      <th>Name (ar) </th>
                      <td>{{ $exam->jname('ar') }}</td>
                    </tr>
                    <tr>
                      <th>skill (en) </th>
                      <td>{{ $exam->skill->jname('en') }}</td>
                    </tr>
                    <tr>
                      <th>skill (ar) </th>
                      <td>{{ $exam->skill->jname('ar') }}</td>
                    </tr>
                    <tr>
                      <th>description (en) </th>
                      <td>{{ $exam->jdesc('en') }}</td>
                    </tr>
                    <tr>
                      <th>description (ar) </th>
                      <td>{{ $exam->jdesc('ar') }}</td>
                    </tr>
                    <tr>
                      <th>Image </th>
                      <td>
                        <img src=" {{ asset("uploads/{$exam->img}") }}" height="50px" alt="">
                      </td>
                    </tr>
                    <tr>
                      <th>Questions No </th>
                      <td>
                        {{ $exam->questions_no }}
                      </td>
                    </tr>
                    <tr>
                      <th>Diffculty</th>
                      <td>
                        {{ $exam->diff }}
                      </td>
                    </tr>
                    <tr>
                      <th>Duration (min.)</th>
                      <td>
                        {{ $exam->duration_mins }}
                      </td>
                    </tr>
                    <tr>
                      <th>Active</th>
                      <td>
                        @if($exam->active)
                          <span class="badge bg-success">Yes</span>
                        @else
                          <span class="badge bg-danger">No</span>
                        @endif
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- End card Body -->
                  <a class="btn btn-sm btn-success" href="{{ url("dashboard/exams/show-question/$exam->id") }}"> Show Questions </a>
                  <a class="btn btn-sm btn-primary" href="{{ url()->previous() }}"> Back </a>
            <!-- </div> -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
