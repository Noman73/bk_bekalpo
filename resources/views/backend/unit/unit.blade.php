@extends('layouts.admin.admin-master')
@section('link')
<link href="{{asset('storage/admin/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{asset('storage/admin/vendor/select2/css/select2.min.css')}}" rel="stylesheet">
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
                    <h4 class="card-title ">Unit Type</h4>
                </div>
                <div class="col-6 ">
                    <button class="btn btn-sm btn-primary float-end" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" id="modalBtn"><i class="fas fa-plus text-light"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm table-bordered text-center data-table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Sub Category</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                {{-- modal start --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Add New Fuel Type</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form>
                              <input type="hidden" name='id' id="id">
                            <div class="basic-form">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Sub Category :</label>
                                    <select type="text" class="default-select form-control wide" id="subcategory" name="subcategory">
                                        <option value="">--SELECT--</option>
                                        @foreach($category as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="subcategory_msg">
                                    </div>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Name :</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name ">
                                    <div class="invalid-feedback" id="name_msg">
                                    </div>
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
<script src="{{asset('storage/admin/vendor/select2/js/select2.full.min.js')}}">
</script>
@include('backend.unit.internal-assets.js.script')
@endsection