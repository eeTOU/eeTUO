@extends('protect')

@section('content')

<div class="row">
    <div class="col-md-12">
    <br>
        <h3 class="center">Kat Ekle</h3>
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
                <input type="text" name="code" id="code_control" class="form-control" placeholder="Kat Kodunu Giriniz" />
            </div>
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Kat İsmini Giriniz" />
            </div>
            <!-- Kat bilgisi girilirken Parentcode bilgisi istenmiyor. -->
            <div class="form-group" id="parentcode_form" hidden>
                <input type="text" id="parentcode_control" name="parentcode" class="form-control" placeholder="Parentcode Giriniz" />
            </div>
            <div class="form-group" >
                <select id="type_control" name="type" class="form-control">
                    <option selected value="0">Kat</option>
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