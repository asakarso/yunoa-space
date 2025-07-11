@props(['background' => 'dark'])

@php
    $logo = ($background === 'light') 
        ? asset('landing-page/logo-ht.png') 
        : asset('landing-page/logo.png');
@endphp

@vite(['resources/css/components/navbar.css', 'resources/css/app.css'])

<nav class="navbar container mt-4 d-flex justify-content-between">
    <a class="navbar-brand" href="{{ url('/homepage')}}">
        <img src="{{ $logo }}" alt="Yunoa Space" width="160px">
    </a>

    <div class="d-flex gap-5 align-items-center colors-ijo-tua">
        <a href="{{ url('/self-assessment')}}">Self-Assessment</a>
        <a href="{{ route('counselingList', auth()->user()->id_user) }}">Consultation</a>
        <a href="{{ route('articles.index') }}">Education</a>
        <a href="{{ url('/journals')}}">Daily Gratitude</a>
        <a class="profile px-4" href="{{ route('profile') }}">Profile</a>
        
        <form method="POST" action="{{ route('logout') }}" class="d-flex align-items-center">
            @csrf
            <button type="submit" class="d-flex align-items-center gap-2"><i class="bi bi-box-arrow-right fs-3 "></i> Logout</button>
        </form>
    </div>
</nav>