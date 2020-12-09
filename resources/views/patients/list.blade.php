@extends('template')

@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection('title')




@section('content')
<div class="container">
<h2>Pacjenci</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>               
            </tr>
        </thead>
        <tbody>
            @foreach ($listPatientsx as $patient)
            <tr>
                <td>{{$patient->id}}</td>
                <td><a href="{{ URL::to('patients/' . $patient->id ) }}">{{$patient->name}}</a></td>
                <td>{{$patient->email}}</td>
                <td>{{$patient->phone}}</td>               
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection('content')