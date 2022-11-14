<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use DataTables;
use Validator;
use App\Models\Category;
use App\Models\SubCategory;
class BrandController extends Controller
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
        $category=SubCategory::all();
        // dd($category);
        if (request()->ajax()){
            $get=Brand::with('category');
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">
              <a data-url="'.route('admin.brand.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
              <a data-url="'.route('admin.brand.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
          </div>';
            return $button;
          })
          ->addColumn('subcategory',function($get){
            return $get->category->name_en;
        })
        ->addColumn('category',function($get){
            return $get->category->category->name_en;
        })
          ->rawColumns(['action','category'])->make(true);
        }
        return view('backend.brand.brand',compact('category'));
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
            'category'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $brand=new Brand;
            $brand->name_en=$request->name_en;
            $brand->name_bn=$request->name_bn;
            $brand->subcategory_id=$request->category;
            $brand->status=1;
            $brand->author_id=auth()->user()->id;
            $brand->save();
            if ($brand) {
                return response()->json(['message'=>'Brand Added Success']);
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
        return response()->json(Brand::find($id));
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
            'name_en'=>"required|max:200|min:1",
            'name_bn'=>"required|max:200|min:1",
            'category'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $brand=Brand::find($id);
            $brand->name_en=$request->name_en;
            $brand->name_bn=$request->name_bn;
            $brand->subcategory_id=$request->category;
            $brand->status=1;
            $brand->save();
            if ($brand) {
                return response()->json(['message'=>'Brand Updated Success']);
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
        $delete=Brand::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'Brand Deleted Success']);
        }else{
            return response()->json(['warning'=>'Something Problem here']);
        }
    }
}
