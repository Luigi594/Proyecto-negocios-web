<h1>Historico de Ventas de X Usuario</h1>
<hr>
<section class="WWList">
  <table>
  <thead>
    <tr>
      <th>Código</th>
      <th>Cliente</td>
      <th>Fecha</th>
      <th>Tipo Pago</th>
      <th>Estado Venta</th>
      <th>Fecha Entrega</th>
      <th>Estado Entrega</th>
      <th>docsMeta</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    {{foreach ventas}}
    <tr>
      <td>{{idVenta}}</td>
      <td>{{nombre}} {{apellido}}</td>
      <td>{{fechaVenta}}</td>
      <td>{{tipoPago}}</td>
      <td>{{estadoVenta}}</td>
      <td>{{fechaEntrega}}</td>
      <td>{{estadoEntrega}}</td>
      <td>{{docsMeta}}</td>
      <td>
        <a href="index.php?page=mnt.ventasdetalles.ventasdetalles&mode=DSP&idVenta={{idVenta}}">Ver Detalle</a>
      </td>
    </tr>
    {{endfor ventas}}
  </tbody>
  </table>
</section>

