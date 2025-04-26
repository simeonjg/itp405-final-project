@extends('layout')

@section('title', 'blocked')

@section('main')
    <p>{{ Auth::user()->name }}, you have been blocked.</p>
@endsection