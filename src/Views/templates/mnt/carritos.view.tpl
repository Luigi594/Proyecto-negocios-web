<h1>Carrito</h1>
<hr>
<table>
  <thead>
    <tr>
      <td>Código</td>
      <td>Cliente Id</td>
      <td>Producto Id</td>
      <td>Cantidad</td>
      <td>Precio</td>
      <td>Fecha/Hora</td>
      <td>Acciones</td>
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
