<h1>Historico de Ventas</h1>
<hr>
<table>
  <thead>
    <tr>
      <td>Código</td>
      <td>Cliente</td>
      <td>Fecha</td>
      <td>Tipo Pago</td>
      <td>Estado Venta</td>
      <td>Fecha Entrega</td>
      <td>Estado Entrega</td>
      <td>docsMeta</td>
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
