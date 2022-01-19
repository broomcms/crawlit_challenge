<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crawlit</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark menu shadow fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
            <h1>Crawl IT</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#crawl">Crawl It</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
            <button type="button" class="rounded-pill btn-rounded">
                +1 514-795-4321
                <span>
                <i class="fas fa-phone-alt"></i>
                </span>
            </button>
            </div>
        </div>
    </nav>

    <section id="home" class="intro-section">
        <div class="container">
            <div class="row align-items-center text-white">
            <!-- START THE CONTENT FOR THE INTRO  -->
            <div class="col-md-6 intros text-start">
                <h1 class="display-2">
                <span class="display-2--intro">Hey!, I'm Patrick</span>
                <span class="display-2--description lh-base">
                    this is a laravel based crawler for a challenge at Agency Analytics
                </span>
                </h1>
                <a class="rounded-pill btn-rounded hrefbtn" href="#crawl">Start Crawling
                <span><i class="fas fa-arrow-right"></i></span>
                </a>
            </div>
            <!-- START THE CONTENT FOR THE VIDEO -->
            <div class="col-md-6 intros text-end">
                <div class="video-box">
                <img src="images/arts/intro-section-illustration.png" alt="video illutration" class="img-fluid">
                <a href="#" class="glightbox position-absolute top-50 start-50 translate-middle">
                    <span>
                    <i class="fas fa-play-circle"></i>
                    </span>
                    <span class="border-animation border-animation--border-1"></span>
                    <span class="border-animation border-animation--border-2"></span>
                </a>
                </div>
            </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,160L48,176C96,192,192,224,288,208C384,192,480,128,576,133.3C672,139,768,213,864,202.7C960,192,1056,96,1152,74.7C1248,53,1344,107,1392,133.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
    </section>

    <section id="crawl" class="get-started">
        <div class="container">
            <div class="row text-center">
                <h1 class="display-3 fw-bold text-capitalize">Get started</h1>
                <div class="heading-line"></div>
                <p class="lh-lg">
                    Choose a start URL and how many pages you would like to scan. Crawlit will take care of the rest.
                </p>
            </div>

            <!-- START THE CTA CONTENT  -->
            <div class="row text-white">
                <div class="col-12 col-lg-6 gradient shadow p-3">
                    <div class="cta-info w-100">
                        <h4 class="display-4 fw-bold">100% Satisfaction Guaranteed</h4>
                        <h3 class="display-3--brief">What will be the next step?</h3>
                        <ul class="cta-info__list">
                            <li>Number of pages crawled</li>
                            <li>Number of a unique images</li>
                            <li>Number of unique internal links</li>
                            <li>Number of unique external links</li>
                            <li>Average page load in seconds</li>
                            <li>Average word count</li>
                            <li>Average title length</li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-6 bg-white shadow p-3">
                    <div class="form w-100 pb-2">
                        <h4 class="display-3--title mb-5">Crawl it!</h4>
                        <form action="/crawl" method="post" class="row">
                            @csrf
                            <div class="col-lg-6 col-md mb-3">
                            <input name="url" type="text" placeholder="https://" id="url" class="shadow form-control form-control-lg">
                            </div>
                            <div class="col-lg-6 col-md mb-3">
                            <input name="pages" type="numeric" placeholder="# of pages" id="pages" class="shadow form-control form-control-lg">
                            </div>
                            <div class="text-center d-grid mt-1">
                            <button type="submit" class="btn btn-primary rounded-pill pt-3 pb-3">
                                submit
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="contact" class="footer">
        <div class="container">
            <div class="row">
                <!-- CONTENT FOR THE MOBILE NUMBER  -->
                <div class="col-md-4 col-lg-4 contact-box pt-1 d-md-block d-lg-flex d-flex">
                    <div class="contact-box__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-call" viewBox="0 0 24 24" stroke-width="1" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                            <path d="M15 7a2 2 0 0 1 2 2" />
                            <path d="M15 3a6 6 0 0 1 6 6" />
                        </svg>
                    </div>
                    <div class="contact-box__info">
                        <a href="#" class="contact-box__info--title">514-795-4321</a>
                        <p class="contact-box__info--subtitle">  Mon-Fri 9am-6pm</p>
                    </div>
                </div>  
                <!-- CONTENT FOR EMAIL  -->
                <div class="col-md-4 col-lg-4 contact-box pt-1 d-md-block d-lg-flex d-flex">
                    <div class="contact-box__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-opened" viewBox="0 0 24 24" stroke-width="1" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <polyline points="3 9 12 15 21 9 12 3 3 9" />
                            <path d="M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10" />
                            <line x1="3" y1="19" x2="9" y2="13" />
                            <line x1="15" y1="13" x2="21" y2="19" />
                        </svg>
                    </div>
                    <div class="contact-box__info">
                        <a href="#" class="contact-box__info--title">drisate@hotmail.com</a>
                        <p class="contact-box__info--subtitle">Ready to be Hired!</p>
                    </div>
                </div>
                <!-- CONTENT FOR LOCATION  -->
                <div class="col-md-4 col-lg-4 contact-box pt-1 d-md-block d-lg-flex d-flex">
                    <div class="contact-box__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" viewBox="0 0 24 24" stroke-width="1" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <line x1="18" y1="6" x2="18" y2="6.01" />
                            <path d="M18 13l-3.5 -5a4 4 0 1 1 7 0l-3.5 5" />
                            <polyline points="10.5 4.75 9 4 3 7 3 20 9 17 15 20 21 17 21 15" />
                            <line x1="9" y1="4" x2="9" y2="17" />
                            <line x1="15" y1="15" x2="15" y2="20" />
                        </svg>
                    </div>
                    <div class="contact-box__info">
                        <a href="#" class="contact-box__info--title">Quebec, Canada</a>
                        <p class="contact-box__info--subtitle">But who cares, we work remotly!</p>
                    </div>
                </div>
            </div>
        </div>

    </footer>

    <!-- BACK TO TOP BUTTON  -->
    <a href="#" class="shadow btn-primary rounded-circle back-to-top">
        <i class="fas fa-chevron-up"></i>
    </a>
   
    <script src="assets/vendors/js/glightbox.min.js"></script>

    <script type="text/javascript">
      const lightbox = GLightbox({
        'touchNavigation': true,
        'href': 'https://www.youtube.com/watch?v=J9lS14nM1xg',
        'type': 'video',
        'source': 'youtube', //vimeo, youtube or local
        'width': 900,
        'autoPlayVideos': 'true',
      });
    
    </script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    </body>
</html>