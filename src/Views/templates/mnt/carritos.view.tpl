<h1>Carrito</h1>
<hr>
<section class="WWList">
  <table>
  <thead>
    <tr>
      <th>Código</th>
      <th>Cliente Id</th>
      <th>Producto Id</th>
      <th>Cantidad</th>
      <th>Precio</th>
      <th>Fecha/Hora</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    {{foreach carritos}}
    <tr>
      <td>{{id}}</td>
      <td>{{clienteId}}</td>
      <td>{{productoId}}</td>
      <td>{{cantidad}}</td>
      <td>{{precio}}</td>
      <td>{{fechahora}}</td>
      <td>
       <a href="index.php?page=mnt.carritos.carrito&mode=DEL&id={{id}}">Eliminar</a>
      </td>
    </tr>
    {{endfor carritos}}
  </tbody>
  </table>
  <form class="d-flex flex-column align-items-end" action="index.php?page=checkout_checkout" method="post">
        <fieldset class="row flex-center">

            <div class="col-xs-12 mt-5">
                <div class="center-block">
                    <button type="submit" name="btnConfirmar" class="btn primary">Confirmar</button>&nbsp;&nbsp;&nbsp;
                    <button type="button" id="btnCancelar" class="btn danger">Cancelar</button>
                </div> 
            </div>
        </fieldset>
    </form>           
</section>

<script>
    
    document.addEventListener("DOMContentLoaded", (e) => {

        let btnCancelar = document.getElementById("btnCancelar");
        btnCancelar.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=mnt.catalogos.catalogos");
        })
    });
</script>