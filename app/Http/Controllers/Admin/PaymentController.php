<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentGateway;
use Validator;
use DataTables;
class PaymentController extends Controller
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
            $get=PaymentGateway::query();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">
              <a data-url="'.route('admin.payment.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
              <a data-url="'.route('admin.payment.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
          </div>';
            return $button;
          })
          ->addColumn('type',function($get){
            if($get->type==0){
                return "Personal";
            }elseif($get->type==1){
                return "Agent";
            }else{
                return '';
            }
        })
        ->rawColumns(['action','type'])->make(true);
        }
        return view('backend.payment.payment');
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
            'number'=>"required|max:11|min:11",
            'type'=>"required|max:1|min:1",
        ]);

        if($validator->passes()){
            $package=new PaymentGateway;
            $package->name=$request->name;
            $package->number=$request->number;
            $package->type=$request->type;
            $package->status=1;
            $package->author_id=auth()->user()->id;
            $package->save();
            if ($package) {
                return response()->json(['message'=>'Payment Added Success']);
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
        return response()->json(PaymentGateway::find($id));
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
            'number'=>"required|max:12|min:11",
            'type'=>"required|max:1|min:1",
        ]);
        if($validator->passes()){
            $package=PaymentGateway::find($id);
            $package->name=$request->name;
            $package->number=$request->number;
            $package->type=$request->type;
            $package->status=1;
            $package->author_id=auth()->user()->id;
            $package->save();
            if ($package) {
                return response()->json(['message'=>'Payment Updated Success']);
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
        $delete=PaymentGateway::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'Payment Deleted Success']);
        }else{
            return response()->json(['warning'=>'Something Problem here']);
        }
    }
}
