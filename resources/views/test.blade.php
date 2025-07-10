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
    <script>
        const userId = {{ auth()->user()->id_user ?? 'null' }};
        const now = new Date();
        const tanggal = now.toISOString().slice(0, 10);
        const waktu = now.toTimeString().slice(0, 8);
        const pertanyaan = @json($pertanyaan);
        const jawaban = [];
        let indexPertanyaan = 0;

        const pertanyaanField = document.querySelector(".pertanyaan");
        const btnPrev = document.getElementById("buttonPrev");
        const btnNext = document.getElementById("buttonNext");
        const btnSubmit = document.getElementById("buttonSubmit");
        const errMsg = document.getElementById('errMsg');

        let isSubmitting = false;

        const handleBeforeUnload = function (e) {
            if (!isSubmitting) {
                e.preventDefault();
                e.returnValue = ''; 
            }
        };

        window.addEventListener('beforeunload', handleBeforeUnload);

        function changeElement(index) {
            pertanyaanField.textContent = pertanyaan[index];
            btnPrev.classList.toggle("invisible", index <= 0);

            const savedAnswer = jawaban[index];
            document.querySelectorAll('input[name="answer"]').forEach(choice => {
                choice.checked = (choice.value == savedAnswer);
            });

            btnSubmit.classList.toggle("d-none", index < pertanyaan.length - 1);
            btnNext.classList.toggle("d-none", index >= pertanyaan.length - 1);
        }

        document.querySelectorAll('input[name="answer"]').forEach(choice => {
            choice.addEventListener("change", function() {
                if (this.checked) {
                    jawaban[indexPertanyaan] = this.value;
                    errMsg.classList.add("invisible");
                }
            });
        });

        btnNext.addEventListener("click", function(ev) {
            ev.preventDefault();
            if (jawaban[indexPertanyaan] === undefined) {
                errMsg.classList.remove("invisible");
            } else {
                indexPertanyaan++;
                changeElement(indexPertanyaan);
            }
        });

        btnPrev.addEventListener("click", function(ev) {
            ev.preventDefault();
            indexPertanyaan--;
            changeElement(indexPertanyaan);
            errMsg.classList.add("invisible");
        });

        btnSubmit.addEventListener("click", function(ev) {
            ev.preventDefault();
            if (jawaban[indexPertanyaan] === undefined) {
                errMsg.classList.remove("invisible");
                return;
            }

            if (confirm("Are you sure you want to submit your assessment? This action cannot be undone.")) {
               
                isSubmitting = true;
                
                errMsg.classList.add("invisible");
                const waktuSubmit = new Date().toTimeString().slice(0, 8);
                let skor = jawaban.reduce((total, jawab) => total + Number(jawab), 0);

                btnSubmit.disabled = true;
                btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...';

                fetch("{{ route('assessment.store') }}", {
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
                    if (!response.ok) return response.json().then(err => { throw err; });
                    return response.json();
                })
                .then(data => {
                    if (data.redirect_url) {
                        window.location.href = data.redirect_url;
                    } else {
                        console.error("Server tidak mengirimkan URL redirect.", data);
                        isSubmitting = false; 
                    }
                })
                .catch(error => {
                    console.error("Error submitting assessment:", error);
                    alert("Failed to submit assessment. Please try again.");
                    btnSubmit.disabled = false;
                    btnSubmit.textContent = 'Submit';
                    isSubmitting = false; 
                });
            }
        });

        changeElement(0);
    </script>
</body>
</html>