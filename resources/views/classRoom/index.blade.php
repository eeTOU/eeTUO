@extends('protect')

@section('content')

<div class='row'>
    <div class='col-md-12'>
        <h3> Sınıf Listesi</h3>
        <br />
        @if($message = Session::get('success'))
        <div class='alert alert-success'>
            <p> {{ $message}} </p>

        </div>
        @endif
        @if($message = Session::get('errors'))
        <div class='alert alert-danger'>
            <p> {{ $message}} </p>

        </div>
        @endif
        <div class='right'>
            <a href='{{ url("/createClass") }}' class='btn btn-primary'>Sınıf Ekle</a>
            <a href='{{ route("classRoom.create") }}' class='btn btn-primary'>Kat Ekle</a>

        </div>
        <br />                  
        
        <table class='table table-bordered'>
            <tr>
                <th>Sınıf Kodu</th>
                <th>Sınıf İsmi</th>
                <th>Parentcode</th>
                <th>Sınıf Tipi</th>
                <th>Düzenle</th>
                <th>Sil</th> 
            </tr>

            @foreach($classrooms as $classroom)
            <tr>
                <td>{{ $classroom['code'] }}</td>
                <td>{{ $classroom['name'] }}</td>
                <td>{{ $classroom['parentcode'] }}</td>
                
                @if( $classroom['type'] == '1' )
                    <td>Sınıf</td>
                @elseif( $classroom['type']  == 0 )
                    <td>Kat</td>
                @endif
                <td><a href='{{ action("ClassRoomController@edit", $classroom["id"]) }}'
                 class='btn btn-warning'> Düzenle </a> </td>
                <td>
                    <form method='post' class='delete_form' 
                    action='{{action("ClassRoomController@destroy", $classroom["id"])}}'>
                        {{csrf_field()}}
                        <input type='hidden' name='_method' value='DELETE' />
                        <button type='submit' class='btn btn-danger'> Sil </button>
                    </form>  
                </td>
            </tr>
            @endforeach

        </table>

    </div>
    
</div>
<!-- 
$(document).ready(function(){
    $('.delete_form').on('submit', function(){
        if(confirm("Kaydı silmek istediğinizden emin misiniz?"))
        {
            return true;
        }
        else
        {
            return false;
        }
    });


     -->

<script> 
$(document).ready(function(){
    $('.delete_form').on('submit', function(){
        if(confirm("Kaydı silmek istediğinizden emin misiniz?"))
        {
            return true;
        }
        else
        {
            return false;
        }
    });

});

</script>

@endsection