@extends('layouts.adminlayout')
@section('content')  
    <div class="col-sm-9">
      <div class="well">
        <h4>Edit Category</h4>
      </div>
      <div class="row">
      <div class="col-sm-3 col-lg-10 ">
          <div class="well" style="margin-left:50px;">
            <form action="{{url('category')}}/{{$data->id}}" method="post">
            @method('PUT') 
            @csrf
                <label for="name" class="form-label">Category Name:</label>
                <input type="text" id="name" name="name" value="{{$data->name}}" class="form-control">
                <br>
                <label for="description" class="form-label">Category Description:</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="3">{{$data->description}}</textarea>
                <br>
                <button class="btn btn-primary">Submit</button>
            </form>
          </div>
    </div>   
@endsection     