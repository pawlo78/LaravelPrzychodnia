@extends('template')

@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection('title')




@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Specializations</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listDoctorsx as $doctor)
            <tr>
                <td>{{$doctor->id}}</td>
                <td><a href="{{ URL::to('doctors/' . $doctor->id ) }}">{{$doctor->name}}</a></td>
                <td>{{$doctor->email}}</td>
                <td>{{$doctor->phone}}</td>
                <td>
                    <ul>
                        @foreach($doctor->specializations as $specialization)
                        <li>{{$specialization->name}}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{$doctor->status}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @foreach($statistics as $stat)
    @if($stat->status == "Active")
    Liczba lekarzy dostępnych: {{$stat->user_count}}
    @endif
    <BR>
    @if($stat->status == "Inactive")
    Liczba lekarzy dostępnych: {{$stat->user_count}}
    @endif
    @endforeach



</div>
@endsection('content')