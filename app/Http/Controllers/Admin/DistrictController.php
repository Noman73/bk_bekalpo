<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use DataTables;
use Validator;
use App\Models\District;
class DistrictController extends Controller
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
        $division=Division::all();
        if (request()->ajax()){
            $get=District::query();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">
              <a data-url="'.route('admin.areas.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
              <a data-url="'.route('admin.areas.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
          </div>';
            return $button;
          })
          ->addColumn('division',function($get){
            return $get->division->name_en;
        })
        ->addColumn('city',function($get){
            return ($get->city==1 ? "City": "Area");
        })
          ->rawColumns(['action','division','city'])->make(true);
        }
        return view('backend.district.district',compact('division'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name_en'=>"required|max:200|min:1",
            'name_bn'=>"required|max:200|min:1",
            'cities'=>"required|max:200|min:1",
            'city'=>"nullable|max:200|min:1",
        ]);

        if($validator->passes()){
            $district=new District;
            $district->division_id=$request->cities;
            $district->name_en=$request->name_en;
            $district->name_bn=$request->name_bn;
            $district->city=$request->city;
            $district->author_id=auth()->user()->id;
            $district->status=1;
            $district->save();
            if ($district) {
                return response()->json(['message'=>'Division Added Success']);
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
        return response()->json(District::find($id));
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
            'name_en'=>"required|max:200|min:1|unique:districts,name_en,".$id,
            'name_bn'=>"required|max:200|min:1|unique:districts,name_bn,".$id,
            'cities'=>"required|max:200|min:1",
            'city'=>"nullable|max:200|min:1",
        ]);

        if($validator->passes()){
            $district=District::find($id);
            $district->division_id=$request->cities;
            $district->name_en=$request->name_en;
            $district->name_bn=$request->name_bn;
            $district->city=$request->city;
            $district->author_id=auth()->user()->id;
            $district->status=1;
            $district->save();
            if ($district) {
                return response()->json(['message'=>'Division Updated Success']);
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
        $delete=District::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'District Deleted Success']);
        }else{
            return response()->json(['warning'=>'Something Problem here']);
        }
    }
}
