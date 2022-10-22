<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use DataTables;
class AdminReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->ajax()){
            $get=Report::with('post')->get();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">
                            <a data-url="'.route('admin.post.edit',$get->post->id).'"  href="'.route('admin.post.edit',$get->post->id).'" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
                            <a data-url="'.route('admin.report.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
                         </div>';
            return $button;
          })
        ->addColumn('status',function($get){
            switch ($get->post->status) {
                case 1:
                    return "<p style='background:blue;'>review</p>";
                    break;
                case 2:
                    return "<p style='background:green;'>Aproved</p>";
                    break;
                case 3:
                    return "<p style='background:grey;'>reject</p>";
                    break;
                case 4:
                    return "<p style='background:white;color:black;'>Need Edit</p>";
                    break;
                case 5:
                    return "<p style='background:red;'>Reported</p>";
                    break;
                case 6:
                    return "<p style='background:red;'>Deleted</p>";
                    break;
                case 7:
                    return "<p style='background:grey;'>Sold</p>";
                    break;
                default:
                    # code...
                    break;
            }
        })
          ->rawColumns(['action','status'])->make(true);
        }
        return view('backend.reports.report');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=Report::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'Report Deleted Success']);
        }else{
            return response()->json(['warning'=>'Something Problem here']);
        }
    }
}
