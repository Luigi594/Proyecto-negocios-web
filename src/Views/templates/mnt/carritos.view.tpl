<h1>Carrito</h1>
<hr>
<table>
  <thead>
    <tr>
      <td>Código Cliente</td>
      <td>Codigo Producto</td>
      <td>Cantidad</td>
      <td>Precio</td>
      <td>Fecha/Hora</td>
    </tr>
  </thead>
  <tbody>
    {{foreach carritos}}
    <tr>
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
