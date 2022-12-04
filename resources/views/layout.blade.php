<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Todo App</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/app.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="/assets/img/iconT.png" rel="icon">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
@if (auth()->user())
  <nav class="navbar navbar-expand-lg container-fluid navbar-light bg-light"> 
    <div class="container">
  <div>
     <h2><img src="assets/img/iconT.png" alt="" style="width: 40px;"><span style="color: #1746A2; font-size: 25px;"> Todo</span> <span style="font-size: 25px;">App</span></h2>
  </div>
    <!-- <a class="btn btn-outline-danger ms-auto" type="submit" href="{{route('logout')}}">Logout</a> -->
  </div>
  <!-- Example single danger button -->
<div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle rounded-pill" data-bs-toggle="dropdown" aria-expanded="false">
    Galih Ikhtiar
  </button>
  <div class="dropdown-menu">
    <li><a class="dropdown-item" href="{{route('logout')}}"><i class="fa fa-power-off"></i> Logout</a></li>
  </div>
</div>
  
  </nav>
  @endif
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>