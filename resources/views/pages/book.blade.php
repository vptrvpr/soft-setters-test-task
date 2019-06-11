@extends('layouts.main')
@section('content')
    <book-component :authors="{{$authors}}"></book-component>
@stop
