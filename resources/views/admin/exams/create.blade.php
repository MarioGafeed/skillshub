@extends('admin.layout')

@section('main')

  <!-- Content Wrapper. Contains page content -->
  <!-- Content Header (Page header) -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">exams</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">home</a></li>
            <li class="breadcrumb-item active">Add exam</li>
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

          <form method="post" action="{{ url("dashboard/exams/store") }} " enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Name_en</label>
                    <input type="text" name="name_en" class="form-control"  placeholder="Enter Name in English">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>Name_ar</label>
                    <input type="text" name="name_ar" class="form-control"  placeholder="Enter Name in Arabic">
                  </div>
                </div>
               </div>
                <div class="form-group">
                  <label>Description (en)</label>
                  <textarea name="desc_en" class="form-control"  placeholder="Enter Description in English"></textarea>
                </div>

                <div class="form-group">
                  <label>Description (ar)</label>
                  <textarea name="desc_ar"
                   class="form-control"  placeholder="Enter Description in Arabic"></textarea>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="img">
                          <label class="custom-file-label">Choose file</label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label>skill</label>
                      <select class="custom-select form-control" name="skill_id" id="edit-form-cat-id">
                        @foreach($skills as $skill)
                           <option value="{{$skill->id}}"> {{ $skill->jname('en') }} </option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label>Question No.</label>
                      <input type="number" name="questions_no" class="form-control"  placeholder="Question Number">
                    </div>
                  </div>

                  <div class="col-4">
                    <div class="form-group">
                      <label>Diffculty</label>
                      <input type="number" name="diff" min="1" max="5" class="form-control"  placeholder="Diffculty">
                    </div>
                  </div>

                  <div class="col-4">
                    <div class="form-group">
                      <label>Duration (min).</label>
                      <input type="number" name="duration_mins" class="form-control"  placeholder="Duration">
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

@section('scripts')
<script>
  CKEDITOR.replace( 'desc_en' );
</script>
<script>
  CKEDITOR.replace( 'desc_ar' );
</script>
@endsection