<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yunoa Space</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../../public/landing-page/style.css">
    @vite(['resources/css/app.css', 'resources/css/landingpage.css'])
</head>

<body>
    <nav class="container mt-4 d-flex justify-content-between">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('landing-page/logo.png') }}" alt="Yunoa Space" width="160px">
        </a>

        <div class="d-flex gap-5 align-items-center colors-ijo-tua">
            <a class="nav-link link-secondary" href="#about">About Us</a>
            <a class="nav-link link-secondary" href="#feature">Feature</a>
            <a class="nav-link link-secondary" href="#specialists">Specialists</a>
            <a class="nav-link link-secondary" href="#review">Reviews</a>
            <a class="login px-4" href="{{ url('/login')}}" role="button">Log In</a>
        </div>
    </nav>

    <header class="hero container mt-5">
        <div class="d-flex gap-5 align-items-center justify-content-between">
            <!-- Kolom Kiri (Teks) -->
            <div class="left-hero">
                <p class="tagline">No.1 Platform for Mental Consulting</p>
                <h1 class="fw-bold mb-3"> Your Trusted Partner <br> for Mental Health Support</h1>
                <p class="mb-4">We are here to help you find peace, balance, and happiness in life. Begin your journey toward better mental health with us.</p>
                <a href="#" class="px-4">Sign Up Now</a>
            </div>

            <!-- Kolom Kanan (Gambar) -->
            <div class="w-75">
                <img src="{{ asset('landing-page/hero.png') }}" width="100%" class="hero-img" alt="Hero Image">
            </div>
        </div>
    </header>

    <main class="container mt-5">
        <!-- About Us -->
        <section id="about-us">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold colors-ijo-tua">Why Choose Us</h5>
                    <h2><span class="fw-bold"><span class="colors-ijo">Your</span> Unique <br /> Journey to <span class="colors-ijo">Healing</span></h2>
                </div>
                <p class="lh-lg w-50">Yunoa Space is more than just a platform—it's your partner in mental wellness. With a holistic approach, we're here to guide, support, and empower you on your journey to a healthier mind and a happier you.</p>
            </div>
            <div class="specific mt-3 d-flex flex-wrap gap-5 justify-content-between">
                <div>
                    <i class="bi bi-search h3 colors-ijo-tua"></i>
                    <h5 class="fw-semibold mt-2">Tailored to You</h5>
                    <p>We don't just treat symptoms; we focus on understanding and healingthe root causes of mental health challenges.</p>
                </div>
                <div>
                    <i class="bi bi-bag-heart h3 colors-ijo-tua"></i>
                    <h5 class="fw-semibold mt-2">Root Cause Healing</h5>
                    <p>We don't just manage emotions; we help you uncover and address the deeper challenges.</p>
                </div>
                <div class="feature">
                    <i class="bi bi-balloon-heart h3 colors-ijo-tua"></i>
                    <h5 class="fw-semibold mt-2">Mindful Growth Practices</h5>
                    <p>Daily gratitude journaling, meditation guides, and self-reflection
                        exercises crafted to fit your lifestyle.</p>
                </div>
                <div class="feature">
                    <i class="bi bi-lock h3 colors-ijo-tua"></i>
                    <h5 class="fw-semibold mt-2">Flexible & Accessible Support</h5>
                    <p>Whether you need guidance today or next week, we're here whenever
                        you're ready.</p>
                </div>
            </div>
        </section>

        <!-- Features -->
        <div id="feature">
            <div class="text-center mt-5">
                <h2 class="fw-bold">Our <span class="colors-ijo">Features</span></h2>
                <p class="lh-lg my-4">Discover our features designed to support your mental health journey. From self-assessments to expert consultations, our platform provides the resources you need to achieve balance and well-being.</p>
            </div>
            <div class="features text-center mb-5">
                <div>
                    <h5 class="fw-semibold">Self-Assessment</h5>
                    <img src="{{ asset('landing-page/self-assessment.png') }}" class="w-50 mb-2" />
                    <p>Evaluate your mental well-being with a quick self-assessment.</p>
                </div>
                <div>
                    <h5 class="fw-semibold">Consultation</h5>
                    <img src="{{ asset('landing-page/consultant.png') }}" class="w-50 mb-2" />
                    <p>Connect with professional experts for personalized support.</p>
                </div>
                <div>
                    <h5 class="fw-semibold">Education</h5>
                    <img src="{{ asset('landing-page/articles.png') }}" class="w-50 mb-2" />
                    <p>Access articles to improve your mental health awareness.</p>
                </div>
                <div>
                    <h5 class="fw-semibold">Daily Gratitude</h5>
                    <img src="{{ asset('landing-page/gratitude.png') }}" class="w-50 mb-2" />
                    <p>Love yourself by journaling & enhancing emotional resilience.</p>
                </div>
            </div>
        </div>

        <!-- Specialists -->
        <div id="specialists" class="my-5 py-5 specialists">
            <div class="d-flex align-items-center gap-5">
                <div class="specialists-list d-flex flex-wrap text-center gap-3 justify-content-center">
                    <div class="border px-4 pt-4 rounded-2 justify-content-center">
                        <img
                            src="{{ asset('landing-page/dr1.jpg') }}"
                            alt="dr. Jerome Bell" />
                        <p class="fw-bold mt-3">dr. Jerome Bell</p>
                    </div>
                    <div class="border px-4 pt-4 rounded-2 justify-content-center">
                        <img
                            src="{{ asset('landing-page/dr2.jpg') }}"
                            alt="dr. Amelia Schmidt" />
                        <p class="fw-bold mt-3">dr. Amelia Schmidt</p>
                    </div>
                    <div class="border px-4 pt-4 rounded-2 justify-content-center">
                        <img
                            src="{{ asset('landing-page/dr3.jpg') }}"
                            alt="dr. Rosalind Davies" />
                        <p class="fw-bold mt-3">dr. Rosalind Davies</p>
                    </div>
                    <div class="border px-4 pt-4 rounded-2 justify-content-center">
                        <img
                            src="{{ asset('landing-page/dr4.jpg') }}"
                            alt="dr. Edward Bell" />
                        <p class="fw-bold mt-3">dr. Edward Bell</p>
                    </div>
                </div>
                <div class="w-75 d-flex flex-column gap-2">
                    <h2 class="fw-bold">
                        <span class="colors-ijo">Expert</span> Care from <span class="colors-ijo">Trusted Professionals</span>
                    </h2>
                    <p>Your <strong>mental health matters</strong>, and our team of
                        <strong>dedicated professionals</strong> is here to
                        <strong>support you every step</strong> of the way.
                        <br><br>
                        We have a network of
                        <strong>experienced psychologists, therapists, and counselors</strong>
                        who specialize in various mental health fields, including stress
                        management, anxiety, depression, relationship counseling, and
                        personal growth.
                        <br><br>
                        Take the <strong>first step toward</strong> emotional well-being
                        today by exploring our list of
                        <strong>trusted mental health professionals</strong>.
                    </p>
                    <button>See More</button>
                </div>
            </div>
        </div>

        <!-- Reviews -->

        <section id="review">
            <h2 class="fw-bold text-center mb-5">Our <span class="colors-ijo">Reviews</span></h2>
            <div class="w-75 m-auto reviews">
                <div id="rating" class="mb-3">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                </div>
                <p id="review-desc"></p>
                <div class="d-flex align-items-center p-0">
                    <p class="icon-reviewer m-0 text-center align-content-center"></p>
                    <div class="d-flex flex-column p-0 mx-3">
                        <p id="user-name" class="fw-bold m-0"></p>
                        <p id="review-date" class="m-0"></p>
                    </div>
                </div>
            </div>
            <div id="users" class="d-flex justify-content-center align-items-center mt-4">
            </div>
        </section>
    </main>
    <footer>
        <div class="container mt-5 py-5">
            <img src="{{ asset('landing-page/logo.png') }}" alt="Yunoa Space" width="160px" color="black" class="footer-img">
            <p class="mt-3">Yunoa Space adalah platform kesehatan mental yang membantu Anda menemukan ketenangan dan keseimbangan dalam hidup. Kami menyediakan akses mudah ke layanan konsultasi profesional untuk mendukung perjalanan kesehatan mental Anda.</p>
            <div class="mt-1 d-flex gap-5">
                <a class="link-light" href="#about">About Us</a>
                <a class="link-light" href="#feature">Features</a>
                <a class="link-light" href="#specialists">Find a doctor</a>
                <a class="link-light" href="#reviews">Testimonials</a>
            </div>
            <p class="mt-4">&copy; 2025 Yunoa Space. All rights reserved.</p>
        </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const reviews = [{
            review: "Before I found Yunoa Space, I was in a very dark place emotionally. I felt like I had no one to talk to, and the idea of therapy seemed intimidating and out of reach. But from the moment I started using this platform, I felt a sense of comfort I hadn't felt in years. The combination of gentle AI support and access to real professionals made me feel safe, heard, and validated. I’ve learned so much about my emotional patterns, and now I’m slowly rebuilding my confidence. This platform didn’t just help me cope — it gave me a reason to start healing.",
            name: "Sarah L",
            initial: "SL",
            image: "landing-page/user1.jpg",
            date: "Thursday, 24th February 2025",
            rating: 3
        },
        {
            review: "Yunoa Space is unlike any other mental health support I’ve tried. The interface is calming, the responses feel deeply human, and the daily affirmations genuinely help set the tone for my day. What truly stands out is how the platform doesn’t try to fix me — instead, it helps me understand myself better. The ability to choose how I want to be responded to—whether I just need someone to listen or offer guidance—has made me feel in control of my healing journey. It’s become a space I return to every day with trust and comfort.",
            name: "Daniel W.",
            initial: "DW",
            image: "landing-page/user2.jpg",
            date: "Thursday, 24th March 2025",
            rating: 4
        },
        {
            review: "It’s difficult to put into words just how impactful this experience has been for me. I used to wake up every morning with a heavy heart, not knowing how to deal with the overwhelming thoughts in my head. Since I started using Yunoa Space, I’ve found a rhythm that works for me. The emotional validation from the AI and the gentle check-ins have created a daily anchor for me. What surprised me most was how deeply I could reflect just through the conversations here. For the first time, I feel like I’m not navigating my emotions alone.",
            name: "Mr. Adit",
            initial: "MA",
            image: "landing-page/user3.jpg",
            date: "Friday, 21th February 2025",
            rating: 5
        },
        {
            review: "As someone who has dealt with mental health challenges for over a decade, I’ve tried countless tools and platforms, but none have resonated with me the way Yunoa Space has. The thoughtful design, the care behind every interaction, and the flexibility of the support I receive all contribute to a sense of emotional safety I rarely experience. Every message I write feels received with understanding. This space has become more than an app—it feels like a companion that holds space for my growth, gently guiding me without pressure.",
            name: "James B.",
            initial: "JB",
            image: "landing-page/user4.jpg",
            date: "Sunday, 22th July 2025",
            rating: 4
        },
        {
            review: "Yunoa Space helped me at a time when I couldn’t help myself. I was mentally exhausted, constantly overwhelmed, and deeply isolated. What I needed most was not someone to tell me what to do, but someone—or something—that would simply understand. This platform gave me exactly that. With every session, I felt more connected to my inner self. It allowed me to explore my emotions, cry when I needed to, and reflect on parts of myself I’d been ignoring for years. I still have a long way to go, but I no longer feel lost in the process.",
            name: "Maya A.",
            initial: "MA",
            image: "landing-page/user5.jpg",
            date: "Friday, 24th December 2025",
            rating: 3
        }
    ];

    const userSelect = document.getElementById("users");
    const reviewText = document.getElementById("review-desc");
    const reviewUser = document.getElementById("user-name");
    const reviewDate = document.getElementById("review-date");
    const reviewIcon = document.querySelector(".icon-reviewer");

    reviewText.textContent = reviews[2].review;
    reviewUser.textContent = reviews[2].name;
    reviewDate.textContent = reviews[2].date;
    reviewIcon.textContent = reviews[2].initial;
    document.querySelectorAll("#rating i").forEach((rate, i) => {
        if (i < reviews[2].rating) {
            rate.classList.add("color-rating");
        }
    });

    reviews.forEach((review, i) => {
        let makeDiv = document.createElement("div");

        if (i == 2) {
            makeDiv.setAttribute("class", "clicked");
        }
        let makeImg = document.createElement("img");
        makeImg.setAttribute("src", review.image);
        makeImg.setAttribute("alt", review.name);
        makeImg.setAttribute("class", "w-100 h-100 object-fit-cover rounded-pill");

        makeImg.addEventListener("click", () => {
            document.querySelector("#users .clicked").classList.remove("clicked");

            makeDiv.classList.add("clicked");

            reviewText.textContent = review.review;
            reviewUser.textContent = review.name;
            reviewDate.textContent = review.date;
            reviewIcon.textContent = review.initial;

            document.querySelectorAll("#rating i").forEach(rate => {
                rate.classList.remove("color-rating");
            });
            document.querySelectorAll("#rating i").forEach((rate, index) => {
                if (index < review.rating) {
                    rate.classList.add("color-rating");
                }
            });
        });

        makeDiv.appendChild(makeImg);
        userSelect.appendChild(makeDiv);
    });
</script>

</html>