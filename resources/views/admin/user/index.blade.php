@extends('layouts.adminlayout')
@section('content')
<div class="col-sm-9">
      <div class="well">
        <h4>Users List</h4>
      </div>
      @if(session()->get('update'))
                <div class="alert alert-info" role="alert">
                  {{session()->get('update')}}
                </div>
     @endif
      <div class="row">
        <div class="col-sm-12">
            <div class="text-right">
                <a href="{{url('user/create')}}" class="btn btn-primary">Create</a>
            </div>
        </div>
        <div class="table-wrapper" style="margin-top:75px; background-color:#f1f1f1;font-weight:bold;">
            <table class="table table-striped" id="table">
                <thead>
                    <tr>
                        <td>S.No</td>
                        <td>Name</td>
                        <td>Address</td>
                        <td>Role</td>
                        <td>Action</td>
                    </tr>
                </thead>
            </table>
        </div>  
      </div>
    </div>   
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

<script>
    let table=$("#table").DataTable({
        processing: true,
        serverSide: true,
        ajax:"{{url('fetch-user')}}",
        columns:[
            {data:'DT_RowIndex', name:'DT_RowIndex'},
            {data:'name',name:'name'},
            {data:'address',name:'address'},
            {data:'role',name:'role'},
            {data:'action',name:'action'}
        ],
        searching:false
    });
    $(document).on('click','.deleteBtn',function()
    {
        let check=confirm('Are You Sure Want To Delete');
        let id=$(this).val();
        if(check)
        {
           $.ajax({
            url:"{{url('user/delete')}}",
            type:"DELETE",
            data:{'id':id,'_token':"{{csrf_token()}}"},
            success:function()
            {
                alert("successfully deleted");
                table.draw();
            }
           });
        }
    });
    $(document).on('click','.enableBtn',function()
    {
        let id=$(this).val();
       
           $.ajax({
            url:"{{route('enable')}}",
            type:"get",
            data:{'id':id,'_token':"{{csrf_token()}}"},
            success:function()
            {
                alert("successfully enabled");
                table.draw();
            }
           });
        
    });
    $(document).on('click','.disableBtn',function()
    {
        let id=$(this).val();
       
           $.ajax({
            url:"{{route('disable')}}",
            type:"get",
            data:{'id':id,'_token':"{{csrf_token()}}"},
            success:function()
            {
                alert("successfully disabled");
                table.draw();
            }
           });
        
    });
</script>
@endsection