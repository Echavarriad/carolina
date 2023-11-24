@component('emails.layouts.master', array('content_emails' => $content_emails))
<h2 style=" color: #403333;font-size: 25px;letter-spacing: 0.3px;">Hoja de vida recibida</h2>
  <hr>
  <table class="tabla">
    <thead>
      @if(!empty($data['name_offer']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;display: flex; align-items: center;">
            <div style="width: 200px;">Oferta a la que aplica:</div> <strong style="color: #8a8585;font-size: 26px;">{{ $data['name_offer'] }}</strong></h3> </th>
      </tr>
      @endif  
    </thead>
  </table>   

@endcomponent