<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="Susana Nazareth Piñero Rodríguez" />
        <title>Bienvenido!</title>
        <link href="{{ asset('sb-ui-kit-pro/dist/css/styles.css')  }}" rel="stylesheet" />
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico')  }}" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="layoutDefault">
            <div id="layoutDefault_content">
                <main>
                    <nav class="navbar navbar-marketing navbar-expand-lg bg-transparent navbar-dark fixed-top">
                        <div class="container">
                            <a class="navbar-brand " href="#"><img src="{{ asset('/img/logo.png')  }}" alt="Logo WIN Perú"></a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto mr-lg-1">
                                    <li class="nav-item"><div class="first"><a class="nav-link info" id="inf">Información </a></div></li>
                                </ul>
                                <a class="btn-primary btn rounded-pill px-4 ml-lg-4" href="/app">Ingresar<i class="fas fa-arrow-right ml-1"></i></a>
                            </div>
                        </div>
                    </nav>
                </main>
            </div>
            <div id="layoutDefault_footer" >
                <footer class="footer pt-10 pb-5 mt-auto bg-dark footer-dark ">
                    <div class="container">
                        <hr class="my-5" />
                        <div class="row align-items-center">
                            <div class="col-md-6 small">Copyright &copy; Susana Piñero {{ date('Y') }}</div>
                            <div class="col-md-6 text-md-right small">
                                <a href="javascript:void(0);">Politica de privacidad</a>
                                &middot;
                                <a href="javascript:void(0);">Terminos &amp; Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('sb-ui-kit-pro/dist/js/scripts.js')  }}"></script>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init({
                disable: 'mobile',
                duration: 600,
                once: true
            });
        </script>
    </body>
</html>
