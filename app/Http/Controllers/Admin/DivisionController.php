<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use DataTables;
use Validator;
class DivisionController extends Controller
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
        if (request()->ajax()){
            $get=Division::query();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
                        $button  ='<div class="d-flex justify-content-center">
                        <a data-url="'.route('admin.cities.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
                        <a data-url="'.route('admin.cities.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
                    </div>';
            return $button;
          })
          ->rawColumns(['action'])->make(true);
        }
        return view('backend.division.division');
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
            'name_en'=>"required|max:200|min:1|unique:divisions,name_en",
            'name_bn'=>"required|max:200|min:1|unique:divisions,name_bn",
        ]);

        if($validator->passes()){
            $division=new Division;
            $division->name_en=$request->name_en;
            $division->name_bn=$request->name_bn;
            $division->author_id=auth()->user()->id;
            $division->status=1;
            $division->save();
            if ($division) {
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
        return response()->json(Division::find($id));
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
        ]);

        if($validator->passes()){
            $division=Division::find($id);
            $division->name_en=$request->name_en;
            $division->name_bn=$request->name_bn;
            $division->author_id=auth()->user()->id;
            $division->status=1;
            $division->save();
            if ($division) {
                return response()->json(['message'=>'Division Uodated Success']);
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
        $delete=Division::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'Division Deleted Success']);
        }else{
            return response()->json(['warning'=>'Something Problem here']);
        }
    }
}
