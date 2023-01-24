@extends('layouts.adminlayout')
@section('content')  
    <div class="col-sm-9">
      <div class="well">
        <h4>Create Category</h4>
      </div>
      <div class="row">
      <div class="col-sm-3 col-lg-10 ">
          <div class="well" style="margin-left:50px;">
            <form action="{{url('category')}}" method="post">
              @csrf
              @if(session()->get('success'))
                <div class="alert alert-info" role="alert">
                  {{session()->get('success')}}
                </div>
                @endif
                <label for="name" class="form-label">Category Name:</label>
                <input type="text" id="name" name="name" class="form-control">
                <br>
                <label for="description" class="form-label">Category Description:</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="3"></textarea>
                <br>
                <button class="btn btn-primary">Submit</button>
            </form>
          </div>
    </div>   
@endsection     