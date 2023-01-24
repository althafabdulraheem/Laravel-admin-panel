<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabs=['tab1'=>"",'tab2'=>"",'tab3'=>"",'tab4'=>'active'];
        return view('admin.category.index')->with($tabs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tabs=['tab1'=>"",'tab2'=>"",'tab3'=>"",'tab4'=>'active'];
        return view('admin.category.create')->with($tabs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=new Category();
        $data->name=$request->name;
        $data->description=$request->description;
        $data->created_by=Auth::user()->name;
        $data->save();
        return redirect('category/create')->with('success','created successfully');
    }

    public function fetchCategory()
    {
        $data=Category::all();
        return DataTables($data)
        ->addIndexColumn()
        ->addColumn('action',function($data)
        {
            
            $edit=url('category/'.$data->id.'/edit');
             return '<a href="'.$edit.'"  title="edit" value="'.$data->id.'" class="btn btn-secondary btn-sm text-white rounded-circle productEditBtn"   ><i class="fa fa-pencil"></i></a>
                    <button class="btn btn-danger btn-sm text-white deleteBtn"  title="delete" type="button"  value="'.$data->id.'" ><i class="fa fa-trash"></i></button> &nbsp';
        })
        
        ->setRowId(function ($data) {
            return "row_".$data->id;
      })

      ->rawColumns(['action'])
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Category::find($id);
        $tabs=['tab1'=>"",'tab2'=>"",'tab3'=>"",'tab4'=>'active'];
       return view('admin.category.edit',['data'=>$data])->with($tabs);
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
        $data=Category::find($id);
        $data->name=$request->name;
        $data->description=$request->description;
        $data->save();
        return redirect('category')->with('update','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $id=$request->id;
      $data=Category::find($id);
      $data->delete();
    }
}
