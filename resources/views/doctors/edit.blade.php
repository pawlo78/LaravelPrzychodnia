@extends('template')

@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection('title')

@section('content')
<div class="container">
    <h2>Edycja lekarza</h2>
    <form action="{{action([App\Http\Controllers\DoctorController::class, 'editStore'])}}" method="POST" role="form">
        <!-- token - zabezpiecznie przed generowaniem danych poza formularzem-->
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <input type="hidden" name="doctorId" value="{{$doctor->id}}" />
        <div class="form-group">
            <label for="name">Nazwisko i imię</label>
            <input type="text" class="form-control" name="name" value="{{$doctor->name}}" />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" value="{{$doctor->email}}"/>
        </div>       
        <div class="form-group">
            <label for="phone">Telefon</label>
            <input type="text" class="form-control" name="phone" value="{{$doctor->phone}}"/>
        </div>
        <div class="form-group">
            <label for="address">Adres</label>
            <input type="text" class="form-control" name="address" value="{{$doctor->address}}"/>
        </div>
        <div class="form-group">
            <label for="pesel">Pesel</label>
            <input type="text" class="form-control" name="pesel" value="{{$doctor->pesel}}"/>
        </div>
        <div class="form-group">
            <label for="specialization">Specjalizacja</label><BR>
            @foreach($specializations as $specialization)
                @if($doctor->specializations->contains($specialization->id))
                    <label for="specialization">{{$specialization->name}}</label>
                    <input type="checkbox" name="specializations[]" value="{{$specialization->id}}" checked /> 
                @else
                    <label for="specialization">{{$specialization->name}}</label>
                    <input type="checkbox" name="specializations[]" value="{{$specialization->id}}"/> 
                @endif            
            @endforeach            
        </div>

        <div class="form-group">
            <label for="ststus">Status</label><BR>
            @if($doctor->status == "Active")
            <label for="ststus">Aktywny </label>
            <input type="radio" class="form-control" name="status" value="Active" checked/><BR>
            <label for="ststus">Nieaktywny </label>
            <input type="radio" class="form-control" name="status" value="Inactive"/>
            @else
            <label for="ststus">Aktywny </label>
            <input type="radio" class="form-control" name="status" value="Active"/><BR>
            <label for="ststus">Nieaktywny </label>
            <input type="radio" class="form-control" name="status" value="Inactive" checked/>
            @endif
        </div>       
        <input type="submit" value="Zapisz zmiany" class="btn btn-primary" />    
    </form>    
</div>
@endsection('content')