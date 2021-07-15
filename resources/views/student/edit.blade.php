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

        <form method='post' action='{{ action("StudentController@update", $id) }}'>
            {{ csrf_field()}}
            <input type='hidden' name='_method' value='PATCH' />
            <div class='form-group'>
                <input type='text' name='code' class='form-control' value='{{ $student->code }}' placeholder='Öğrenci No'/>
            </div>

            <div class='form-group'>
                <input type='text' name='name' class='form-control' value='{{ $student->name }}' placeholder='Öğrenci İsim'/>
            </div>

            <div class='form-group'>
                <input type='text' name='surname' class='form-control' value='{{ $student->surname }}' placeholder='Öğrenci Soyisim'/>
            </div>

            <div class='form-group'>
                <input type='text' name='email' class='form-control' value='{{ $student->email }}' placeholder='isim.soyisim@deu.edu.tr'/>
            </div>

            <button type='submit' class='btn btn-primary'>Kaydet</button>
        </form>


    </div>

</div>        

@endsection