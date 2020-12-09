@extends('template')

@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection('title')

@section('content')
<div class="container">
    <h2>Dodawanie specjalizacji</h2>
    <form action="{{action([App\Http\Controllers\SpecializationController::class, 'store'])}}" method="POST" role="form">
        <!-- token - zabezpiecznie przed generowaniem danych poza formularzem-->
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="form-group">
            <label for="name">Nazwa specjalizacji</label>
            <input type="text" class="form-control" name="name" />
            <input type="submit" value="Dodaj" class="btn btn-primary" />
        </div>
    </form>    
</div>
@endsection('content')