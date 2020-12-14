@extends('template')

@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection('title')

@section('content')
<div class="container">

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>                               
            @endforeach
        </ul>
    </div>
@endif  
    <h2>Dodawanie lekarza</h2>
    <form action="{{action([App\Http\Controllers\DoctorController::class, 'store'])}}" method="POST" role="form">
        <!-- token - zabezpiecznie przed generowaniem danych poza formularzem-->
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="form-group">
            <label for="name">Nazwisko i imię</label>
            <input type="text" class="form-control" name="name" />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" />
        </div>
        <div class="form-group">
            <label for="password">Hasło</label>
            <input type="password" class="form-control" name="password" />
        </div>
        <div class="form-group">
            <label for="phone">Telefon</label>
            <input type="text" class="form-control" name="phone" />
        </div>
        <div class="form-group">
            <label for="address">Adres</label>
            <input type="text" class="form-control" name="address" />
        </div>
        @if($errors->has('address'))
        <div class="alert alert-danger">
            <li>{{$errors->first('address')}}</li>  
        </div> 
        @endif       
        <div class="form-group">
            <label for="pesel">Pesel</label>
            <input type="text" class="form-control" name="pesel" />
        </div>
        @if($errors->has('pesel'))
        <div class="alert alert-danger">
            <li>{{$errors->first('address')}}</li>  
        </div> 
        @endif  
        <div class="form-group">
            <label for="specialization">Specjalizacja</label><BR>
            @foreach($specializations as $specialization)            
            <label for="specialization">{{$specialization->name}}</label>
            <input type="checkbox" name="specializations[]" value="{{$specialization->id}}">
            @endforeach            
        </div>
        <input type="hidden" name="status" value="Active" />
        <input type="submit" value="Dodaj" class="btn btn-primary" />    
    </form>    
</div>
@endsection('content')