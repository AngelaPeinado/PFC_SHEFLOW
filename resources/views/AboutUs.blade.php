@extends('layouts.app')

@section('content')
    <br>
    <br>
    <br>

    <div class="main-wrapper">
        <div class="custom-row">
            <div class="custom-column">
                <div class="text-container">
                    <br>
                    <h2><strong>Algo más sobre nosotros...</strong></h2>
                    <br>
                    <p>
                        En <strong>SheFlow</strong>, nos dedicamos a empoderar a las mujeres a través del conocimiento y el cuidado de su salud. Nuestro equipo está formado por profesionales comprometidos con el bienestar femenino.
                    </p>
                    <br>
                    <p>
                        Nuestra misión es proporcionar a las mujeres las herramientas y la información necesarias para tomar decisiones informadas sobre su salud y bienestar. Creemos en la importancia de la educación y la prevención para promover un estilo de vida saludable y feliz.
                    </p>
                    <br>
                    <p>
                        Nos esforzamos por crear una comunidad inclusiva y solidaria donde las mujeres puedan compartir sus experiencias, recibir apoyo mutuo y encontrar recursos confiables para abordar sus necesidades de salud.
                    </p>
                </div>
            </div>
            <div class="custom-column">
                <img src="quienessomos.png" alt="Imagen 1" style="width: 700px; height: auto;">
            </div>
        </div>
    </div>
    <div class="custom-row">
        <div class="custom-column">
            <img src="womanchillin.png" alt="Imagen 2" style="width: 500px; height: auto;">
        </div>
        <div class="custom-column">
            <div class="text-container">
                <h3><strong>Nuestros valores son claros</strong></h3>
                <br>
                <ul>
                    <li><strong>Empoderamiento:</strong> Creemos en capacitar a las mujeres para que tomen el control de su salud y su vida.</li>
                    <li><strong>Educación:</strong> Valoramos la información precisa y basada en evidencia como una herramienta fundamental para la toma de decisiones informadas.</li>
                    <li><strong>Respeto:</strong> Fomentamos un ambiente de respeto mutuo y aceptación de la diversidad en todas sus formas.</li>
                    <li><strong>Colaboración:</strong> Trabajamos en equipo y en colaboración con expertos en salud para ofrecer contenido relevante y útil.</li>
                </ul>
                <br>
                <p><strong>Únete a SheFlow y comienza tu viaje hacia una vida más saludable y plena.</strong></p>
            </div>
        </div>
    </div>
    </div>
    <footer class="bg-body-tertiary text-center">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <!-- Section: Social media -->
            <section class="mb-4">


                <!-- Google -->
                <a
                    data-mdb-ripple-init
                    class="btn text-white btn-floating m-1"
                    style="background-color: #dd4b39;"
                    href="https://www.google.com/?hl=es"
                    role="button"
                ><i class="fab fa-google"></i></a>

                <!-- Instagram -->
                <a
                    data-mdb-ripple-init
                    class="btn text-white btn-floating m-1"
                    style="background-color: #ac2bac;"
                    href="https://www.instagram.com/angelapwl/"
                    role="button"
                ><i class="fab fa-instagram"></i></a>

                <!-- Github -->
                <a
                    data-mdb-ripple-init
                    class="btn text-white btn-floating m-1"
                    style="background-color: #333333;"
                    href="https://github.com/AngelaPeinado"
                    role="button"
                ><i class="fab fa-github"></i></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <hr>
        <div class="container p-4 pb-0">
            <!-- Section: Form -->
            <section class="">
                <form action="">
                    <!--Grid row-->
                    <div class="row d-flex justify-content-center">
                        <!--Grid column-->
                        <div class="col-auto">
                            <p class="pt-2">
                                <strong>Sign up for our newsletter</strong>
                            </p>
                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-md-5 col-12">
                            <!-- Email input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" id="form5Example26" class="form-control" />
                                <label class="form-label" for="form5Example26">Email address</label>
                            </div>
                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-auto">
                            <!-- Submit button -->
                            <button data-mdb-ripple-init type="submit" class="btn btn-pink mb-4">
                                Subscribe
                            </button>
                        </div>
                        <!--Grid column-->
                    </div>
                    <!--Grid row-->
                </form>
            </section>
            <!-- Section: Form -->
        </div>
    </footer>
@endsection
