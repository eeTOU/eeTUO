@extends('protect')

@section('content')

<div class='row'>
    <div class='col-md-12'>
        <h3> Öğretim Görevlisi Listesi</h3>
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
            <a href='{{ route("facultyMember.create") }}' class='btn btn-primary'>Ögr. Görevlisi Ekle</a>
        </div>
        <br />                  
        
        <table class='table table-bordered'>
            <tr>
                <th>Kodu</th>
                <th>Ögr. Adı</th>
                <th>Ögr. Soyadı</th>
                <th>Ögr. Mail</th>
                <th>Ögr. Başlama T.</th>
                <th>Düzenle</th>
                <th>Sil</th>
            </tr>

            @foreach($facultyMembers as $facultyMember)
            <tr>
                <td>{{ $facultyMember['code'] }}</td>
                <td>{{ $facultyMember['name'] }}</td>
                <td>{{ $facultyMember['surname'] }}</td>
                <td>{{ $facultyMember['email'] }}</td>
                <td>{{ $facultyMember['startdate'] }}</td>
                <td><a href='{{ action("FacultyMemberController@edit", $facultyMember["id"]) }}'
                 class='btn btn-warning'> Düzenle </a> </td>
                <td>
                    <form method='post' class='delete_form' 
                    action='{{action("FacultyMemberController@destroy", $facultyMember["id"])}}'>
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