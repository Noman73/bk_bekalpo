@extends('layouts.admin.admin-master')
@section('link')
<link href="{{asset('storage/admin/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<script type="text/javascript" src="https://js.nicedit.com/nicEdit-latest.js"></script>
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
                    <h4 class="card-title ">About Us</h4>
                </div>
                <div class="col-6 ">
                    <button class="btn btn-sm btn-primary float-end" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" id="modalBtn"><i class="fas fa-plus text-light"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                  <textarea class="form-control" name="" id="description" cols="30" rows="10">{{$data}}</textarea>
                  <div class="invalid-feedback">
                  </div>
                </div>
                <button type="button" class="btn btn-primary mt-4" onclick="formRequest()">Submit</button>
                {{-- modal start --}}
                {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Add New City</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <input type="hidden" name='id' id="id"> 
                            <div class="mb-3">

                                
                              <label for="recipient-name" class="col-form-label">Name :</label>
                              <textarea type="text" rows="6" class="form-control" id="summernote" name="editordata"> placeholder="Enter City Name "></textarea>
                              <div class="invalid-feedback" id="name_msg">
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
                  </div> --}}
                {{-- modal end --}}
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{asset('storage/admin/vendor/datatables/js/jquery.dataTables.min.js')}}">
</script>
<script src="{{asset('storage/dependencies/texteditor/texteditor.js')}}">
</script>
@include('backend.about_us.internal-assets.js.script');
<script>
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
@endsection