@extends('admin.layout')

@section('main')
  <!-- Content Wrapper. Contains page content -->
  <!-- Content Header (Page header) -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Admins</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">home</a></li>
            <li class="breadcrumb-item active">Add Admin</li>
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

          <form method="post" action="{{ url("dashboard/admins/store") }} " >
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control"  placeholder="Enter Name">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"  placeholder="Enter Email">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label>Role</label>
                    <select class="custom-select form-control" name="role_id" id="edit-form-role-id">
                      @foreach($roles as $role)
                         <option value="{{$role->id}}"> {{ $role->name }} </option>
                      @endforeach
                    </select>
                  </div>
                </div>
               </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control"  placeholder="Enter Password">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>Password Confirm</label>
                      <input type="password" name="password_confirmation" class="form-control"  placeholder="Confirm Password">
                    </div>
                  </div>
                </div>

                <div>
                  <button type="submit" class="btn btn-success">Submit</button>
                  <a href="{{ url()->previous() }}" class="btn btn-primary">back</a>
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
