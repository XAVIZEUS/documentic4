<!doctype html>
<html lang="en">

<head>
    <x-head/>
    <title>LOGIN</title>
    <link rel="icon" href="{{asset('/img/perfil.jpg')}}"/>


    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    
    <section class="vh-100"
        style="background-image: url('{{ asset('imgs/fondoub.jpeg') }}'); background-repeat: no-repeat; background-size: cover">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">

                            <div
                                class="col-md-6 col-lg-5 d-none d-md-flex justify-content-center align-items-center position-relative">
                                <h5 class="fw-normal"
                                    style="text-align:justify; font-weight: bold !important; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; position:absolute; top:2cm;max-width: 100%; height: auto;z-index:1; font-size: 45px">
                                    {{$nombreE}}</h5>
                                <img src="{{ asset('imgs/logo.png') }}" alt="Logo de la empresa"
                                    style="max-width: 100%; height: auto;">
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form action="{{route('login.ingresar')}}" method="post">
                                        @csrf
                                        
                                        <h5 class="fw-normal mb-5 pb-3"
                                            style="letter-spacing: 1px; font-weight: bold !important; font-family:Arial, Helvetica, sans-serif">
                                            Iniciar sesión</h5>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="text"
                                                style="font-family: Arial, sans-serif; font-size: 0.5cm" name="usuario" id="usuario"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="usuario"
                                                style="font-family:Arial, sans-serif; font-weight: bold">Usuario</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password"
                                                style="font-family:Arial, sans-serif; font-size: 0.5cm" name="pasword" id="pasword"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="pasword"
                                                style="font-family:Arial, sans-serif; font-weight: bold">Contraseña</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-lg btn-block btn-primary" type="submit"
                                                style="background-color: #154733; color: white;">Ingresar</button>
                                        </div>
                                    </form>

                                </div>
                                
                            </div>
                        </div>

                        <!-- error inicio de sesion -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>


</html>
