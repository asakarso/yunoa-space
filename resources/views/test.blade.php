<!DOCTYPE html>
<html lang="id"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ikuti self-assessment singkat dari Yunoa Space untuk mengetahui kondisi kesehatan mental Anda secara umum dan dapatkan panduan awal.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Self-Assessment | Yunoa Space</title>
    
    <style>
        main { 
            min-height: calc(100vh - 160px);
            display: flex;
            align-items: center;
        }

        main div label:hover {
            border-width: 2px !important;
        }

        #buttonNext, #buttonSubmit {
            background-color: #0F5A4A;
            color: white;
            padding: 8px 16px; 
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }
        #buttonNext:hover, #buttonSubmit:hover{
            background-color: #5aa08a;
        }
        #buttonPrev {
            border: 1px solid #0F5A4A;
            padding: 8px 16px 8px 2px; 
            border-radius: 4px;
            text-decoration: none;
            display: flex;
            gap: 18px;
            cursor: pointer;
        }
        #buttonPrev:hover {
            background-color: #5aa08a;
            color: white;
        }
    </style>
    @vite(['resources/css/app.css'])
</head>
<body>
    <x-navbar></x-navbar>

    <main class="container d-flex flex-column justify-content-center gap-5 py-5 px-5 w-75">
        <h1 class="fw-bold pertanyaan"></h1>

        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <label class="cursor-pointer border px-4 py-3 d-inline-flex align-items-center gap-2 rounded">
                <input class="form-check-input" type="radio" name="answer" id="answerAlways" value="5">
                <span class="form-check-label m-0">Always There</span>
            </label>

            <label class="cursor-pointer border px-4 py-3 d-inline-flex align-items-center gap-2 rounded">
                <input class="form-check-input" type="radio" name="answer" id="answerOften" value="4">
                <span class="form-check-label m-0">Very Often</span>
            </label>

            <label class="cursor-pointer border px-4 py-3 d-inline-flex align-items-center gap-2 rounded">
                <input class="form-check-input" type="radio" name="answer" id="answerSome" value="3">
                <span class="form-check-label m-0">Sometimes Happens</span>
            </label>

            <label class="cursor-pointer border px-4 py-3 d-inline-flex align-items-center gap-2 rounded">
                <input class="form-check-input" type="radio" name="answer" id="answerHardly" value="2">
                <span class="form-check-label m-0">Hardly Ever</span>
            </label>

            <label class="cursor-pointer border px-4 py-3 d-inline-flex align-items-center gap-2 rounded">
                <input class="form-check-input" type="radio" name="answer" id="answerNever" value="1">
                <span class="form-check-label m-0">Never Happened</span>
            </label>

        </div>

        <div class="w-100 d-flex flex-column">
            <div class="d-flex justify-content-between">
                <a href="#" class="fw-bold invisible" id="buttonPrev"><i class="bi bi-arrow-left ps-3"></i> Previous</a>
                <a href="#" class="fw-bold" id="buttonNext">Next<i class="bi bi-arrow-right ps-3"></i></a>
                <button type="button" class="fw-bold d-none" id="buttonSubmit">Submit</button>
            </div>
            <p class="text-danger align-self-end mt-3 invisible" id="errMsg">Please select one of the answers</p>
        </div>
    </main>

    <footer>
        <div class="container text-center py-3">
            <p>© 2025 Yunoa Space. All rights reserved.</p>
        </div>
    </footer>
    <? use Illuminate\Support\Facades\Auth; ?>
    <script>
        const userId = <?= json_encode(Auth::id()) ?>;
        const now = new Date();
        const tanggal = now.toISOString().slice(0, 10);
        const waktu = now.toTimeString().slice(0, 8);

        console.log('ID:', userId); 
        console.log('Tanggal:', tanggal); // contoh: 2025-05-25
        console.log('Waktu:', waktu);     // contoh: 09:00:00

        const pertanyaan = <?= json_encode($pertanyaan) ?>;

        let indexPertanyaan = 0;
        const btnPrev = document.getElementById("buttonPrev");
        const pertanyaanField = document.querySelector(".pertanyaan");
        pertanyaanField.textContent = pertanyaan[0];

        function changeElement(index){
            pertanyaanField.textContent = pertanyaan[index];

            if (index > 0 ){
                btnPrev.classList.remove("invisible");
            } else {
                btnPrev.classList.add("invisible");
            }

            if(jawaban[indexPertanyaan] != undefined){
                document.querySelectorAll('input[name="answer"]').forEach((choice)=>{
                    if(choice.value == jawaban[indexPertanyaan]){
                        choice.checked = true;
                    }
                });
            } else {
                document.querySelectorAll('input[name="answer"]').forEach((choice)=>{
                    choice.checked = false;
                });
            }

            if(indexPertanyaan==pertanyaan.length-1){
                document.getElementById("buttonSubmit").classList.remove("d-none");
                document.getElementById("buttonNext").classList.add("d-none");
            } else {
                document.getElementById("buttonSubmit").classList.add("d-none");
                document.getElementById("buttonNext").classList.remove("d-none");
            }
        }

        const jawaban = [];

        document.querySelectorAll('input[name="answer"]').forEach((choice)=>{
            choice.addEventListener("change", function(){
                if(choice.checked){
                    jawaban[indexPertanyaan] = choice.value;
                }

                document.getElementById('errMsg').classList.add("invisible");
            });
        });

        const btnNext = document.getElementById("buttonNext");
        btnNext.addEventListener("click", function(ev){
            if(jawaban[indexPertanyaan]==undefined){
                ev.preventDefault();
                document.getElementById('errMsg').classList.remove("invisible");
            } else {
                indexPertanyaan++;
                changeElement(indexPertanyaan);
            }
        });
        
        btnPrev.addEventListener("click", function(){
            indexPertanyaan--;
            changeElement(indexPertanyaan);
            document.getElementById('errMsg').classList.add("invisible");
        });

        const btnSubmit = document.getElementById("buttonSubmit");
        btnSubmit.addEventListener("click", function(ev){
            if(jawaban[indexPertanyaan]==undefined){
                ev.preventDefault();
                document.getElementById('errMsg').classList.remove("invisible");
                console.log('jawaban:', jawaban); 
            } else {
                document.getElementById('errMsg').classList.add("invisible");
                const waktuSubmit = new Date().toTimeString().slice(0, 8);;
                console.log(waktuSubmit);
                let skor = 0;
                jawaban.forEach(jawab => {
                    skor += Number(jawab); 
                });

                btnSubmit.disabled = true;
                btnSubmit.textContent = 'Submitting...';

                fetch("{{ url('/self-assessment/store-result') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        userId: userId,
                        tanggal: tanggal,
                        waktu: waktu,
                        waktuSubmit: waktuSubmit,
                        jawaban: jawaban,
                        skor: skor
                    })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data && data.redirect_url) {
                        window.location.href = data.redirect_url; 
                    } else {
                        console.log("Sukses, tapi tidak ada URL redirect:", data);
                        alert(`Assessment berhasil disimpan! Skor Anda: ${data.score}. Halaman tidak dialihkan.`);
                        btnSubmit.textContent = 'Submitted';
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });
            }
            
        });

        window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            e.returnValue = '';
        });
    </script>
</body>
</html>