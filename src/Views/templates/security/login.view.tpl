<section class="container vh-100 d-flex align-items-center justify-content-center" style="width: 100% !important;">
  <div class="card my-5 w-100">
    <div class="card-header">
      <h3 class="text-center">Iniciar sesión</h3>
    </div>
    <div class="card-body"> 
      <form class="form" method="post" action="index.php?page=sec_login{{if redirto}}&redirto={{redirto}}{{endif redirto}}">
        <div class="form-group">
          <label for="txtEmail">Correo Electrónico</label>
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

        {{if generalError}}
        <div class="my-3 text-danger">
          {{generalError}}
        </div>
        {{endif generalError}}

        <button type="submit" id="btnLogin" class="btn btn-primary">Iniciar Sesión</button>
      </form>
    </div>
  </div>
</section>

