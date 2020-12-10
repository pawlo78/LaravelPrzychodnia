@extends('template')

@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection('title')



@section('content')
<div class="container">
    <h2>Wizyty</h2>
    <a href="{{URL::to('visits/create')}}">Dodaj nową wizytę</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Doktor Id</th>
                <th scope="col">Pacjent Id</th>
                <th scope="col">Termin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visits as $visit)
            <tr>
                <td>{{$visit->id}}</td>
                <td>{{$visit->doctor->name}} ({{$visit->doctor->pesel}})</td>
                <td>{{$visit->patient->name}} ({{$visit->doctor->pesel}})</td>
                <td>{{$visit->date}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection('content')