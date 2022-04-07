<h1>Detalle de Venta</h1>
<hr>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>Código</th>
        <th>Venta Id</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>precio</th>
        <th>IVA</th>
        <th>Observacion</th>
        <th>Descuento</th>
      </tr>
    </thead>
    <tbody>
      {{foreach ventas_detalles}}
        <tr>
          <td>{{idDetalle}}</td>
          <td>{{idVenta}}</td>
          <td>{{nombre}}</td>
          <td>{{cantidad}}</td>
          <td>{{precio}}</td>
          <td>{{IVA}}</td>
          <td>{{observacion}}</td>
          <td>{{descuento}}</td>
        </tr>
      {{endfor ventas_detalles}}
    </tbody>
  </table>
</section>


