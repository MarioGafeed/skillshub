@extends('admin.layout')

@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">exams</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">home</a></li>
              <li class="breadcrumb-item active">exams</li>
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
                                <h3 class="card-title">All exams</h3>

                                <div class="card-tools">
                                  <!-- <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                  </div> -->
                                  <a href="{{ url('dashboard/exams/create') }}"  class="btn btn-sm btn-primary">
                                      Add New
                                 </a>
                              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Name(en)</th>
                      <th>Name(ar)</th>
                      <th>Skill(en)</th>
                      <th>Skill(ar)</th>
                      <th>Questions no</th>
                      <th>Active</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($exams As $exam)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <div class="entry-thumb">
                      <td class="exam-img"> <img src="{{ asset('uploads/'.$exam->img) }}" class="img-circle" alt="exam Image" height="50px"> </td>
                      </div>
                      <td class="exam-name-en">{{ $exam->jname('en') }}</td>
                      <td class="exam-name-ar">{{ $exam->jname('ar') }}</td>
                      <td class="skill-name-en">{{ $exam->skill->jname('en') }}</td>
                      <td class="skill-name-ar">{{ $exam->skill->jname('ar') }}</td>
                      <td >{{ $exam->questions_no }}</td>
                      <td>
                        @if(  $exam->active  )
                        <span class="badge badge-success">Yes</span>
                        @else
                        <span class="badge badge-danger">No</span>
                        @endif
                        </td>
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
                <div class="d-flex my-3 justify-content-center">
                  {{ $exams->links() }}
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

@section('scripts')
  <script>

  </script>
@endsection
