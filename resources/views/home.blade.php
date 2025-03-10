@extends('layouts.app')

@section('title', 'Home Page')

@section('navbar')
    @include('navbars.navbar-home')
@endsection

@section('content')
    <h1 class="text-3xl font-bold text-blue-600">Welcome to Home Page</h1>
    <p>This is the home page content.</p>
    @yield()
@endsection