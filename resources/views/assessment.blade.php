<!DOCTYPE html>
<html lang="id"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ikuti self-assessment singkat dari Yunoa Space untuk mengetahui kondisi kesehatan mental Anda secara umum dan dapatkan panduan awal.">
    <title>Self-Assessment | Yunoa Space</title>
    
    <style>
        #buttonTest {
            background-color: #6BB99F;
            color: white;
            padding: 16px 32px; 
            border-radius: 16px;
            text-decoration: none;
            display: inline-block;
            border: none; 
            cursor: pointer;
        }
        #buttonTest:hover {
            background-color: #5aa08a; 
        }

        main { 
            min-height: calc(100vh - 160px);
            display: flex;
            align-items: center;
        }

        .bi-arrow-right{
            display: none;
        }
        #buttonTest:hover .bi-arrow-right{
            display: inline-block;
            transition: opacity 0.3s ease;
        }
    </style>
    @vite(['resources/css/app.css'])
</head>
<body>
    <x-navbar></x-navbar>

    <main class="text-center container d-flex flex-column justify-content-center gap-3 py-5">
        <h1 class="fw-bold">Self <span class="colors-ijo-tua">Assessment</span>: Your Mental Health <spn class="colors-ijo-tua">Snapshot</spn></h1>
        <p>Self-Assessment is a <span class="fw-bold">short test</span> that can be used to quickly understand your current mental health condition.</p>
        <p>There are various types of mental health disorders, but the test we provide will <span class="fw-bold">only offer a general assessment.</span> We will inform you whether you <span class="fw-bold">need professional help or not.</span><br> A detailed diagnosis should be conducted by <span class="fw-bold">a qualified professional.</span></p>
        <div>
            <a href="{{ url('/self-assessment/test')}}" class="fw-bold" id="buttonTest">Take Test Now <i class="bi bi-arrow-right ps-3"></i></a>
        </div>
    </main>

    <footer>
        <div class="container text-center py-3">
            <p>© 2025 Yunoa Space. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>