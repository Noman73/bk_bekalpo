@extends('layouts.admin.admin-master')
@section('link')
<link href="{{asset('storage/admin/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
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
                    <h4 class="card-title ">Package</h4>
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
                            <th>Name</th>
                            <th>Icon</th>
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
                          <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <input type="hidden" name='id' id="id"> 
                            <div class="mb-3">
                              <label for="recipient-name" class="col-form-label">Name :</label>
                              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name ">
                              <div class="invalid-feedback" id="name_msg">
                              </div>
                            </div>
                            <div class="mb-3">
                              <label for="recipient-name" class="col-form-label">Price :</label>
                              <input type="number" class="form-control" id="price" name="price" placeholder="Enter Category Name ">
                              <div class="invalid-feedback" id="price_msg">
                              </div>
                            </div>
                            <div class="mb-3">
                              <label for="recipient-name" class="col-form-label">Days :</label>
                              <input type="number" class="form-control" id="days" name="days" placeholder="Enter Category Name ">
                              <div class="invalid-feedback" id="days_msg">
                              </div>
                            </div>
                            <div class="mb-3">
                              <label for="recipient-name" class="col-form-label">Icon :</label>
                              <select style="font-family:'FontAwesome',Arial;font-size:16px;" type="text" class="wide form-control" id="icon" name="icon">
                                  <option value=""><i class='fas fa-icon-foo'>&#xf035;</i></option>
                              </select>
                              <div class="invalid-feedback" id="category_msg">
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
@include('backend.package.internal-assets.js.script')
@endsection