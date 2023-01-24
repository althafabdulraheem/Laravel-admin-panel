<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $tabs=['tab1'=>"",'tab2'=>"",'tab3'=>"active",'tab4'=>''];
       return view('admin.product.index')->with($tabs);
    }
    public function fetchProduct()
    {
        $data=Product::all();
        return DataTables($data)
        ->addIndexColumn()
        ->addColumn('price',function($data)
        {
            return "Rs.".$data->price;
        })
        ->addColumn('category',function($data)
        {
            return Category::getCategory($data->category);
        })
        ->addColumn('action',function($data)
        {
            
            $edit=url('product/'.$data->id.'/edit');
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $tabs=['tab1'=>"",'tab2'=>"",'tab3'=>"active",'tab4'=>''];
        return view('admin.product.create',['categories'=>$categories])->with($tabs);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=new Product();
        $data->product_name=$request->product_name;
        $data->category=$request->category;
        $data->price=$request->product_price;
        $data->save();
        return redirect('product/create')->with('success','created successfully');
    }

    /**

     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Product::with('getCategory')->find($id);
        $categories=Category::all();
        $tabs=['tab1'=>"",'tab2'=>"",'tab3'=>"active",'tab4'=>''];
       return view('admin.product.edit',['data'=>$data,'categories'=>$categories])->with($tabs);
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
        $data=Product::find($id);
        $data->product_name=$request->product_name;
        $data->category=$request->category;
        $data->price=$request->product_price;
        $data->save();
        return redirect('product')->with('update','updated successfully');
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
        $data=Product::find($id);
        $data->delete();

    }
}
