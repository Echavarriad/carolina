@component('emails.layouts.master', array('content_emails' => $content_emails))
     <table align="center" width="800" border="0" cellpadding="0" cellspacing="0"> 
			<tbody>
        <tr style="background-color:#ffffff">            
          <td style="padding:10px" align="left">
            {!! $content_emails[5]->text_1 !!} 
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
    <table align="center" width="800" cellspacing="0" cellpadding="0"  border="0">
        <tbody>
            <tr>                
                <td valign="top" width="100%">
                  <h3 style="color:#557da1;display:block;font-size:16px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left">Información de envío</h3>
                  <p style="color:#505050;margin:0 0 5px"><strong></strong>{{ $order->address->address }}</p>
                  @if(!empty($order->address->complement))
                    <p style="color:#505050;margin:0 0 5px">{{ $order->address->complement }}</p>
                  @endif
                  <p style="color:#505050;margin:0 0 5px"><strong>{{ $order->address->city . ' - ' . $order->address->state  }}</strong></p>
                  @if(!empty($order->guide_number))
                    <p style="color:#505050;margin:0 0 5px"><strong>Número de gúia: </strong>{{ $order->guide_number }}</p>
                  @endif
                  @if(!empty($order->url_guide))
                    <p style="color:#505050;margin:0 0 5px"><strong>URL de rastreo: </strong><a href="{{ $order->url_guide }}" target="_blank">CLICK AQUÍ</a></p>
                  @endif
                </td>	
            </tr>
        </tbody>
    </table><br>

    

    @include('emails._partials.detail')

@endcomponent