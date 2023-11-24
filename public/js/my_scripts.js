(function () {
     "use strict";

     var WEBSITE = WEBSITE || {};
     WEBSITE.var = {};
     WEBSITE.var.window = jQuery(window);

     var $j = jQuery.noConflict();

     WEBSITE.page = {
          init: function () {
               if (window.history.replaceState) { // verificamos disponibilidad
                    window.history.replaceState(null, null, window.location.href);
               }
               let colorBtn = document.head.querySelector('meta[name="main-color"]').content;
               $j('.form-load').submit(function (event){
                    $j('.loader').fadeIn();
                    $j('.spinner').fadeIn();
               });

               $j('#btnSendContact').on('click', function(e) {
                    executeSendFormContact('#formContact');
                    
               }); 

               $j('#formContact input[type="text"]').on('keyup', function(e) {
                    if(event.which === 13){
                         executeSendFormContact('#formContact');       
                    }                    
               }); 

               function executeSendFormContact(form){
                    if(validateInput($j('#name')) & validateInput($j('#email')) & validateEmail($j('#email')) & validateInput($j('#phone')) & validateInput($j('#message'))){  
                         if(!validateCheck($j('#contact_check'))){
                              Swal.fire({
                                   html: '<h6>' + selected_check + '</h6>',
                                   icon: "error",
                                   confirmButtonText: "Cerrar",
                                   confirmButtonColor: colorBtn
                              })
                              return false;
                         }
                         $j(form).submit();
                    }
               }

               $j('#sendFormCase').on('click', function(e) {
                    let tab = $j('#tab_selected').val();
                    if(validateInput($j('#name')) & validateInput($j('#email')) & validateEmail($j('#email')) & validateInput($j('#mobile')) & validateInput($j('#company')) & validateInput($j('#country')) & validateInput($j('#city')) & validateByTab(tab)){  
                         if(!validateCheck($j('#form_check'))){
                              Swal.fire({
                                   html: '<h6>' + selected_check + '</h6>',
                                   icon: "error",
                                   confirmButtonText: "Cerrar",
                                   confirmButtonColor: colorBtn
                              })
                              return false;
                         }
                         $j('#formCase').submit();
                    }
                    
               }); 

               function validateByTab(tab){
                    let valid= false;
                    switch (tab) {
                         case 'tab1':
                              valid= validateTab1();
                              break;
                         case 'tab2':
                              valid= validateTab2();
                              break;
                         default:
                              valid= validateTab3Tab4();
                              break;
                    }

                    return valid;
               }

               function validateTab1(){
                    if(validateInput($j('#brand')) & validateInput($j('#model')) & validateInput($j('#symptoms')) & validateInput($j('#attempts')) & validateRadio('opened') & validateRadio('struck') &validateInput($j('#capacity_device')) & validateInput($j('#comments'))){
                         return true;
                    }

                    return false;
               }

               function validateTab2(){
                    if(validateInput($j('#number_disks')) & validateInput($j('#symptoms')) & validateInput($j('#attempts')) & validateRadio('type_raid') & validateRadio('struck') &validateInput($j('#capacity_device')) & validateInput($j('#comments'))){
                         return true;
                    }

                    return false;
               }

               function validateTab3Tab4(){
                    if(validateInput($j('#symptoms')) & validateInput($j('#attempts')) & validateRadio('struck') &validateInput($j('#capacity_device')) & validateInput($j('#comments'))){
                         return true;
                    }

                    return false;
               }

               function validateRadio(name){
                    let valid = true;
                    if($j("[name='" + name + "']:checked").val() == undefined){
                         $j('#'+name).addClass('error-radio')
                         valid = false;
                    }else{
                         $j('#'+name).removeClass('error-radio');
                    }
                    
                    return valid;
               }

               function validateInput(object, parent= false){
                    let valid = true;
                    if(object.val() == '' || object.val() == null){
                         valid = false;
                         object.removeClass('_valid');
                         object.addClass('not-valid');
                    }else{
                         object.removeClass('not-valid');
                         object.addClass('_valid');              
                    }
                    return valid;
               } 

               function validateCheck(object){
                    let valid = true;
                    if (!object.is(':checked')){
                         valid = false;
                         $j('#check_policy').removeClass('is-valid1');
                         $j('#check_policy').addClass('not-valid')
                    }else{
                         $j('#check_policy').removeClass('not-valid');
                         $j('#check_policy').addClass('is-valid1');
                    }

                    return valid;
               }
               
               function validateEmail(object, parent= false){
                    let valid = true;
                    if(!isValidEmail(object.val())){
                         valid = false;
                         if(parent){
                              object.parent().removeClass('__grow');
                              object.parent().removeClass('error');
                              object.parent().addClass('__grow');
                              object.parent().addClass('error');
                         }else{
                              object.removeClass('_valid');
                              object.addClass('not-valid');
                         }
                    }else{
                         if(parent){
                              object.parent().removeClass('__grow');
                              object.parent().addClass('__grow');
                         }else{
                              
                         } 
                    }
                         return valid;
               }

               $j('#email_newsletter').keyup(function(event) {
                    if(event.which === 13){
                         event.preventDefault();
                      sendNewsletter();       
                     }
               });
          
                 $j('#sendNewsletter').click(function(event) {
                    event.preventDefault();
                    sendNewsletter();  
               })
          
               function sendNewsletter(){
                    var email = $j('#email_newsletter').val();
                    var _recaptcha = $j('#recaptcha_newsletter').val();
                    let message = '';
                    if(email == ''){
                         message += '● ' + required_email;
                    }else if(!isValidEmail(email)){
                         message += '● ' + email_invalid;
                    }
                    if(!validateCheck($j('#newsletter_check'))){
                         message = selected_check;
                    }
                    if(message != ''){
                         Swal.fire({
                              allowOutsideClick: false,
                              title: message,
                              icon: "error",
                              confirmButtonText: "Cerrar",
                              confirmButtonColor: colorBtn
          
                         });
                         return false;
                    }
                    $j.ajax({
                         url : baseRoot +'/ajax/send-newsletter',
                         type : 'GET',
                         dataType : 'json',
                         data : {email : email, _recaptcha : _recaptcha},
                         beforeSend: function () {
                              $j('.loader').fadeIn();
                         },
                         success : function(response){
                              $j('#email_newsletter').val('');
                              $j('.loader').fadeOut();
                              let title ='';
                              let icon ='error';
                              if (response.status == 1) {
                                   title = title_envio_newsletter;
                                   icon = 'success';
                              }else if(response.status == -1){
                                   title = title_registered_mail;
                              }else if(response.status == -2){
                                   title = title_invalid_recaptcha;
                              }else if(response.status == -3){
                                   title = email_invalid;
                              }else{
                                   title = title_error;                        
                              }
                              Swal.fire({
                                   allowOutsideClick: false,
                                   title: title,
                                   icon: icon,
                                   confirmButtonText: "Cerrar",
                                   confirmButtonColor: colorBtn
          
                              });
                         }    
                    });
               } 

               function isValidEmail(mail){
                    return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail);
               }
          }
     };

     WEBSITE.onReady = {
          init: function () {
               WEBSITE.page.init();
          }
     };

     $j(function () {
          WEBSITE.onReady.init();
     });

})();