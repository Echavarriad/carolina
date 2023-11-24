<table align="center" width="800" style="border-collapse: collapse;border: 1px solid #8c8c8c;">
 	<thead style="background: #8c8c8cb8;">
 		<tr style="color: #000;height: 33px;font-size: 17px;">
 			<td style="width:10%;"></td>
 			<td style="width:10%;">Ref.</td>
 			<td style="width:35%;">Producto</td>
 			<td style="width:10%;">Cant.</td>
 			<td style="width:15%;">Precio</td>
 			<td style="width:15%;text-align: right;padding-right: 10px;">Total</td>
 		</tr>
 	</thead>
	<tbody>
		 @foreach ($order->items as $item)
        <tr>
            <td style="padding:10px 5px;"><img src="{{ asset('uploads/' . $item->image) }}" width="80"></td>
            <td>{{ $item->sku }} </td>
            <td>
				{{ $item->name }}
			</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->price_format }}</td>
            <td style="text-align: right;padding-right: 10px;">{{ $item->total_format }}</td>
        </tr>
    @endforeach
 		<tr><td colspan="6" style="background: #acacac"></td></tr>
		<tr style="padding: 5px 0;">
			<td colspan="5" style="text-align: right;padding: 8px 10px 8px 0;"><strong>{{ __('titles.subtotal') }}</strong></td>
			<td style="text-align: right;padding: 8px 10px 8px 0;">{{ $order->subtotal_format }}</td>
		</tr>
		@if($order->discount_amount > 0)
			<tr style="padding: 5px 0;">
				<td colspan="5" style="text-align: right;padding: 8px 10px 8px 0;"><strong>{{ __('titles.discount') }}</strong></td>
				<td style="text-align: right;padding: 8px 10px 8px 0;">-{{ $order->discount_format }}</td>
			</tr>
		@endif
		<tr style="padding: 5px 0;">
			<td colspan="5" style="text-align: right;padding: 8px 10px 8px 0;"><strong>{{ __('titles.shipping') }}</strong></td>
			<td style="text-align: right;padding: 8px 10px 8px 0;">
				{{ $order->shipping_free ? 'Gratis' : $order->shipping_format }}
			</td>
		</tr>
 		<tr style="padding: 5px 0;">
 			<td colspan="5" style="text-align: right;padding: 8px 10px 8px 0;text-transform: uppercase;"><strong>{{ __('titles.total') }}</strong></td>
 			<td style="text-align: right;padding: 8px 10px 8px 0;">{{ $order->total_format  }}</td>
 		</tr>
 	</tbody>
</table>