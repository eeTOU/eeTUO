@extends('protect')

@section('content')

<div class="row">
    <div class="col-md-12">
    <br>
        <h3 class="center">Öğretim Görevlisi Ekle</h3>
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
        <form method="post" id="create_form" action="{{url('facultyMember')}}">
            {{csrf_field()}}
            <div class="form-group">
                <input type="text" name="code" class="form-control" placeholder="Ögr. Kodu Giriniz" />
            </div>
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="İsim Giriniz" />
            </div>
            <div class="form-group">
                <input type="text" name="surname" class="form-control" placeholder="Soyisim Giriniz" />
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="mail@mail.com" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" />
            </div>
            <div class="form-group">
                <input type="date" name="startdate" id='datepicker' class="form-control" placeholder="Başlama Tarihi Giriniz." />
            </div>
            <br>
            <button type='submit' class='btn btn-primary'>Ekle</button>
            
        </form>
    </div>
</div>

<script>

$(document).ready(function () {
    $('#create_form').validate({ // initialize the plugin
        rules: {
            code: {
                required: true,
                digits: true

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
                
            },
            startdate: {
                required: true,
                date: true
                
                
            }
        },
        messages: {
            code: {
                digits: "Harf kullanamazsınız",
                required: "Boş bırakamazsınız"
            },
            name: {
                required: "Boş bırakamazsınız",
                maxlength: "Maksimum 50 haneli bir isim giriniz",
                lettersonly: "Lütfen sadece harf kullanın"
            },
            email: {
                required: "Boş bırakamazsınız",
                email:"Lütfen mail formatına uygun giriş yapın"
            },
            startdate: {
                required: "Boş bırakamazsınız"
            },
            surname: {
                required: "Boş bırakamazsınız",
                maxlength: "Maksimum 50 haneli bir isim giriniz",
                lettersonly: "Lütfen sadece harf kullanın"
            }
        }
    });
});

$(document).ready(function(){
    $( function() {
        var date2 = new Date();
        $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd'}).datepicker('setDate', date2);

    });
});


</script>


@endsection