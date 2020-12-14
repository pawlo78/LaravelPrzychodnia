@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rejestracja</div>

                <div class="card-body">
                <form action="{{action([App\Http\Controllers\PatientController::class, 'store'])}}" method="POST" role="form">
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
        <input type="hidden" name="status" value="Active" />
        <input type="submit" value="Dodaj" class="btn btn-primary" />    
    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
