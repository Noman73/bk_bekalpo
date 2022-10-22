<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Company;
use DataTables;
use Storage;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        if (request()->ajax()){
            $get=Company::all();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">
              <a data-url="'.route('admin.company.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
              <a data-url="'.route('admin.company.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
          </div>';
            return $button;
          })
          ->addColumn('logo',function($get){
            return "<img style='width:70;height:70px;' src='".asset('storage/logo').'/'.$get->logo."'>";
        })
        ->addColumn('icon',function($get){
            return "<img style='width:70;height:70px;' src='".asset('storage/logo').'/'.$get->icon."'>";
        })
          ->rawColumns(['action','logo','icon'])->make(true);
        }
        return view('backend.company.company');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'name'=>"required|max:200|min:1|max:200",
            'title'=>"required|max:200|min:1|max:200",
            'logo'=>"nullable|image|mimes:jpeg,png,jpg,svg|max:2024",
            'icon'=>"nullable|image|mimes:jpeg,png,jpg,svg|max:2024",
        ]);
        if($validator->passes()){
            // $company=new Company;
            if ($request->hasFile('logo')){
                $ext=$request->logo->getClientOriginalExtension();
                $logo_name=auth()->user()->id.'_'.str_replace(" ","_",$request->name).'_logo_'.time().'.'.$ext;
                $logo=$logo_name;
            }else{
                $logo=null;
            }
            if ($request->hasFile('icon')){
                $ext=$request->icon->getClientOriginalExtension();
                $icon_name=auth()->user()->id.'_'.str_replace(" ","_",$request->name).'_icon_'.time().'.'.$ext;
                $icon=$icon_name;
            }else{
                $icon=null;
            }
            $id=Company::first();
            // return var_dump($id);
            if($id!=null){
                $insert=Company::find($id->id);
                $insert->company_name=$request->name;
                $insert->title=$request->title;
                $insert->author_id=auth()->user()->id;
                $insert->logo=$icon;
                $insert->icon=$logo;
                $insert->save();
            }else{
                $insert=new Company;
                $insert->company_name=$request->name;
                $insert->title=$request->title;
                $insert->author_id=auth()->user()->id;
                $insert->logo=$icon;
                $insert->icon=$logo;
                $insert->save();
            }
            // $insert=Company::updateOrCreate(
            // ['id'=>$id->id],
            // [
            //     'company_name'=>$request->name,
            //     'title'=>$request->title,
            //     'author_id'=>auth()->user()->id,
            //     'logo'=>$logo,
            //     'icon'=>$icon,
            // ]
            // );
            if ($insert){
                if($request->hasFile('icon') && $id!=null){
                    $icon_path=storage_path('app/public/logo/'.$id->icon);
                    unlink($icon_path);
                }
                if($request->hasFile('logo') && $id!=null){
                    $logo_path=storage_path('app/public/logo/'.$id->logo);
                    unlink($logo_path);
                }
                $request->icon->storeAs('public/logo',$logo_name);
                $request->logo->storeAs('public/logo',$icon_name);
                return response()->json(['message'=>'Company Added Success']);
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
        //
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
        //
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
