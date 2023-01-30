<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Login | Admin-Panel</title>
</head>
<style>
    #form{
        height:100vh;
        
    }
    input[type=submit]
    {
        margin-top:20px;
        margin-left:10px;
    }
    input[type=submit]:hover
    {
        background-color:white;
        color:blue;
    }
    .wrapper{
        background-color: #958e8e14;
       padding: 50px;
        }

</style>
<body>
    <div class="container">
          <div class="d-flex justify-content-center align-items-center" id="form">
           <div class="wrapper">   
                <form action="{{route('login')}}" method="post">
                @csrf
                @if(session()->get('msg')!="")
                <div class="alert alert-danger" role="alert">
                   {{session()->get('msg')}}
                </div>
                @endif
                <div class="form-floating">
                <input type="text" id="uname" name="email"  class="form-control" required placeholder="uname">
                    <label for="uname">Email</label>
                    </div>
                    <br>  
                <div class="form-floating">
                        <input type="password" id="password" name="password" class="form-control" placeholder="passord" required>
                            <label for="password">Password</label>
                </div>    
                    <input type="submit" class="btn btn-primary btn-lg" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: 6rem;">
                </form>
          </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>