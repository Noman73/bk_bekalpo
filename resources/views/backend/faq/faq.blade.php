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
                    <h4 class="card-title ">Faq</h4>
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
                            <th>Question</th>
                            <th>Answer</th>
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
                            <div class="basic-form">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Question :</label>
                                    <input type="text" class="form-control" id="question" name="question" placeholder="Enter Question">
                                    <div class="invalid-feedback" id="question_msg">
                                    </div>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Answer :</label>
                                    <textarea class="form-control" name="answer" id="answer"  rows="10"></textarea>
                                    <div class="invalid-feedback" id="answer_msg">
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
{{-- <script src="{{asset('storage/admin/vendor/select2/js/select2.full.min.js')}}">
</script> --}}
@include('backend.faq.internal-assets.js.datatables')
@endsection