@extends('protect')

@section('content')

<br>
<br>
<br>
<br>
<div class='container'>

    @if(\Session::has('success'))
        <div class="alert alert-success" role="alert">
            <p>{{\Session::get('success')}}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
    @endif

    
    <form method="post" id="create_form" action="create" enctype='multipart/form-data'>
        {{csrf_field()}}
        <div class="form-group">
            <input type="text" name="prouser_name" class="form-control" placeholder="Uzman Kullanıcı Adı" required/>
        </div>
        <div class="form-group">
            <input type="text" name="prouser_email" class="form-control" placeholder="Uzman Kullanıcı Email" required/>
        </div>
        <div class="form-group">
            <input type="password" name="prouser_password" class="form-control" placeholder="Uzman Kullanıcı Parola" required />
        </div>
        <button type='submit' class='btn btn-primary'>Ekle</button>
                    
    </form>

    
    </div>



@stop