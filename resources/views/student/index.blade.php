@extends('protect')

@section('content')

<div class='row'>
    <div class='col-md-12'>
        <h3> Öğrenci Listesi</h3>
        <br />
        @if($message = Session::get('success'))
        <div class='alert alert-success'>
            <p> {{ $message}} </p>

        </div>
        @endif
        <div class='right'>
            <a href='{{ route("student.create") }}' class='btn btn-primary'>Öğrenci Ekle </a>
        </div>
        <br />                  
        
        <table class='table table-bordered'>
            <tr>
                <th>Kodu</th>
                <th>Ögr. Adı</th>
                <th>Ögr. Soyadı</th>
                <th>Mail Adresi</th>
                <th>Düzenle</th>
                <th>Sil</th>
            </tr>

            @foreach($students as $student)
            <tr>
                <td>{{ $student['code'] }}</td>
                <td>{{ $student['name'] }}</td>
                <td>{{ $student['surname'] }}</td>
                <td>{{ $student['email'] }}</td>
                <td><a href='{{ action("StudentController@edit", $student["id"]) }}'
                 class='btn btn-warning'> Düzenle </a> </td>
                <td>
                    <form method='post' class='delete_form' 
                    action='{{action("StudentController@destroy", $student["id"])}}'>
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