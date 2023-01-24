<!DOCTYPE html>
<html lang="en">
<head>
 @yield('title')
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100vh;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class=""><a href="{{url('dashboard')}}">Dashboard</a></li>
        @if(Auth::user()->role==1)
        
          <li class=""><a href="{{url('user')}}">User</a></li>
        @endif
        <li class=""><a href="{{url('product')}}">Product</a></li>
        <li class=""><a href="{{url('category')}}">Category</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2>Logo</h2>
      <ul class="nav nav-pills nav-stacked">
      <li class="{{$tab1}}"><a href="{{url('dashboard')}}">Dashboard</a></li>
      @if(Auth::user()->role==1)
        
          <li class="{{$tab2}}"><a href="{{url('user')}}">User</a></li>
      @endif
        <li class="{{$tab3}}"><a href="{{url('product')}}">Product</a></li>
        <li class="{{$tab4}}"><a href="{{url('category')}}">Category</a></li>
        <li><a href="{{url('logout-user')}}" style="font-weight:bold;">Logout <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
      </ul><br>
    </div>
    <br>
    @yield('content')
    @yield('scripts')
</body>
</html>
