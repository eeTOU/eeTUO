@extends('protect')

@section('content')

<div class="row">
    <div class="col-md-12">
    <br>
        <h3 class="center">Öğrenci Ekle</h3>
        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
        @endif
        @if(\Session::has('success'))
        <div class="alert alert-success" role="alert">
            <p>{{\Session::get('success')}}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <form method="post" id="create_form" action="{{url('student')}}">
            {{csrf_field()}}
            <div class="form-group">
                <input type="text" name="code" class="form-control" placeholder="Öğrenci Kodu Giriniz" />
            </div>
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="İsim Giriniz" />
            </div>
            <div class="form-group">
                <input type="text" name="surname" class="form-control" placeholder="Soyisim Giriniz" />
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="Mail Giriniz" />
            </div>
            <br>
            <button type='submit' class='btn btn-primary'>Ekle</button>
            
        </form>
    </div>
</div>

<script>

$(document).ready(function () {
    $('#create_form').validate({ 
        rules: {
            code: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10

            },
            name: {
                required: true,
                maxlength: 50,
                lettersonly: true
                
            },
            surname: {
                required: true,
                maxlength: 50,
                lettersonly: true
                
                
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            code: {
                digits: "Harf kullanamazsınız",
                minlength: "Minimum 10 basamaklı bir sayı giriniz",
                required: "Boş bırakamazsınız",
                maxlength: "Maksimim 10 basamaklı bir sayı giriniz"
            },
            name: {
                required: "Boş bırakamazsınız",
                maxlength: "Maksimum 50 haneli bir isim giriniz",
                lettersonly: "Lütfen sadece harf kullanın"
            },
            surname: {
                required: "Boş bırakamazsınız",
                maxlength: "Maksimum 50 haneli bir isim giriniz",
                lettersonly: "Lütfen sadece harf kullanın"
            },
            email: {
                required: "Boş bırakamazsınız",
                email:"Lütfen mail formatına uygun giriş yapın"
            }
        }
    });
});

$(document).ready(function(){
    $(".alert").alert('close')
});
</script>

@endsection