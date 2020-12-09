@extends('template')

@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection('title')




@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            {{$patient->name}}
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <td>Name:</td>
                    <td>{{$patient->name}}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{$patient->email}}</td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td>{{$patient->phone}}</td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td>{{$patient->address}}</td>
                </tr>                
                <tr>
                    <td>PESEL:</td>
                    <td>{{$patient->pesel}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection('content')