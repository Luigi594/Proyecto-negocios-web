<section class="container vh-100 d-flex align-items-center justify-content-center">
  <div class="card my-5 w-100">
    <div class="card-header">
      <h3 class="text-center">Regístrate</h3>
    </div>
    <div class="card-body"> 
      <form class="form" method="post" action="index.php?page=sec_register">

        {{if errorGeneral}}
          <div class="my-3 text-danger">{{errorGeneral}}</div>
        {{endif errorGeneral}}

        <div class="form-group">
          <label for="txtNombre">Nombre completo</label>
          <input type="text" class="form-control" id="txtNombre" name="txtNombre" value="{{txtNombre}}" placeholder="Ingrese su nombre completo">
        </div>

        {{if errorNombre}}
          <div class="my-3 text-danger">{{errorNombre}}</div>
        {{endif errorNombre}}

        <div class="form-group">
          <label for="txtEmail">Correo electrónico</label>
          <input type="email" class="form-control" id="txtEmail" name="txtEmail" value="{{txtEmail}}" placeholder="Ingrese su correo">
        </div>

        {{if errorEmail}}
          <div class="my-3 text-danger">{{errorEmail}}</div>
        {{endif errorEmail}}

        <div class="form-group">
          <label for="txtPswd">Contraseña</label>
          <input type="password" class="form-control" id="txtPswd" name="txtPswd" value="{{txtPswd}}" placeholder="Ingrese su contraseña">
        </div>

        {{if errorPswd}}
          <div class="my-3 text-danger">{{errorPswd}}</div>
        {{endif errorPswd}}

        <button type="submit" id="btnSignin" class="btn btn-primary">Crear cuenta</button>
      </form>
    </div>
  </div>
</section>

