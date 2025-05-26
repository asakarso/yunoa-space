@vite('resources/css/components/navbar.css', 'resources/css/app.css')

<nav class="navbar container mt-4 d-flex justify-content-between">
    <a class="navbar-brand" href="{{ url('/')}}">
        <img src="{{ asset('landing-page/logo.png') }}" alt="Yunoa Space" width="160px">
    </a>

    <div class="d-flex gap-5 align-items-center colors-ijo-tua">
        <a href="{{ url('/self-assessment')}}">Self-Assessment</a>
        <a href="#">Consultation</a>
        <a href="#">Education</a>
        <a href="#">Daily Gratitude</a>
        <a class="profile px-4" href="#" >Profile</a>
    </div>
</nav>