@extends('template')

@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection('title')



@section('content')
<div class="container">
    <h2>Specializations</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($specializations as $specialization)
            <tr>
                <td>{{$specialization->id}}</td>
                <td><a href="{{URL::to('doctors/specializations/'.$specialization->id)}}">{{$specialization->name}}</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection('content')