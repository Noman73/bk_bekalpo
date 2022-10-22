<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BrandModel;
use App\Models\Brand;
use DataTables;
use Validator;
class ModelController extends Controller
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
        $brand=Brand::all();
        if (request()->ajax()){
            $get=BrandModel::query();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
                    $button  ='<div class="d-flex justify-content-center">
                    <a data-url="'.route('admin.model.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
                    <a data-url="'.route('admin.model.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
                </div>';
                    return $button;
              })
              ->addColumn('brand',function($get){
                   return $get->brand->name;
                })
          ->rawColumns(['action'])->make(true);
        }
        return view('backend.model.model',compact('brand'));
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
            'brand'=>"required|max:25|min:1",
            'model'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $model=new BrandModel;
            $model->brand_id=$request->brand;
            $model->name=$request->model;
            $model->status=1;
            $model->save();
            if ($model) {
                return response()->json(['message'=>'Model Added Success']);
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
        return response()->json(BrandModel::find($id));
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
            'brand'=>"required|max:25|min:1",
            'model'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $model=BrandModel::find($id);
            $model->brand_id=$request->brand;
            $model->name=$request->model;
            $model->status=1;
            $model->save();
            if ($model) {
                return response()->json(['message'=>'Model Added Success']);
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
        $delete=BrandModel::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'Model Deleted Success']);
        }else{
            return response()->json(['warning'=>'Something Problem here']);
        }
    }
}
