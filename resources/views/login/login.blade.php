@extends('login_template')
@section('title')
    Veris - Login
@endsection

@section('content')

<div class="card bg-eliminarb">
    <div class="card-body">
    <div class="text-center mb-4">
      <img src="../../images/Logo-Veris 2.png">
    </div>
      
      <!-- Logo -->
      
      <!-- /Logo -->
      <p class="fs-4 mb-1 pt-2 bg-colortext2">Bienvenido!</p>
      <p class="fs-6 mb-4 fw-bold bg-colortext">Iniciar Sesión</p>
      

      <form id="formAuthentication" class="mb-3" action="/autenticar" method="POST">
        @csrf
        <div class="mb-3">
          <label for="user" class="form-label bg-colortext fw-bold">Usuario</label>
          <input
            type="text"
            class="form-control"
            id="user"
            name="user"
            placeholder="Usuario o Correo Electrónico"
            autofocus
            required
          />
        </div>
        <div class="mb-3 form-password-toggle">
          <div class="d-flex justify-content-between">
            <label class="form-label bg-colortext fw-bold" for="password">Contraseña</label>

          </div>
          <div class="input-group input-group-merge">
            <input
              type="password"
              id="password"
              class="form-control"
              name="password"
              placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
              aria-describedby="password"
              required
            />

          </div>
        </div>
        <div class="mb-3">
          <button class="btn btn-primary d-grid w-100 bg-colorboton" type="submit" onclick="">Entrar</button>
        </div>
        <div class="mb-1 text-center">
            <!-- <label class="form-check-label bg-colortext" for="noCerrarSeesion"> No cerrar sesión </label> -->
        </div>
        <div class="mb-1 text-center">
            <a class="bg-colortext" href="/olvide-clave"> Olvide mi Contraseña</a>
        </div>
        
      </form>
      
    </div>
  </div>
@endsection