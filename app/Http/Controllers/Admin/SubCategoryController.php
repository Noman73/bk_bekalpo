<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use DB;
use DataTables;
use Validator;
class SubCategoryController extends Controller
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
        $category=Category::all();
        if (request()->ajax()){
            $get=SubCategory::with(['category'])->get();
            return DataTables::of($get)
              ->addIndexColumn()
              
              ->addColumn('action',function($get){
                    $button  ='<div class="d-flex justify-content-center">
                    <a data-url="'.route('admin.sub-category.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
                    <a data-url="'.route('admin.sub-category.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
                </div>';
                    return $button;
              })
              ->addColumn('cat_name',function($get){
                return $get->category->name_en;
              })
          ->rawColumns(['action'])->make(true);
        }
        return view('backend.sub-category.sub_category',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json([$request->all()]);
        $validator=Validator::make($request->all(),[
            'sub_category_name_en'=>"required|max:200|min:1",
            'sub_category_name_bn'=>"required|max:200|min:1",
            'category'=>"required|max:20|min:1",
        ]);

        if($validator->passes()){
            $category=new SubCategory;
            $category->category_id=$request->category;
            $category->name_en=$request->sub_category_name_en;
            $category->name_bn=$request->sub_category_name_bn;
            $category->status=1;
            $category->save();
            if ($category) {
                return response()->json(['message'=>'Sub Category Added Success']);
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
        return response()->json(SubCategory::with(['category'])->find($id));
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
        // return $request->all();
        $validator=Validator::make($request->all(),[
            'sub_category_name_en'=>"required|max:200|min:1",
            'sub_category_name_bn'=>"required|max:200|min:1",
            'category'=>"required|max:20|min:1",
        ]);

        if($validator->passes()){
            $category=SubCategory::find($id);
            $category->category_id=$request->category;
            $category->name_en=$request->sub_category_name_en;
            $category->name_bn=$request->sub_category_name_bn;
            $category->status=1;
            $category->save();
            if ($category) {
                return response()->json(['message'=>'Sub Category Updated Success']);
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
        $delete=SubCategory::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'Sub Category Deleted Success']);
        }else{
            return response()->json(['warning'=>'Something Problem here']);
        }
    }
}
