@extends('studentProtect')

@section('content')

<br>
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
<!-- Dönem Ders Listesi -->
<div class="row" style="padding-left: 5px; padding-right: 2px">
    <div class='right'>
        <h4>Bu Dönem Açılan Dersler</h4>
    </div>
    <br />                  

    <table class='table table-bordered'>
        <tr>
            <th>Ders Kodu</th>
            <th>Ders Adı</th>
            <th>Zorunlu mu?</th>
            <th>Ders Gün</th>
            <th>Ders Saati</th>
            <th>Seç</th>
        </tr>

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
            <td><a href='{{ url("/submitLecture/".$lecture["id"]) }}'
                class='btn btn-warning'> Ekle </a> 
            </td>
        </tr>
    @endforeach

    </table>
</div>

@endsection