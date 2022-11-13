<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\BodyType;
use DataTables;
use Validator;

class BodyTypeController extends Controller
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
            $get=BodyType::with(['subcategory'])->get();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
                    $button  ='<div class="d-flex justify-content-center">
                    <a data-url="'.route('admin.body-type.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
                    <a data-url="'.route('admin.body-type.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
                </div>';
                    return $button;
              })
              ->addColumn('sub_cat',function($get){
                return $get->subcategory->name_en;
              })
          ->rawColumns(['action'])->make(true);
        }
        return view('backend.bodytype.bodytype',compact('category'));
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
            'name_en'=>"required|max:200|min:1|unique:body_types,name_en",
            'name_bn'=>"required|max:200|min:1|unique:body_types,name_bn",
            'subcategory'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $bodytype=new BodyType;
            $bodytype->name_en=$request->name_en;
            $bodytype->name_bn=$request->name_bn;
            $bodytype->subcategory_id=$request->subcategory;
            $bodytype->status=1;
            $bodytype->author_id=auth()->user()->id;
            $bodytype->save();
            if ($bodytype) {
                return response()->json(['message'=>'Body Type Added Success']);
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
        return response()->json(BodyType::find($id));
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
            'name_en'=>"required|max:200|min:1|unique:body_types,name_en,".$id,
            'name_bn'=>"required|max:200|min:1|unique:body_types,name_bn,".$id,
            'subcategory'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $bodytype=BodyType::find($id);
            $bodytype->name_en=$request->name_en;
            $bodytype->name_bn=$request->name_bn;
            $bodytype->subcategory_id=$request->subcategory;
            $bodytype->status=1;
            $bodytype->author_id=auth()->user()->id;
            $bodytype->save();
            if ($bodytype) {
                return response()->json(['message'=>'Body Type Updated Success']);
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
        $delete=BodyType::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'Body Type Deleted Success']);
        }else{
            return response()->json(['warning'=>'Something Problem here']);
        }
    }
}
