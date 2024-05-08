@extends('layouts.app')

@section('content')
    <div class="container-fluid position-relative d-flex justify-content-center align-items-center vh-100">
        <img src="SheFlowPerfil.png" class="w-75 img-fluid perfilbg-img" alt="...">
        <div class="position-absolute text-white" style="top: 55%; left: 30%; transform: translate(-50%, -50%);">
        <div style="position: relative;">
                @if(auth()->check())
                    {{-- Verifica si el usuario está autenticado --}}
                    @if(auth()->user()->perfil)
                        <img src="{{ asset(auth()->user()->perfil) }}" id="perfil-img" data-bs-toggle="modal"
                             data-bs-target="#perfilModal" alt="Perfil"
                             style="width: 100px; height: 100px; border-radius: 50%; border: 1px solid #A0404B;">
                    @else
                        <img src="SheFlowNoPerfil.png" id="perfil-img" data-bs-toggle="modal"
                             data-bs-target="#perfilModal" alt="No Perfil"
                             style="width: 100px; height: 100px; border-radius: 50%; border: 1px solid #A0404B; cursor: pointer; margin-bottom: 20px;">
                    @endif
                    <br>
                    <p style="color: #A0404B;">Nombre: {{ auth()->user()->nombre }}</p>
                    <p style="color: #A0404B;">Apellidos: {{ auth()->user()->apellidos }}</p>
                    <p style="color: #A0404B;">Fecha de
                        nacimiento: {{ auth()->user()->fecha_nacim->format('d/m/Y') }}</p>
                    <p style="color: #A0404B;">Correo electrónico: {{ auth()->user()->email }}</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal para actualizar perfil -->
    <!-- Modal para actualizar perfil -->
    <div class="modal fade" id="perfilModal" tabindex="-1" aria-labelledby="perfilModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="perfilModalLabel">Actualizar perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="avatar" action="{{ route('uploadAvatar') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <label for="perfil" class="form-label">Elegir un avatar:</label>
                            <div id="avatarCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="d-flex justify-content-center">
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAvatar7.0.png" class="circle-img" alt="Avatar 19">
                                            </div>
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAvatar8.png" class="circle-img" alt="Avatar 20">
                                            </div>
                                            <div class="circle-img-container">
                                                <img src="SheFlowAvatar8.0.png" class="circle-img" alt="Avatar 21">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="d-flex justify-content-center">
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAvatar6.png" class="circle-img" alt="Avatar 16">
                                            </div>
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAvatar6.0.png" class="circle-img" alt="Avatar 17">
                                            </div>
                                            <div class="circle-img-container">
                                                <img src="SheFlowAvatar7.png" class="circle-img" alt="Avatar 18">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="d-flex justify-content-center">
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAvatar1.0.png" class="circle-img" alt="Avatar 7">
                                            </div>
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAvatar2.png" class="circle-img" alt="Avatar 8">
                                            </div>
                                            <div class="circle-img-container">
                                                <img src="SheFlowAvatar2.0.png" class="circle-img" alt="Avatar 9">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="d-flex justify-content-center">
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAvatar3.png" class="circle-img" alt="Avatar 10">
                                            </div>
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAvatar3.0.png" class="circle-img" alt="Avatar 11">
                                            </div>
                                            <div class="circle-img-container">
                                                <img src="SheFlowAvatar4.png" class="circle-img" alt="Avatar 12">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="d-flex justify-content-center">
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAvatar4.0.png" class="circle-img" alt="Avatar 13">
                                            </div>
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAvatar5.png" class="circle-img" alt="Avatar 14">
                                            </div>
                                            <div class="circle-img-container">
                                                <img src="SheFlowAvatar5.0.png" class="circle-img" alt="Avatar 15">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="d-flex justify-content-center">
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAvatar9.png" class="circle-img" alt="Avatar 22">
                                            </div>
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAvatar9.0.png" class="circle-img" alt="Avatar 23">
                                            </div>
                                            <div class="circle-img-container">
                                                <img src="SheFlowAvatar10.png" class="circle-img" alt="Avatar 24">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="d-flex justify-content-center">
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAvatar10.0.png" class="circle-img" alt="Avatar 13">
                                            </div>
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAvatar11.png" class="circle-img" alt="Avatar 14">
                                            </div>
                                            <div class="circle-img-container">
                                                <img src="SheFlowAvatar11.0.png" class="circle-img" alt="Avatar 15">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="d-flex justify-content-center">
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAvatar0.png" class="circle-img" alt="Avatar 4">
                                            </div>
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAvatar.png" class="circle-img" alt="Avatar 5">
                                            </div>
                                            <div class="circle-img-container">
                                                <img src="SheFlowAnimal1.0.png" class="circle-img" alt="Avatar 6">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="d-flex justify-content-center">
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAnimal.png" class="circle-img " alt="Avatar 1">
                                            </div>
                                            <div class="circle-img-container mr-3">
                                                <img src="SheFlowAnimal0.png" class="circle-img" alt="Avatar 2">
                                            </div>
                                            <div class="circle-img-container">
                                                <img src="SheFlowAnimal1.png" class="circle-img" alt="Avatar 3">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Agregar más imágenes para el carrusel según sea necesario -->
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#avatarCarousel"
                                        data-bs-slide="prev" style="margin-left: -30px;">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Anterior</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#avatarCarousel"
                                        data-bs-slide="next" style="margin-right: -30px;">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Siguiente</span>
                                </button>
                            </div>
                            <input type="hidden" id="avatarSeleccionado" name="perfil">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Mostrar el modal cuando se hace clic en la imagen de perfil
            $('#perfil-img').click(function () {
                $('#perfilModal').modal('show');
            });
        });

        // Agregar evento de mostrado del modal
        $('#perfilModal').on('shown.bs.modal', function () {
            // Manejar el clic en las imágenes dentro del modal
            $('#perfilModal .carousel-item img').click(function () {
                // Obtener la ruta de la imagen
                var rutaImagen = $(this).attr('src');

                // Mostrar un aviso en pantalla
                alert("¡Has seleccionado esta imagen como tu avatar!");

                // Preguntar al usuario si está seguro
                if (confirm("¿Estás seguro de seleccionar esta imagen como tu avatar?")) {
                    // Extraer el nombre de la imagen de la ruta
                    var nombreImagen = rutaImagen.substring(rutaImagen.lastIndexOf('/') + 1);

                    // Establecer el valor del campo oculto con el nombre de la imagen
                    $('#avatarSeleccionado').val(nombreImagen);

                    // Enviar el formulario de avatar
                    $('#avatar').submit();
                }
            });
        });
    </script>
@endpush
