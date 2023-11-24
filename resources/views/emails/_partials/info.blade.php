<table align="center" width="800" cellspacing="0" cellpadding="0"  border="0">
	<tbody>
		<tr>
			<td valign="top" width="50%">
				<h3 style="color:#557da1;display:block;font-size:16px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left">Datos del cliente</h3>
				<p style="color:#505050;margin:0 0 5px"><strong>Nombre: </strong>{{ $order->customer_name . ' ' . $order->customer_lastname }}</p>
				<p style="color:#505050;margin:0 0 5px"><strong>{{ $order->customer_type_document }}: </strong>{{ $order->customer_document }}</p>
				<p style="color:#505050;margin:0 0 5px"><strong>Teléfono: </strong>{{ $order->customer_mobile }}</p>
				<p style="color:#505050;margin:0 0 5px"><strong>Correo: </strong>{{ $order->customer_email }}</p>
			</td>
			<td valign="top" width="50%" style="font-size:12px;padding-left:10px;border-left:#9999996e;border-bottom-width:thin;border-left-style:solid;text-decoration:none; border-width: 2px;">
				<h3 style="color:#557da1;display:block;font-size:16px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left">Dirección de envío</h3>
				<p style="color:#505050;margin:0 0 5px"><strong></strong>{{ $order->address->address }}</p>
				@if(!empty($order->address->complement))
					<p style="color:#505050;margin:0 0 5px">{{ $order->address->complement }}</p>
				@endif
				<p style="color:#505050;margin:0 0 5px"><strong>{{ $order->address->city . ' - ' . $order->address->state  }}</strong></p>
			</td>			
		</tr>
	</tbody>
</table><br>