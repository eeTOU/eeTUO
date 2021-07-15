@extends('master')

@section('content')

<br>

<div class='container'>

    @if(session()->get('msg'))
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            {{ session()->get('msg')}}
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
    @endif
    

    <div class="sidenav">
         <div class="login-main-text">
            <h1>DOKUZ EYLÜL ÜNİVERSİTESİ<br></h1>
            <h3>Öğrenci İşleri Daire Başkanlığı</h3>
            <h5>Uzman Kullanıcı Girişi</h5>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
               <form action='checkLogin' method='post' enctype='multipart/form-data'>
                  <div class="form-group">
                     <label>Uzman Kullanıcı Mail Adresi</label>
                     <input type="text" class="form-control" name='prouser_email' placeholder="mail@deu.edu.tr" required>
                     <h7> Deneme-mail: uzmankullanici@deu.com</h7>
                  </div>
                  <div class="form-group">
                     <label>Parola</label>
                     <input type="password" class="form-control" name='prouser_password'placeholder="**********" required>
                     <h7> Deneme-parola: 1234</h7>
                  </div>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <a class="btn btn-secondary" href="{{ url('/') }}">Anasayfa</a>
                  <button type="submit" class="btn btn-secondary">Giriş</button>
                  <button type="submit" hidden class="btn btn-secondary">Register</button>
               </form>
            </div>
         </div>
      </div>

<style>

body {
    font-family: "Lato", sans-serif;
}

.main-head{
    height: 150px;
    background: #FFF;  
}
.sidenav {
    height: 100%;
    background-color: #000;
    overflow-x: hidden;
    padding-top: 20px;
}
.main {
    padding: 0px 10px;
}
@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
}
@media screen and (max-width: 450px) {
    .login-form{
        margin-top: 10%;
    }
    .register-form{
        margin-top: 10%;
    }
}
@media screen and (min-width: 768px){
    .main{
        margin-left: 40%; 
    }

    .sidenav{
        width: 40%;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
    }
    .login-form{
        margin-top: 80%;
    }

    .register-form{
        margin-top: 20%;
    }
}

.login-main-text{
    margin-top: 20%;
    padding: 60px;
    color: #fff;
}

.login-main-text h2{
    font-weight: 300;
}

.btn-black{
    background-color: #000 !important;
    color: #fff;
}
</style>

@stop