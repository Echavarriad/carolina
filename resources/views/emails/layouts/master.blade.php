<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500" rel="stylesheet" type="text/css">
  </head>
  <body style="font-family: 'Work Sans', sans-serif;">     
    <div style="max-width: 1000px; margin-left: auto; margin-right: auto;">
      <table align="center" width="800" border="0" cellpadding="0" cellspacing="0">   
          <tbody>
            <tr>            
              <td align="center">
                <img src="{{ asset('uploads/'.config('settings.shop_logo_email')) }}" width="200px" tabindex="0">
              </td>         
            </tr>         
            <tr>            
              <td colspan="3" style="background-color:{{ config('settings.color_primary') }};height:6px"> 
              </td>         
            </tr>      
          </tbody>
      </table><br>

      {{ $slot }}
      
      <br><br> 
      <table align="center" height="" width="1000" border="0" cellpadding="0" cellspacing="0">         
        <tbody>
          <tr style="background-color:#ffffff">            
            <td colspan="3" style="padding:10px" align="center">
              @if(isset($content_emails[0]->text_1))               
                {!! $content_emails[0]->text_1 !!}   
              @endif   
            </td>         
          </tr>      
        </tbody>
      </table>
      <table align="center"  width="600" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>            
          <td colspan="3"><img src="{{ asset('img/sombra-footer.jpg') }}" height="26" width="600" class="CToWUd"></td>         
        </tr>      
        </tbody>
      </table>
      <table align="center" height="" width="600" border="0" cellpadding="0" cellspacing="0">         
        <tbody>
          <tr style="font-family:'Work Sans',Arial,Helvetica,sans-serif;font-size:13px;color:#3d3d3d">            
            <td style="padding:15px" align="right" height="115" width="287">
              @if(isset($content_emails[0]->text_2))               
                {!! $content_emails[0]->text_2 !!}   
              @endif  
              
            </td>            
            <td style="font-size:12px;padding-left:10px;border-left:#999;border-bottom-width:thin;border-left-style:dotted;text-decoration:none" height="115" width="222">               
              @if(isset($content_emails[0]->text_3))               
                {!! $content_emails[0]->text_3 !!}   
              @endif             
            </td>            
            <td height="49" width="67">
              <img src="{{ asset('uploads/'.config('settings.shop_logo_email')) }}" width="100" style="display:block">
            </td>         
          </tr>      
        </tbody>
      </table>
    </div>
  </body>
</html>