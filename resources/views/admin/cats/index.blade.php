@extends('admin.layout')

@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">home</a></li>
              <li class="breadcrumb-item active">categories</li>
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
                                <h3 class="card-title">All Categories</h3>

                                <div class="card-tools">
                                  <!-- <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                  </div> -->


                                  <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-model">
                                      Add New
                                 </button>
                              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name(en)</th>
                      <th>Name(ar)</th>
                      <th>Active</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($cats As $cat)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td class="cat-name-en">{{ $cat->jname('en') }}</td>
                      <td class="cat-name-ar">{{ $cat->jname('ar') }}</td>
                      <td>
                        @if(  $cat->active  )
                        <span class="badge badge-success">Yes</span>
                        @else
                        <span class="badge badge-danger">No</span>
                        @endif
                        </td>
                      <td>
                        <a href="{{ url("dashboard/categories/toggle/$cat->id") }}" class="btn btn-sm btn-secondry"><i class="fas fa-toggle-on"></i></a>
                          <button type="button" class="btn btn-sm btn-info edit-btn" data-id="{{ $cat->id }}" data-name-en = "{{ $cat->jname('en') }}" data-name-ar = "{{ $cat->jname('ar') }}" data-toggle="modal" data-target="#edit-model">
                              <i class="fas fa-edit"></i>
                         </button>
                          <a href="{{ url("dashboard/categories/delete/$cat->id") }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="d-flex my-3 justify-content-center">
                  {{ $cats->links() }}
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

<!-- Add Modal -->
<div class="modal fade" id="add-model" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
                <div class="modal-body">
                  <form id="add-form" action="{{ url('dashboard/categories/store') }}" method="post">
                    @csrf
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label >Name(en)</label>
                          <input type="text" name="name_en" class="form-control" >
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label >Name(ar)</label>
                          <input type="text" name="name_ar" class="form-control" >
                        </div>
                      </div>
                    </div>
                  </form>
                 </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="add-form" class="btn btn-primary">Submit</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>

<!-- Edit Modal -->
<div class="modal fade" id="edit-model" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Edit Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
                <div class="modal-body">
                  <form id="edit-form" action="{{ url('dashboard/categories/update') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="edit-form-id">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label >Name(en)</label>
                          <input type="text" name="name_en" id="edit-form-nameEn" class="form-control" >
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label >Name(ar)</label>
                          <input type="text" name="name_ar" id="edit-form-nameAr" class="form-control" >
                        </div>
                      </div>
                    </div>
                  </form>
                 </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="edit-form" class="btn btn-primary">Submit</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>

@endsection

@section('scripts')
  <script>
      $('.edit-btn').click(function(){
        let id = $(this).attr('data-id')
        let nameEn = $(this).attr('data-name-en')
        let nameAr = $(this).attr('data-name-ar')

        // console.log(id, nameEn, nameAr);
        $('#edit-form-id').val(id)
        $('#edit-form-nameEn').val(nameEn)
        $('#edit-form-nameAr').val(nameAr)
      })
  </script>
@endsection
