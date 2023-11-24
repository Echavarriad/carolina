@component('emails.layouts.master', array('content_emails' => $content_emails))
     <table align="center" width="800" border="0" cellpadding="0" cellspacing="0"> 
			<tbody>
        <tr style="background-color:#ffffff">            
          <td style="padding:10px" align="left">
            @if($template == 'customer')               
              {!! $content_emails[3]->text_1 !!} 
            @elseif($template == 'shop')
              {!! $content_emails[3]->text_2 !!}      
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

    @include('emails._partials.detail')

@endcomponent