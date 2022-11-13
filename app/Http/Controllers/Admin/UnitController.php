<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Unit;
use DataTables;
use Validator;

class UnitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $category=SubCategory::all();
        if (request()->ajax()){
            $get=Unit::with(['subcategory'])->get();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
                    $button  ='<div class="d-flex justify-content-center">
                    <a data-url="'.route('admin.unit.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
                    <a data-url="'.route('admin.unit.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
                </div>';
                    return $button;
              })
              ->addColumn('sub_cat',function($get){
                return $get->subcategory->name_en;
              })
          ->rawColumns(['action'])->make(true);
        }
        return view('backend.unit.unit',compact('category'));
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
            'name_en'=>"required|max:200|min:1|unique:units,name_en",
            'name_bn'=>"required|max:200|min:1|unique:units,name_bn",
            'subcategory'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $unit=new Unit;
            $unit->name_en=$request->name_en;
            $unit->name_bn=$request->name_bn;
            $unit->subcategory_id=$request->subcategory;
            $unit->status=1;
            $unit->author_id=auth()->user()->id;
            $unit->save();
            if ($unit) {
                return response()->json(['message'=>'Unit Type Added Success']);
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
        return response()->json(Unit::find($id));
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
            'name'=>"required|max:200|min:1",
            'subcategory'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $unit=Unit::find($id);
            $unit->name=$request->name;
            $unit->subcategory_id=$request->subcategory;
            $unit->status=1;
            $unit->author_id=auth()->user()->id;
            $unit->save();
            if ($unit) {
                return response()->json(['message'=>'Unit Type Added Success']);
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
        $delete=Unit::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'Body Type Deleted Success']);
        }else{
            return response()->json(['warning'=>'Something Problem here']);
        }
    }
}
