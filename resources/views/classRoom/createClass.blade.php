@extends('protect')

@section('content')

<div class="row">
    <div class="col-md-12">
    <br>
        <h3 class="center">Sınıf Ekle</h3>
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
        <form method="post" id="create_form" action="{{url('classRoom')}}">
            {{csrf_field()}}
            <div class="form-group">
                <input type="text" name="code" id="code_control" class="form-control" placeholder="Sınıf Kodunu Giriniz" />
            </div>
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Sınıf İsmini Giriniz" />
            </div>
            <div class="form-group" id="parentcode_form">
            <!-- Database den varsa Kat bilgilerini çekip Sınıf bilgisini buna göre kaydediyoruz. 
                Sınıf bilgisi girilirken Kat bilgisi seçiliyor.-->
            @if(count($classrooms) > 0)
            <select class="form-control" name="parentcode">
                @foreach($classrooms->all() as $classroom)
                <option value="{{ $classroom->code }}"> {{ $classroom->name }}</option>
                @endforeach
            </select>
            <!-- Databasede Kat bilgisi yok-->
            @elseif(count($classrooms) < 0)
                <input type="text" id="parentcode_control" name="parentcode" class="form-control" placeholder="Parentcode Giriniz" />
            
            @endif
            </div>
            <div class="form-group" >
                <select id="type_control" name="type" class="form-control">
                    <option selected value="1">Sınıf</option>
                </select>
            </div>
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
                required: true
                
            }
        },
        messages: {
            code: {
                required: "Boş bırakamazsınız"
            },
            name: {
                required: "Boş bırakamazsınız",
            }
        }
    });
});


</script>

@endsection