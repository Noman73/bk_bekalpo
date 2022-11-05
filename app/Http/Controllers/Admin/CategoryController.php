<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use DataTables;
use Validator;
class CategoryController extends Controller
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
        if (request()->ajax()){
            $get=Category::query();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">
              <a data-url="'.route('admin.category.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
              <a data-url="'.route('admin.category.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
          </div>';
            return $button;
          })
          ->addColumn('icon',function($get){
            $explode=explode('|',$get->icon);
            $icon="<i class='fa ".$explode[0]."'></i> ".$explode[0];
          return $icon;
        })
          ->rawColumns(['action','icon'])->make(true);
        }
        return view('backend.category.category');
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
            'icon'=>"required|max:200|min:1",
            'serial'=>"nullable|max:20|min:1",
        ]);

        if($validator->passes()){
            $category=new Category;
            $category->name_en=$request->name_en;
            $category->name_bn=$request->name_bn;
            $category->icon=$request->icon;
            $category->serial=$request->serial;
            $category->author_id=auth()->user()->id;
            $category->status=1;
            $category->save();
            if ($category) {
                return response()->json(['message'=>'Category Added Success']);
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
        return response()->json(Category::find($id));
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
        // return response()->json($request->all());
        $validator=Validator::make($request->all(),[
            'name_en'=>"required|max:200|min:1",
            'name_bn'=>"required|max:200|min:1",
            'icon'=>"required|max:200|min:1",
            'serial'=>"nullable|max:200|min:1",
        ]);

        if($validator->passes()){
            $category=Category::find($id);
            $category->name_en=$request->name_en;
            $category->name_bn=$request->name_bn;
            $category->icon=$request->icon;
            $category->serial=$request->serial;
            $category->author_id=auth()->user()->id;
            $category->status=1;
            $category->save();
            if ($category) {
                return response()->json(['message'=>'Category Updated Success']);
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
        $delete=Category::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'Category Deleted Success']);
        }else{
            return response()->json(['warning'=>'Something Problem here']);
        }
    }
    public function getData(Request $request){
        $data=DB::select("
            SELECT id,name from categories where name like :key limit 10
        ",['key'=>'%'.$request->searchTerm.'%']);
        foreach($data as $category){
            $arr[]=['id'=>$category->id,'text'=>$category->name];
        }
        return $arr;
    }
}