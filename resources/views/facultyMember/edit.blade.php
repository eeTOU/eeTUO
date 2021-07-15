@extends('protect')

@section('content')


<div class='row'>
    <div class='col-md-12'>
        <h3> Düzenle</h3>
        <br>
        @if(count($errors)>0)
        <div class='alert alert-danger'>
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
        @if($message = Session::get('success'))
        <div class='alert alert-success'>
            <p> {{ $message}} </p>
        </div>
        @endif

        <form method='post' id='create_form' action='{{ action("FacultyMemberController@update", $id) }}'>
            {{ csrf_field()}}
            <input type='hidden' name='_method' value='PATCH' />
            <div class='form-group'>
                <input type='text' name='code' class='form-control' value='{{ $facultyMember->code }}' placeholder='Öğr. Görevlisi No' disabled/>
            </div>

            <div class='form-group'>
                <input type='text' name='name' class='form-control' value='{{ $facultyMember->name }}' placeholder='Öğr. Görevlisi İsim'/>
            </div>

            <div class='form-group'>
                <input type='text' name='surname' class='form-control' value='{{ $facultyMember->surname }}' placeholder='Öğr. Görevlisi Soyisim'/>
            </div>

            <div class='form-group'>
                <input type='text' name='email' class='form-control' value='{{ $facultyMember->email }}' placeholder='Öğr. Görevlisi Mail'/>
            </div>

            <div class='form-group'>
                <input type='text' name='startdate' id='datepicker' class='form-control' value='{{ $facultyMember->startdate }}' placeholder='Başlama Tarihi'/>
            </div>

            <button type='submit' class='btn btn-primary'>Kaydet</button>
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

@endsection