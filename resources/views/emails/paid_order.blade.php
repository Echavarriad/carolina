@component('emails.layouts.master', array('content_emails' => $content_emails))
     <table align="center" width="800" border="0" cellpadding="0" cellspacing="0"> 
			<tbody>
        <tr style="background-color:#ffffff">            
          <td style="padding:10px" align="left">
            @if($template == 'customer')               
              {!! $content_emails[4]->text_1 !!} 
            @elseif($template == 'shop')
              {!! $content_emails[4]->text_2 !!}      
            @endif
            <hr>          
          </td>      
        </tr> 
        <tr style="background-color:#ffffff">            
          <td style="padding:10px" align="left"> 
            <h2 style="width: 100%;text-align: left;color: #1D2326; font-size:18px;">{{ __('titles.nro_reference') }} <span style="color: {{ config('settings.color_primary') }};font-weight: 800;">{{ $order->reference }}</span></h2>          
          </td>      
        </tr> 
      </tbody>
    </table> 

    @include('emails._partials.info')
    @if (!empty($order->payment))
    <hr>
    <table align="center" width="800" cellspacing="0" cellpadding="0"  border="0">
        <tbody>
            <tr>                
                <td valign="top" width="100%">
                    <h3 style="color:#557da1;display:block;font-size:16px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left">Información del pago</h3>
                    @foreach ($order->payment->params as $key => $value)
                        <p style="color:#505050;margin:0 0 5px"><strong>{{ $key }}: </strong>{{ $key == 'amount' ? core()->currency($value, 2) : $value }}</p>
                    @endforeach
                </td>	
            </tr>
        </tbody>
    </table><br>
    @endif

    @include('emails._partials.detail')

@endcomponent