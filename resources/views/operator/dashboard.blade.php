@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Operator Dashboard</h1>
    <p>Selamat datang, {{ auth()->user()->name }} (Operator)</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger">Logout</button>
    </form>
</div>
@endsection
