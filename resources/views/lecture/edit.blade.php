@extends('protect')

@section('content')


<div class='row'>
    <div class='col-md-12'>
        <h3> Düzenle</h3>
        <br />
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

        <form method='post' id='create_form' action='{{ action("LectureController@update", $id) }}'>
            {{ csrf_field()}}
            <input type='hidden' name='_method' value='PATCH' />
            <div class='form-group'>
                <input type='text' name='code' id='code_id' class='form-control' value='{{ $lecture->code }}' placeholder='Dersin Kodunu Giriniz' disabled/>
            </div>

            <div class='form-group'>
                <input type='text' name='name' class='form-control' value='{{ $lecture->name }}' placeholder='Desin İsmini Giriniz'/>
            </div>

            <div class='form-group'>
                <select class="form-control" name="ismandatory">
                @if( $lecture['ismandatory'] == '1' )
                    <option selected hidden value="{{ $lecture->ismandatory }}">Zorunlu</option>
                @elseif( $lecture['ismandatory']  == 0 )
                    <option selected hidden value="{{ $lecture->ismandatory }}">Seçmeli</option>
                @endif
                    <option value="0">Seçmeli</option>
                    <option value="1">Zorunlu</option>
                </select>
            </div>

            <div class='form-group'>
                <select class="form-control" name="day">
                @if( $lecture['day'] == '1' )
                    <option selected hidden value="{{ $lecture->day }}">Pazartesi</option>
                @elseif( $lecture['day']  == 2 )
                    <option selected hidden value="{{ $lecture->day }}">Salı</option>
                @elseif( $lecture['day']  == 3 )
                    <option selected hidden value="{{ $lecture->day }}">Çarşamba</option>
                @elseif( $lecture['day']  == 4 )
                    <option selected hidden value="{{ $lecture->day }}">Perşembe</option>
                @elseif( $lecture['day']  == 5 )
                    <option selected hidden value="{{ $lecture->day }}">Cuma</option>
                @elseif( $lecture['day']  == 6 )
                    <option selected hidden value="{{ $lecture->day }}">Cumartesi</option>
                @elseif( $lecture['day']  == 7 )
                    <option selected hidden value="{{ $lecture->day }}">Pazar</option>
                
                @endif
                    <option value="1">Pazartesi</option>
                    <option value="2">Salı</option>
                    <option value="3">Çarşamba</option>
                    <option value="4">Perşembe</option>
                    <option value="5">Cuma</option>
                    <option value="6">Cumartesi</option>
                    <option value="7">Pazar</option>
                </select>
           
            </div>

            <div class='form-group'>
                <input class="form-control" name="hour" type="time" value='{{ $lecture->hour }}' placeholder="Ders Saati Giriniz">

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
                required: true

            },
            name: {
                required: true,
                maxlength: 50
                
            },
            ismandatory: {
                required: true
            
            },
            day: {
                required: true
                
            },
            hour: {
                required: true

            },
        },
        messages: {
            code: {
                required: "Boş bırakamazsınız"
            },
            name: {
                required: "Boş bırakamazsınız",
                maxlength: "Maksimum 50 haneli bir isim giriniz"
            },
            ismandatory: {
                required: "Boş bırakamazsınız"
            },
            day: {
                required: "Boş bırakamazsınız"
            },
            hour: {
                required: "Boş bırakamazsınız"
            }
        }
    });
});

$(document).ready(function(){
    $(function () {
        $('#datetimepicker5').datetimepicker({
            use24hours: true
        });
    } );    
});

@endsection