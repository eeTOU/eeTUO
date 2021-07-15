@extends('protect')

@section('content')

<div class="row">
    <div class="col-md-12">
    <br>
        <h3 class="center">Ders Ekle</h3>
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
        <form method="post" id="create_form" action="{{url('lecture')}}">
            {{csrf_field()}}
            <div class="form-group">
                <input type="text" name="code" class="form-control" placeholder="Dersin Kodunu Giriniz" />
            </div>
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Desin İsmini Giriniz" />
            </div>
            <div class="form-group">
                <select class="form-control" name="ismandatory">
                    <!--<option selected >Ders Zorunlu mu?</option>-->
                    <option value="0">Seçmeli</option>
                    <option value="1">Zorunlu</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="day">
                    <option value="1">Pazartesi</option>
                    <option value="2">Salı</option>
                    <option value="3">Çarşamba</option>
                    <option value="4">Perşembe</option>
                    <option value="5">Cuma</option>
                    <option value="6">Cumartesi</option>
                    <option value="7">Pazar</option>
                </select>

            </div>
            <div class="form-group">
                <input class="form-control" name="hour" type="time"  placeholder="Ders Saati Giriniz">

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

            }
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
        $('#datetimepicker3').datetimepicker({format: 'LT'});
		
    });
});



</script>

@endsection