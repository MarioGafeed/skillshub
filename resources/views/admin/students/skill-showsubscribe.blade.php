@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Show Subscribe Skills for {{ $student->name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('dashboard/students') }}">Students</a></li>
                            <li class="breadcrumb-item active">Show Skills</li>
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
                                <h3 class="card-title"> All {{ $student->name }} Student Skills Subscribtions</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#add-model">
                                        Add Skill Subscribtions for {{ $student->name }} Student
                                    </button>
                                </div>
                            </div>
                            <!-- card header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>IDs</th>
                                            <th>Skill</th>
                                            <th>Subscriber?</th>
                                            <th>Subcribtion Price</th>
                                            <th>Start Of Subscription</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($skills as $skill)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ json_decode($skill->name)->en }}</td>
                                                <td>{{ $skill->pivot->subscriber }}</td>
                                                <td>{{ $skill->pivot->priceSubscribtion }}</td>
                                                <td>{{ $skill->pivot->updated_at }}</td>
                                                <td>
                                                  @if ($skill->pivot->subscriber)
                                                      <span class="badge badge-success">Yes</span>
                                                  @else
                                                      <span class="badge badge-danger">No</span>
                                                  @endif
                                              </td>
                                                <td>
                                                    <a href="{{ url("dashboard/students/toggle/$student->id/$skill->id") }}"
                                                        class="btn btn-sm btn-secondry"><i class="fas fa-toggle-on"></i></a>
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

    <!-- Add Modal -->
    <div class="modal fade" id="add-model" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Skill Subscribtion for {{ $student->name }} </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.inc.errors')
                    <form id="add-form" action="{{ url("dashboard/students/skills_subscribtion/store/$student->id") }}"
                        method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Select Skill</label>
                                    <select name="skill_id"
                                        class="form-control select2 select2-danger select2-hidden-accessible"
                                        data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12"
                                        tabindex="-1" aria-hidden="true">
                                        @foreach ($allskills as $skill)
                                            <option value="{{ $skill->id }}" selected="selected" data-select2-id="14">
                                                {{ $skill->jname('en') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Price Subscribtion</label>
                                    <input type="number" name="priceSubscribtion" class="form-control" min="1">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Subscription Period (In Month)</label>
                                    <input type="number" name="subscribtionperiod" class="form-control" min="1"
                                        max="12">
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
@endsection
