@component('emails.layouts.master', array('content_emails' => $content_emails))
<h2 style=" color: #403333;font-size: 25px;letter-spacing: 0.3px;">{{ isset($data['service']) ? 'Servicios' : 'Contacto' }}</h2>
<hr>
<table class="tabla">
    <thead>
    @if(!empty($data['name']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;display: flex; align-items: center;">
            <div style="width: 200px;">{{ __('forms.name') }}:</div> <strong style="color: #8a8585;font-size: 26px;">{{ $data['name'] }}</strong></h3> </th>
      </tr>
    @endif  
    @if(!empty($data['email']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;display: flex; align-items: center;">
            <div style="width: 200px;">{{ __('forms.email') }}:</div> <strong style="color: #8a8585;font-size: 26px;">{{ $data['email'] }}</strong></h3> </th>
      </tr>
    @endif  
    @if(!empty($data['phone']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;display: flex; align-items: center;">
            <div style="width: 200px;">{{ __('forms.phone') }}:</div> <strong style="color: #8a8585;font-size: 26px;">{{ $data['phone'] }}</strong></h3> </th>
      </tr>
    @endif
    @if(!empty($data['service']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;display: flex; align-items: center;">
            <div style="width: 200px;">Servicio de interés:</div> <strong style="color: #8a8585;font-size: 26px;">{{ $data['service'] }}</strong></h3> </th>
      </tr>
    @endif
    @if(!empty($data['city']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;display: flex; align-items: center;">
            <div style="width: 200px;">{{ __('forms.city') }}:</div> <strong style="color: #8a8585;font-size: 26px;">{{ $data['city'] }}</strong></h3> </th>
      </tr>
    @endif
    @if(!empty($data['address']))
         <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;display: flex; align-items: center;">
            <div style="width: 200px;">{{ __('forms.address') }}:</div> <strong style="color: #8a8585;font-size: 26px;">{{ $data['address'] }}</strong></h3> </th>
      </tr>
    @endif
    @if(!empty($data['subject']))
         <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;display: flex; align-items: center;">
            <div style="width: 200px;">{{ __('forms.subject') }}:</div> <strong style="color: #8a8585;font-size: 26px;">{{ $data['subject'] }}</strong></h3> </th>
      </tr>
    @endif
    @if(!empty($data['message']))
         <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;display: flex; align-items: center;">
            <div style="width: 200px;">{{ __('forms.message') }}:</div> <strong style="color: #8a8585;font-size: 26px;">{{ $data['message'] }}</strong></h3> </th>
      </tr>
    @endif
    </thead>
</table><hr>
    He leído y acepto las condiciones de tratamiento de datos.
    <br><br>
@endcomponent