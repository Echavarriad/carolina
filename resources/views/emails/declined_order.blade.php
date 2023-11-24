@component('emails.layouts.master', array('content_emails' => $content_emails))
     <table align="center" width="800" border="0" cellpadding="0" cellspacing="0"> 
			<tbody>
        <tr style="background-color:#ffffff">            
          <td style="padding:10px" align="left">
            @if($order->status_id == 5)
              {!! $content_emails[4]->text_3 !!}
            @elseif($order->status_id == 4)
              {!! $content_emails[4]->text_4 !!}
            @endif
            <hr>            
          </td>      
        </tr> 
      </tbody>
    </table> 

    {{-- @include('emails._partials.info') --}}

    @include('emails._partials.detail')

@endcomponent