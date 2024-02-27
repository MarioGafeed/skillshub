@extends('admin.layout')

@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Students</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">home</a></li>
              <li class="breadcrumb-item active">Students</li>
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
                                <h3 class="card-title">All students</h3>
                                <div class="card-tools">
                                  <!-- <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                  </div> -->
                                  <a href="{{url('dashboard/students/create')}}" class="btn btn-sm btn-primary" >
                                    Add New
                               </a>
                              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>phone</th>
                      <th>Email</th>
                      <th>verified</th>
                      <th>Active</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($students As $student)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td class="student-name">{{ $student->name }}</td>
                      <td class="student-phone">{{ $student->phone }}</td>
                      <td class="student-email">{{ $student->email }}</td>
                      <td>
                        @if(  $student->email_verified_at  )
                        <span class="badge badge-success">Yes</span>
                        @else
                        <span class="badge badge-danger">No</span>
                        @endif
                        </td>
                        <td>
                          @if(  $student->active  )
                          <span class="badge badge-success">Yes</span>
                          @else
                          <span class="badge badge-danger">No</span>
                          @endif
                        </td>
                      <td>
                          <a href="{{ url("dashboard/students/toggle/$student->id") }}" </a>
                          <a href="{{ url("dashboard/students/show-scores/$student->id") }}" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-percent"></i></a>
                          <a href="{{ url("dashboard/students/skill-showsubscribe/$student->id") }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-university"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="d-flex my-3 justify-content-center">
                  {{ $students->links() }}
                </div>

              </div>
              <!-- /.card-body -->
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
