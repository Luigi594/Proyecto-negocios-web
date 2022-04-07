<h1>Detalle de Venta</h1>
<hr>
<table>
  <thead>
    <tr>
      <td>Código</td>
      <td>Venta Id</td>
      <td>Producto Id</td>
      <td>Cantidad</td>
      <td>precio</td>
      <td>IVA</td>
      <td>Observacion</td>
      <td>Descuento</td>
      <td>Acciones</td>
    </tr>
  </thead>
  <tbody>
    {{foreach ventas_detalles}}
    <tr>
      <td>{{idDetalle}}</td>
      <td>{{idVenta}}</td>
      <td>{{idProducto}}</td>
      <td>{{cantidad}}</td>
      <td>{{precio}}</td>
      <td>{{IVA}}</td>
      <td>{{observacion}}</td>
      <td>{{descuento}}</td>
       <td>
        <a href="">Eliminar</a>
      </td>
    </tr>
    {{endfor ventas_detalles}}
  </tbody>
</table>
