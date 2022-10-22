@extends('layouts.admin.admin-master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row separate-row">
                                <div class="col-sm-6">
                                    <div class="job-icon pb-4 d-flex justify-content-between">
                                        <div>
                                            <div class="d-flex align-items-center mb-1">
                                                <h2 class="mb-0">{{App\Models\Post::where('status',2)->count()}}</h2>
                                            </div>  
                                            <span class="fs-14 d-block mb-2">Total Published Ads</span>
                                        </div>  
                                        <div id="NewCustomers"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="job-icon pb-4 pt-4 pt-sm-0 d-flex justify-content-between">
                                        <div>
                                            <div class="d-flex align-items-center mb-1">
                                                <h2 class="mb-0">{{App\Models\Post::where('status',1)->count()}}</h2>
                                            </div>  
                                            <span class="fs-14 d-block mb-2">Total Reviewing Ads</span>
                                        </div>  
                                        <div id="NewCustomers1"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="job-icon pt-4 pb-sm-0 pb-4 pe-3 d-flex justify-content-between">
                                        <div>
                                            <div class="d-flex align-items-center mb-1">
                                                <h2 class="mb-0">{{App\Models\User::where('status',1)->count()}}</h2>
                                            </div>  
                                            <span class="fs-14 d-block mb-2">Total Active User</span>
                                        </div>  
                                        <div id="NewCustomers2"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="job-icon pt-4  d-flex justify-content-between">
                                        <div>
                                            <div class="d-flex align-items-center mb-1">
                                                <h2 class="mb-0">{{App\Models\Category::where('status',1)->count()}}</h2>
                                            </div>  
                                            <span class="fs-14 d-block mb-2">Total Categories</span>
                                        </div>  
                                        <div id="NewCustomers3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
            </div>  
        </div>
      </div>
</div>
@endsection
