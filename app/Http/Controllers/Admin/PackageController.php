<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use DataTables;
use Validator;
class PackageController extends Controller
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
            $get=Package::query();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">
              <a data-url="'.route('admin.package.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
              <a data-url="'.route('admin.package.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
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
        return view('backend.package.package');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());
        $validator=Validator::make($request->all(),[
            'name'=>"required|max:200|min:1",
            'icon'=>"required|max:200|min:1",
            'price'=>"required|max:200|min:1",
            'days'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $package=new Package;
            $package->name=$request->name;
            $package->price=$request->price;
            $package->days=$request->days;
            $package->icon=$request->icon;
            $package->status=1;
            $package->save();
            if ($package) {
                return response()->json(['message'=>'Package Added Success']);
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
        return response()->json(Package::find($id));
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
            'icon'=>"required|max:200|min:1",
            'price'=>"required|max:200|min:1",
            'days'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $package=Package::find($id);
            $package->name=$request->name;
            $package->price=$request->price;
            $package->days=$request->days;
            $package->icon=$request->icon;
            $package->status=1;
            $package->save();
            if ($package) {
                return response()->json(['message'=>'Package updated Success']);
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
        //
    }
}
