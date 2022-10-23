@extends('layouts.admin.admin-master')
@section('link')
<link href="{{asset('storage/admin/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Form</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Element</a></li>
            </ol>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="col-6">
                    <h4 class="card-title ">Manage Ads</h4>
                </div>
                <div class="col-6 ">
                    <button class="btn btn-sm btn-primary float-end" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" id="modalBtn"><i class="fas fa-plus text-light"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered text-center data-table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Division</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                {{-- modal start --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form>
                              <input type="hidden" name='id' id="id">
                            <div class="mb-3">
                              <label for="recipient-name" class="col-form-label">Comany Name :</label>
                              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name ">
                              <div class="invalid-feedback" id="name_msg">
                              </div>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Title :</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Category Name ">
                                <div class="invalid-feedback" id="title_msg">
                                </div>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Logo :</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name ">
                                <div class="invalid-feedback" id="name_msg">
                                </div>
                            </div> --}}
                            <div class="input-group mb-3">
                                <span class="input-group-text">Logo Upload</span>
                                <div class="form-file">
                                    <input type="file" class="form-file-input form-control" id="logo">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Icon Upload</span>
                                <div class="form-file">
                                    <input type="file" class="form-file-input form-control" id="icons">
                                </div>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" onclick="formRequest()">Submit</button>
                        </div>
                      </div>
                    </div>
                  </div>
                {{-- modal end --}}
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{asset('storage/admin/vendor/datatables/js/jquery.dataTables.min.js')}}">
</script>
@include('backend.post.internal-assets.js.script')
@endsection