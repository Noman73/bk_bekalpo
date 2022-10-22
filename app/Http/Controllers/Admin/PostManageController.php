<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use DataTables;
use Validator;
class PostManageController extends Controller
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
        if (request()->ajax()){
            $get=Post::with('category','subcategory','division','district')->orderBy('status','asc')->get();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">
                            <a data-url="'.route('admin.post.edit',$get->id).'"  href="'.route('admin.post.edit',$get->id).'" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
                            <a data-url="'.route('admin.post.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>
                        </div>';
            return $button;
          })
          ->addColumn('category',function($get){
          return $get->category->name;
        })
        ->addColumn('subcategory',function($get){
            return $get->subcategory->name;
        })
        ->addColumn('division',function($get){
            return $get->division->name;
        })
        ->addColumn('district',function($get){
            return $get->district->name;
        })
        ->addColumn('status',function($get){
            switch ($get->status) {
                case 1:
                    return "<p style='background:blue;'>review</p>";
                    break;
                case 2:
                    return "<p style='background:green;'>Aproved</p>";
                    break;
                case 3:
                    return "<p style='background:grey;'>reject</p>";
                    break;
                case 4:
                    return "<p style='background:white;color:black;'>Need Edit</p>";
                    break;
                case 5:
                    return "<p style='background:red;'>Reported</p>";
                    break;
                case 6:
                    return "<p style='background:red;'>Deleted</p>";
                    break;
                case 7:
                    return "<p style='background:grey;'>Sold</p>";
                    break;
                default:
                    # code...
                    break;
            }
        })
          ->rawColumns(['action','status'])->make(true);
        }
        return view('backend.post.post');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $post=Post::with('permission','division','district','brand','model','images')->where('id',$id)->first();
        // $rel_product=Post::with('images','division','district')->where('id', '<>',$id)->get();
        return view('backend.single-ad.single-ad',compact('post'));
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
            'action'=>'required|numeric'
        ]);
        if ($validator->passes()) {
            $post=Post::find($id);
            $post->status=$request->action;
            if($post->published_at==null){
                $post->published_at=\Carbon\Carbon::now();
            }
            $post->save();
            if ($post) {
                return redirect(route('admin.post.index'));
            }
        }
        return redirect()->back()->withErrors($validator);
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
