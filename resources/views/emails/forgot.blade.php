@component('emails.layouts.master')
  <h2 style=" color: #403333;font-size: 25px;letter-spacing: 0.3px;">Para restablecer tu contraseña de {{ config('settings.shop_name')}}, haz clic en el siguiente botón, este enlace tiene una vigencia de 4 horas.</h2>
    <hr>
    <br>
    <div style="width: 100%;position: relative;text-align: center;">
        <a style="font-size: 16px; font-weight: 700; padding: 9px 9px; width: 17%; background-color: {{ config('settings.color_primary') }};color: #fff; margin: 0 0 14px 0; border-radius: 5px; text-align: center; text-decoration: none;" href="{{$data['url']}}" target="_blank">Clic para cambiar la contraseña</a>
    </div>  
@endcomponent