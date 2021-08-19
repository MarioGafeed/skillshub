@extends('admin.layout')

@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admins</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">home</a></li>
              <li class="breadcrumb-item active">Admins</li>
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
                                <h3 class="card-title">All Admins</h3>

                                <div class="card-tools">
                                  <!-- <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                  </div> -->
                                  <a href="{{url('dashboard/admins/create')}}" class="btn btn-sm btn-primary" >
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
                      <th>Email</th>
                      <th>Role</th>
                      <th>verified</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($admins As $admin)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td class="admin-name">{{ $admin->name }}</td>
                      <td class="admin-email">{{ $admin->email }}</td>
                      <td class="admin-email">{{ $admin->role->name }}</td>
                      <td>
                        @if(  $admin->email_verified_at  )
                        <span class="badge badge-success">Yes</span>
                        @else
                        <span class="badge badge-danger">No</span>
                        @endif
                        </td>
                        <td>
                          @if($admin->role->name == 'admin')
                              <a href="{{ url("dashboard/admins/promote/$admin->id") }}" class="btn btn-sm btn-danger"><i class="fas fa-level-up-alt"></i></a>
                          @else
                                <a href="{{ url("dashboard/admins/demote/$admin->id") }}" class="btn btn-sm btn-success"><i class="fas fa-level-down-alt"></i></a>
                          @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="d-flex my-3 justify-content-center">
                  {{ $admins->links() }}
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
