@component('emails.layouts.master', array('content_emails' => $content_emails))
<h2 style=" color: #403333;font-size: 25px;letter-spacing: 0.3px;">Mensaje de suscripción al boletín</h2>
  <hr>
  <table class="tabla">
    <thead>
      @if(!empty($data['email']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;display: flex; align-items: center;">
            <div style="width: 200px;">{{ __('forms.email') }}:</div> <strong style="color: #8a8585;font-size: 26px;">{{ $data['email'] }}</strong></h3> </th>
      </tr>
      @endif  
    </thead>
  </table>   

@endcomponent