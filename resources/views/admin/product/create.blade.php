@extends('layouts.adminlayout')
@section('content')  
    <div class="col-sm-9">
      <div class="well">
        <h4>Create Product</h4>
      </div>
      <div class="row">
      <div class="col-sm-3 col-lg-10 ">
          <div class="well" style="margin-left:50px;">
            <form action="{{url('product')}}" method="post">
              @csrf
                @if(session()->get('success'))
                <div class="alert alert-info" role="alert">
                  {{session()->get('success')}}
                </div>
                @endif
                <label for="product_name" class="form-label">Product Name:</label>
                <input type="text" id="product_name" name="product_name" class="form-control">
                <br>
                <label for="product_price" class="form-label">Product Price:</label>
                <input type="number" id="product_price" name="product_price" class="form-control">
                <br>
                <label for="category" class="form-label">Category Name:</label>
                <select name="category" id="" class="form-control">
                  <option value="" selected disabled>-Select Category-</option>
                  @foreach($categories as $catogery)
                  <option value="{{$catogery->id}}">{{$catogery->name}}</option>
                  @endforeach
                </select>
                <br>
                <button class="btn btn-primary">Submit</button>
            </form>
      </div>
    </div>   
@endsection     