<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemType;
use DataTables;
use App\Models\SubCategory;
use Validator;
class ItemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
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
        $category=SubCategory::all();
        if (request()->ajax()){
            $get=ItemType::with(['subcategory'])->get();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
                    $button  ='<div class="d-flex justify-content-center">
                    <a data-url="'.route('admin.item_type.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
                    <a data-url="'.route('admin.item_type.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
                </div>';
                    return $button;
              })
              ->addColumn('sub_cat',function($get){
                return $get->subcategory->name;
              })
          ->rawColumns(['action','sub_cat'])->make(true);
        }
        return view('backend.item_type.item_type',compact('category'));
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
            'name'=>"required|max:200|min:1",
            'subcategory'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $type=new ItemType;
            $type->name=$request->name;
            $type->subcategory_id=$request->subcategory;
            $type->status=1;
            $type->author_id=auth()->user()->id;
            $type->save();
            if ($type) {
                return response()->json(['message'=>'Item Type Added Success']);
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
        return response()->json(ItemType::find($id));
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
            $type=ItemType::find($id);
            $type->name=$request->name;
            $type->subcategory_id=$request->subcategory;
            $type->status=1;
            $type->author_id=auth()->user()->id;
            $type->save();
            if ($type) {
                return response()->json(['message'=>'Item Type Updated Success']);
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
        $delete=ItemType::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'Item Type Deleted Success']);
        }else{
            return response()->json(['warning'=>'Something Problem here']);
        }
    }
}
