@extends('template')

@section('title')
@if(isset($title))
{{$title}}
@endif
@endsection('title')

@section('content')
<div class="container">
<h3>Zostałeś zarejestrowany! Dziękujemy</h3> 
</div>
@endsection('content')