<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write a Journal | Yunoa Space</title>
    @vite(['resources/css/app.css', 'resources/css/landingpage.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body {
            background: linear-gradient(to right, #d0f0e2, #e6f4ea);
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
            color: #2e4738;
            position: relative;
        }

        .form-background {
            /* background: url('https://i.pinimg.com/736x/ec/63/f1/ec63f1d707649530c3dc06b6ffe45eb6.jpg') no-repeat center center/cover; */
            filter: blur(10px);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
        }

        .form-container {
            position: relative;
            max-width: 650px;
            margin: auto;
            background-color: #ffffffee;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
            overflow: hidden;
            animation: fadeInUp 0.8s ease;
            z-index: 1;
        }

        .form-container::before {
            /* content: "🧠"; */
            position: absolute;
            top: -20px;
            right: -20px;
            font-size: 4rem;
            opacity: 0.1;
        }

        input, textarea, select {
            width: 100%;
            margin: 10px 0;
            padding: 12px;
            border: 1px solid #b5d1bd;
            border-radius: 10px;
            background-color: #f6fffa;
        }

        button {
            background-color: #86c7a7;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #5cae8e;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="form-background"></div>

<div class="form-container animate__animated animate__fadeInUp">
    <h2 class="animate__animated animate__fadeInDown">Write a New Journal</h2>

    <form action="{{ route('journals.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="judul_jurnal" placeholder="Journal Title" required>
        <input type="date" name="tanggal_jurnal" required>
        <input type="time" name="waktu_jurnal" required>
        <textarea name="konten_jurnal" rows="6" placeholder="Express your thoughts..." required></textarea>
        <input type="file" name="gambar_cover">

        <button type="submit">Save Journal</button>
    </form>
</div>

</body>
</html>
