@extends('protect')

@section('content')


<div class='row'>
    <div class='col-md-12'>
    @if( $class_check == '0' )
        <h3> Kat Düzenle</h3>
    @elseif( $class_check == '1')  
        <h3> Kat Düzenle</h3>
    @endif    
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

        <form method='post' id='create_form' action='{{ action("ClassRoomController@update", $id) }}'>
            {{ csrf_field()}}
            <input type='hidden' name='_method' value='PATCH' />
            <div class='form-group'>
                <input type='text' name='code' id='code_id' class='form-control' value='{{ $classroom->code }}' placeholder='Sınıf Kodunu Giriniz' disabled/>
            </div>

            <div class='form-group'>
                <input type='text' name='name' class='form-control' value='{{ $classroom->name }}' placeholder='Sınıf İsmini Giriniz'/>
            </div>
            <!-- ClassRommController dan aldığımız bilgiye göre parentcode un gösterilip gösterilemeyegini belirliyoruz
                    eğer $class_check = 0 is bu bir kat bilgisidir.-->
            <div class='form-group'>
            @if( $classroom['type'] == 0 ) 
                <input type='text' name='parentcode' class='form-control' value='{{ $classroom->parentcode }}' placeholder='Parentcode Giriniz' disabled/>
            @elseif(  $classroom['type']  == 1 ) 
                <input type='text' name='parentcode' class='form-control' value='{{ $classroom->parentcode }}' placeholder='Parentcode Giriniz'/>
            @endif
            </div>

            <div class='form-group'>
                <select class="form-control" name="type">
                @if( $classroom['type'] == 0 )
                    <option selected value="{{ $classroom->type }}">Kat</option>
                @elseif( $classroom['type']  == 1 )
                    <option selected value="{{ $classroom->type }}">Sınıf</option>
                @endif
                    <!--<option value="0">Kat</option>
                    <option value="1">Sınıf</option>-->
                </select>
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
                required: true
            }
        },
        messages: {
            code: {
                required: "Boş bırakamazsınız"
            },
            name: {
                required: "Boş bırakamazsınız"
            }
        }
    });
});

@endsection