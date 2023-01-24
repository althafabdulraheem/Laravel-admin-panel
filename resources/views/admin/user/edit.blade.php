@extends('layouts.adminlayout')
@section('content')  
    <div class="col-sm-9">
      <div class="well">
        <h4>Create User</h4>
      </div>
      <div class="row">
      <div class="col-sm-3 col-lg-10 ">
          <div class="well" style="margin-left:50px;">
            <form action="{{url('user')}}/{{$data->id}}" method="post">
                @csrf
                @method('PUT')
                @if(session()->get('success'))
                <div class="alert alert-info" role="alert">
                  {{session()->get('success')}}
                </div>
                @endif
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" value="{{$data->name}}" class="form-control" required>
                <br>
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" value="{{$data->email}}" name="email" class="form-control"required>
                @error('email')<p>{{$message}}</p>@enderror
                <br>
                <label for="category" class="form-label">Mobile </label>
                <input type="text" value="{{$data->mobile}}" pattern="[0-9]{10}" maxlength="10" id="category" name="mobile" class="form-control" required>
                <br>
                <label for="address" class="form-label">Address</label>
                <textarea name="address" id="address" class="form-control" cols="30" rows="4" required>{{$data->address}}</textarea>
                <br>
                @if($data->role=="0")
                <label for="admin" class="form-check-label">Admin</label>
                <input type="radio" id="admin" class="form-check-input" name="type" value="1">
                &nbsp<label for="user" class="form-check-label">User</label>
                <input type="radio"  id="user" class="form-check-input" checked name="type" value="0">
                @else
                <label for="admin" class="form-check-label">Admin</label>
                <input type="radio" id="admin" class="form-check-input" checked name="type" value="1">
                &nbsp<label for="user" class="form-check-label">User</label>
                <input type="radio"  id="user" class="form-check-input" name="type" value="0">
                @endif
                <br><br>
                <button class="btn btn-primary">Submit</button>
            </form>
            
          </div>
    </div>
       
@endsection  
