@php
    $message = '';
    if($errors->any()){
         foreach($errors->all() as $key => $error){
               $message .= '● ' .  $error .'\n';
         }
    }    
@endphp
@push('js')
@if (count($errors) > 0)        
  <script type="text/javascript">
     let id_form = '{{ $id_form }}';
     var errors = '{{ $message }}'
      Swal.fire({
         title: errors,
         icon: "error",
         confirmButtonText: "Cerrar",
         confirmButtonColor: '{{ config('settings.color_primary') }}'
     });
     var position = $("#"+id_form).offset().top - 150;
     $('html, body').animate( {scrollTop : position}, 1000 );
  </script>
@endif

@if ($send_form == 1)        
   <script type="text/javascript">
      let message_send = '{{ $message_send }}';
      Swal.fire({
         title: message_send,
         icon: "success",
         confirmButtonText: "Cerrar",
         confirmButtonColor: '{{ config('settings.color_primary') }}'
      })
   </script>
@elseif($send_form == -1)
   <script type="text/javascript">   
      let id_form = '{{ $id_form }}';
      Swal.fire({
         title:'{{ __('messages.invalid_recaptcha') }}',
         icon: "error",
         confirmButtonText: "Cerrar",
         confirmButtonColor: '{{ config('settings.color_primary') }}'
      })
      var position = $("#"+id_form).offset().top - 150;
      $('html, body').animate( {scrollTop : position}, 1000 );
   </script>
@endif

<script>
   let action = '{{ $action }}';
   grecaptcha.ready(function () {
      grecaptcha.execute('{{  config('settings.recaptcha_key_site') }}', {
         action : action
      }).then(function(token){
            if(token){
                  document.getElementById('recaptcha').value = token;
            }
      });      
   });

     //Every 90 Seconds
   setInterval(function () {
      grecaptcha.ready(function () {
         grecaptcha.execute('{{  config('settings.recaptcha_key_site') }}', {action: action}).then(function (token) {
            document.getElementById('recaptcha').value = token;
         });
      });
   }, 90 * 1000);
  </script>
@endpush