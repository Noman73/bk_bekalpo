<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\FuelType;
use DataTables;
use Validator;
class FuelController extends Controller
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
            $get=FuelType::with(['subcategory'])->get();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
                    $button  ='<div class="d-flex justify-content-center">
                    <a data-url="'.route('admin.fuel.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
                    <a data-url="'.route('admin.fuel.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
                </div>';
                    return $button;
              })
              ->addColumn('sub_cat',function($get){
                return $get->subcategory->name_en;
              })
          ->rawColumns(['action'])->make(true);
        }
        return view('backend.fuel.fueltype',compact('category'));
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
            'name_en'=>"required|max:200|min:1|unique:fuel_types,name_en",
            'name_bn'=>"required|max:200|min:1|unique:fuel_types,name_bn",
            'subcategory'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $fuel=new FuelType;
            $fuel->name_en=$request->name_en;
            $fuel->name_bn=$request->name_bn;
            $fuel->subcategory_id=$request->subcategory;
            $fuel->status=1;
            $fuel->author_id=auth()->user()->id;
            $fuel->save();
            if ($fuel) {
                return response()->json(['message'=>'Fuel Type Added Success']);
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
        return response()->json(FuelType::find($id));
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
            'name_en'=>"required|max:200|min:1|unique:fuel_types,name_en,".$id,
            'name_bn'=>"required|max:200|min:1|unique:fuel_types,name_bn,".$id,
            'subcategory'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $fuel=FuelType::find($id);
            $fuel->name_en=$request->name_en;
            $fuel->name_bn=$request->name_bn;
            $fuel->subcategory_id=$request->subcategory;
            $fuel->status=1;
            $fuel->author_id=auth()->user()->id;
            $fuel->save();
            if ($fuel) {
                return response()->json(['message'=>'Fuel Type Updated Success']);
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
        $delete=FuelType::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'Body Type Deleted Success']);
        }else{
            return response()->json(['warning'=>'Something Problem here']);
        }
    }
}
