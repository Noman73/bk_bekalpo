<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\SubCategory;
use App\Models\FieldPermission;
use DataTables;
use Validator;
use App\Models\District;
class FieldPermissionController extends Controller
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
        $fields=Schema::getColumnListing('posts');
        $fields=array_diff($fields, ['id','created_at','updated_at']);
        // dd($fields);
        if (request()->ajax()){
            $get=fieldPermission::with('subcategory')->get();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button ='<div class="d-flex justify-content-center">
              <a data-url="'.route('admin.field_permission.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
              <a data-url="'.route('admin.field_permission.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
          </div>';
            return $button;
        })
        ->addColumn('sub_cat',function($get){
            return $get->subcategory->name;
        })
        ->addColumn('status',function($get){
            return ($get->status==1 ? 'On' : 'Off');
        })
        ->addColumn('field_name',function($get){
            return ucwords( str_replace('id','',str_replace("_"," ",$get->field_name)) );
        })
        ->rawColumns(['action','sub_cat'])->make(true);
        }
        return view('backend.field_permission.field_permission',compact('fields','category'));
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
            'field'=>"required|max:200|min:1",
            'category'=>"required|max:200|min:1",
            'status'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $field=new FieldPermission;
            $field->subcategory_id=$request->category;
            $field->field_name=$request->field;
            $field->author_id=auth()->user()->id;
            $field->status=$request->status;
            $field->save();
            if ($field) {
                return response()->json(['message'=>'Permission Added Success']);
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
        return response()->json(FieldPermission::find($id));
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
            'field'=>"required|max:200|min:1",
            'category'=>"required|max:200|min:1",
            'status'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $field=FieldPermission::find($id);
            $field->subcategory_id=$request->category;
            $field->field_name=$request->field;
            $field->author_id=auth()->user()->id;
            $field->status=$request->status;
            $field->save();
            if ($field) {
                return response()->json(['message'=>'Permission Updated Success']);
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
        $delete=FieldPermission::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'Feature Deleted Success']);
        }else{
            return response()->json(['warning'=>'Something Problem here']);
        }
    }
}
