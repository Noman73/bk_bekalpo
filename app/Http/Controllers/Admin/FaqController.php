<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use DataTables;
use Validator;
class FaqController extends Controller
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
        $faq=Faq::all();
        if (request()->ajax()){
            $get=Faq::all();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
                    $button  ='<div class="d-flex justify-content-center">
                    <a data-url="'.route('admin.faq.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
                    <a data-url="'.route('admin.faq.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
                </div>';
                    return $button;
              })
          ->rawColumns(['action'])->make(true);
        }
        return view('backend.faq.faq',compact('faq'));
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
            'question'=>"required|max:500|min:1",
            'answer'=>"required|max:5000|min:1",
        ]);

        if($validator->passes()){
            $category=new Faq;
            $category->question=$request->question;
            $category->answer=$request->answer;
            $category->author_id=auth()->user()->id;
            $category->save();
            if ($category) {
                return response()->json(['message'=>'Faq Added Success']);
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(Faq::find($id));
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
            'question'=>"required|max:500|min:1",
            'answer'=>"required|max:5000|min:1",
        ]);

        if($validator->passes()){
            $category=Faq::find($id);
            $category->question=$request->question;
            $category->answer=$request->answer;
            $category->author_id=auth()->user()->id;
            $category->save();
            if ($category) {
                return response()->json(['message'=>'Faq Updated Success']);
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
