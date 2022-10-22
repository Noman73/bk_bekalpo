<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Featured;
use App\Models\Package;
use DataTables;
use Validator;
use Carbon\Carbon;
class FeatureApprovalController extends Controller
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
            $get=Featured::with('post')->get();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">
              <a data-url="'.route('admin.feature_request.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
              <a data-url="'.route('admin.feature_request.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
          </div>';
            return $button;
          })
          ->addColumn('title',function($get){
            return (isset($get->post->title) ? $get->post->title: '');
        })
        ->addColumn('status',function($get){
            switch ($get->post->status) {
                case 1:
                   return 'Reviewing';
                    break;
                case 2:
                   return 'Aproved';
                    break;
                case 3:
                   return 'Rejected';
                    break;
                case 4:
                   return 'Need Edit';
                    break;
                case 5:
                   return 'Hard Reject';
                    break;
                case 6:
                   return 'Sold';
                    break;
                case 7:
                   return 'Permanently Deleted';
                    break;
                default:
                    # code...
                    break;
            }
        })
        ->addColumn('package_name',function($get){
            return $get->package->name;
        })
        ->addColumn('days',function($get){
            return $get->package->days;
        })
        ->addColumn('promote_status',function($get){
            return ($get->status==0 ? "Inaproved":"Aproved");
        })
          ->rawColumns(['action'])->make(true);
        }
        return view('backend.feature_request.feature_request');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());
        $validator=Validator::make($request->all(),[
            'action'=>"required|max:1|min:1",
        ]);
        if($validator->passes()){
           return  $feature=Featured::find($request->post_id);
            $feature->status=1;
           return $day=Package::where('id',$feature->package_id)->first()->days;
            $mutable=Carbon::now();
            return $end_date=$mutable->add($day,'day');

            $feature->end_ad_at=$end_date;
            $feature->save();
            if ($feature) {
                return response()->json(['message'=>'Aproved Success']);
            }
        }
        return response()->json(['error'=>$validator->getMessageBag()]);
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
        return response()->json(Featured::find($id));
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
        $validator=Validator::make($request->all(),[
            'action'=>"required|max:1|min:1",
        ]);
        if($validator->passes()){
            $feature=Featured::find($id);
            $feature->status=$request->action;
            $day=Package::where('id',$feature->package_id)->first()->days;
            $mutable=Carbon::now();
            $end_date=$mutable->add($day,'day');

            $feature->end_ad_at=$end_date;
            $feature->save();
            if ($feature) {
                return response()->json(['message'=>'Aproved Success']);
            }
        }
        return response()->json(['error'=>$validator->getMessageBag()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
