<h1>Historico de Ventas</h1>
<hr>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>Código</th>
        <th>Cliente</th>
        <th>Fecha</th>
        <th>Tipo Pago</th>
        <th>Estado Venta</th>
        <th>Fecha Entrega</th>
        <th>Estado Entrega</th>
        <th>docsMeta</th>
      </tr>
    </thead>
    <tbody>
      {{foreach ventas}}
      <tr>
        <td>{{idVenta}}</td>
        <td>{{clienteId}}</td>
        <td>{{fechaVenta}}</td>
        <td>{{tipoPago}}</td>
        <td>{{estadoVenta}}</td>
        <td>{{fechaEntrega}}</td>
        <td>{{estadoEntrega}}</td>
        <td>{{docsMeta}}</td>
      </tr>
      {{endfor ventas}}
    </tbody>
  </table>
</section>
