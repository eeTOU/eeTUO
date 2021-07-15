<!DOCTYPE html>
<html lang="en">
<head>
  <title>DEU-Ders Kayıt Sistemi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
  <style>

    body{
      font-family: "Lato", sans-serif;
    }

    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #212529 ;
      height: 100%;
      color: #fff;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    li.active {
      background-color: #eee;
      color: white;
    }

    a.hover {
      background-color: #eee;
      color: black;
    }
    li.a{
      color: white;
    }

    a{
      color: white;
    }

    .btn-warning:hover {
      color: #000;
      background-color: #ffca2c;
      border-color: #fff720;
    }

    .btn-warning {
      color: #000;
      background-color: #ffca2c;
      border-color: #ffc720;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
    <br>
      <h4>İşlemler Listesi</h4>
      @include('proUser.menu')
    </div>  

    <div class="col-sm-9">
      <h4><small>{{ $prouseremail or 'Default' }}</small></h4>
      <hr>
      @yield('content')
      
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>Footer Text</p>
</footer>

</body>
</html>
