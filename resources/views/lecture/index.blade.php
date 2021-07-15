@extends('protect')

@section('content')

<div class='row'>
    <div class='col-md-12'>
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
        <h3> Ders Listesi</h3>
        <div class="panel-body">
            <div class="panel-body">
                <input type='text' name='search' id='search' class='form-control' placeholder='Ders Ara' />
                <h7 style="color: #777"> * Bazen çalışmayabiliyor. </h7>
            </div>
        </div>

        <div class='right'>
            <a href='{{ route("lecture.create") }}' class='btn btn-primary'>Ders Ekle</a>
        </div>
        <br />                  
        <h5> Toplam Sonuç: <span id="total_records"></span></h5>
        <table class='table table-bordered'>
        <thead>
            <tr>
                <th>Dersin Kodu</th>
                <th>Dersin İsmi</th>
                <th>Zorunlu mu?</th>
                <th>Ders Günü</th>
                <th>Ders Saati</th>
                <th>Düzenle</th>
                <th>Sil</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lectures as $lecture)
            <tr>
                <td>{{ $lecture['code'] }}</td>
                <td>{{ $lecture['name'] }}</td>
                @if( $lecture['ismandatory'] == '1' )
                    <td>Zorunlu</td>
                @elseif( $lecture['ismandatory']  == 0 )
                    <td>Seçmeli</td>
                @endif
                @if( $lecture['day'] == '1' )
                    <td>Pazartesi</td>
                @elseif( $lecture['day'] == '2' )
                    <td>Salı</td>
                @elseif( $lecture['day'] == '3' )
                    <td>Çarşamba</td>
                @elseif( $lecture['day'] == '4' )
                    <td>Perşembe</td>
                @elseif( $lecture['day'] == '5' )
                    <td>Cuma</td>
                @elseif( $lecture['day'] == '6' )
                    <td>Cumartesi</td>
                @elseif( $lecture['day'] == '7' )
                    <td>Pazar</td>            
                @endif
                <td>{{ $lecture['hour'] }}</td>
                <td><a href='{{ action("LectureController@edit", $lecture["id"]) }}'
                 class='btn btn-warning'> Düzenle </a> </td>
                <td>
                    <form method='post' class='delete_form' 
                    action='{{action("LectureController@destroy", $lecture["id"])}}'>
                        {{csrf_field()}}
                        <input type='hidden' name='_method' value='DELETE' />
                        <button type='submit' class='btn btn-danger'> Sil </button>
                    </form>  
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>

    </div>
    
</div>

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



$(document).ready(function(){

 fetch_customer_data();

 function fetch_customer_data(query = '')
 {
    
  $.ajax({
   url:"{{ route('lectureIndex.action') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('tbody').html(data.table_data);
    $('#total_records').text(data.total_data);
   }
  })
 }

$(document).on('onkeyup', '#search', function(){
    var query = $("#search").val();
    fetch_customer_data(query);
    });

});


</script>

@endsection