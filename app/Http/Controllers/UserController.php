<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabs=['tab1'=>"",'tab2'=>"active",'tab3'=>"",'tab4'=>''];
       return view('admin.user.index')->with($tabs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tabs=['tab1'=>"",'tab2'=>"active",'tab3'=>"",'tab4'=>''];
        return view('admin.user.create')->with($tabs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate(['email'=>'unique:users,email']);
       $data=new User();
       $data->name=$request->name;
       $data->email=$request->email;
       $data->mobile=$request->mobile;
       $data->password=bcrypt($request->mobile);
       $data->address=$request->address;
       $type=$request->type;
       if($type=="1")
       {
        $data->is_enabled="yes";
       }
       $data->role=$type;
       $data->save();
       return redirect('user/create')->with('success','created successfully');
    }

    public function fetchUser()
    {
        $data=User::all();
        return DataTables($data)
        ->addIndexColumn()
        ->addColumn('action',function($data)
        {
            if($data->role=="1")
            {
                $btnIsenable="";
            }
            elseif($data->is_enabled=="no")
            {
            $btnIsenable='<button class="btn btn-success btn-sm text-white enableBtn"  title="enable" type="button"  value="'.$data->id.'" >Enable</button>';
            }
            else{
                $btnIsenable='<button class="btn btn-danger btn-sm text-white disableBtn"  title="disable" type="button"  value="'.$data->id.'" >Disable</button>'; 
            }
            $edit=url('user/'.$data->id.'/edit');
            $show=route('user.show',$data->id);
             return '<a href="'.$edit.'"  title="edit" value="'.$data->id.'" class="btn btn-secondary btn-sm text-white rounded-circle productEditBtn"   ><i class="fa fa-pencil"></i></a>
                    <button class="btn btn-danger btn-sm text-white deleteBtn"  title="delete" type="button"  value="'.$data->id.'" ><i class="fa fa-trash"></i></button> &nbsp'.$btnIsenable;
        })
        ->addColumn('role',function($data)
        {
            if($data->role=="0")
            {
                return "user";
            }
            else{
                return "admin";
            }
        })
        ->setRowId(function ($data) {
            return "row_".$data->id;
      })

      ->rawColumns(['action'])
        ->make(true);
    }
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
       $data=User::find($id);
       $tabs=['tab1'=>"",'tab2'=>"active",'tab3'=>"",'tab4'=>''];
       return view('admin.user.edit',['data'=>$data])->with($tabs);
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
        
        $data=User::find($id);
        if($data->email!=$request->email)
        {
            $request->validate(['email'=>'unique:users,email']);

        }
        $data->name=$request->name;
        $data->email=$request->email;
        $data->mobile=$request->mobile;
        $data->password=bcrypt($request->mobile);
        $data->address=$request->address;
        $type=$request->type;
        if($type=="1")
        {
         $data->is_enabled="yes";
        }
        $data->role=$type;
        $data->save();
        return redirect('user')->with('update','updated successfully');
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
      $data=User::find($id);
      $data->delete();
    }
     
    public function enableUser(Request $request)
    {
        $id=$request->id;
        $data=User::find($id);
        $data->is_enabled="yes";
        $data->save();
    }

    public function disableUser(Request $request)
    {
        $id=$request->id;
        $data=User::find($id);
        $data->is_enabled="no";
        $data->save();
    }
}
