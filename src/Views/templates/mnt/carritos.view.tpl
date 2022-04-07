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
        <a href="">Eliminar</a>
      </td>
    </tr>
    {{endfor carritos}}
  </tbody>
  </table>
  <form class="d-flex flex-column align-items-end">
        <div class="form-group col-md-2">
            <label for="CarritoSubtotal" class="font-weight-bold">Subtotal: </label>
            <input type="text" readonly class="form-control" id="CarritoSubtotal" value="{{Subtotal}}">
        </div>
        <div class="form-group col-md-2">
            <label for="CarritoISV" class="font-weight-bold">ISV: </label>
            <input type="text" readonly class="form-control" id="CarritoISV" value="{{Subtotal}}">
        </div>
        <div class="form-group col-md-2">
            <label for="CarritoTotal" class="font-weight-bold">Total: </label>
            <input type="text" readonly class="form-control" id="CarritoTotal" value="{{Total}}">
        </div>
    </form>

   <fieldset class="row flex-center">
            <button type="submit" name="btnConfirmar" class="btn primary">Confirmar</button>&nbsp;&nbsp;&nbsp;
            <button type="button" id="btnCancelar" class="btn danger">Cancelar</button>
   </fieldset>        
</section>

<script>
    
    document.addEventListener("DOMContentLoaded", (e) => {

        let btnCancelar = document.getElementById("btnCancelar");
        btnCancelar.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=mnt.");
        })
    });
</script>