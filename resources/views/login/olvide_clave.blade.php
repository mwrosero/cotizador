@extends('login_template')
@section('title')
    Veris - Olvide Contraseña
@endsection
@section('content')
            <!-- Login -->
            <div class="card bg-eliminarb">
              <div class="card-body">
              <div class="text-center mb-4">
                <img src="../../images/Logo-Veris 2.png">
              </div>         
                <!-- Logo -->      
                <!-- /Logo -->
                <p class="fs-4 mb-1 pt-2 text-center bg-colortext fw-bold">Olvidé mi Contraseña</p>
                <p class="fs-6 mb-4  text-center bg-colortext">Ingresa tu Usuario o Correo Electrónico </p>
  
                <form id="formAuthentication" class="mb-3" action="/recuperar-clave" >
                  <div class="mb-3">
                    <label for="email" class="form-label bg-colortext fw-bold mt-2">Usuario o Correo Electrónico</label>
                    <input
                      type="text"
                      class="form-control"
                      id="email"
                      name="email-username"
                      autofocus
                      required
                    />
                  </div>
                 
                  <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100 bg-colorboton" type="submit" id="recuperarContrasena">Recuperar Contraseña</button>
                  </div>
                  <div class="mb-3 text-center">
                      <a href="login" class="form-cha bg-colortext" for="noCerrarSeesion"> Regresar al Login</a>
                  </div>
                </form>
                
              </div>
            </div>
            <!-- /Register -->
@endsection