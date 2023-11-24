@component('emails.layouts.master', array('content_emails' => $content_emails))
 		<table align="center" width="800" border="0" cellpadding="0" cellspacing="0"> 
			<tbody>
        <tr style="background-color:#ffffff">            
          <td style="padding:10px" align="left">               
            <p style="font-family:'Trebuchet MS',Arial,Helvetica,sans-serif;font-size:13px;color:#3d3d3d">
              <h3 style="font-size: 20px; font-weight: 700; color: #8c8c8c; margin: 14px 0;">Bienvenido(a) {{ $user->name . ' ' . $user->lastname }} a {{ config('settings.shop_name' )}}</h3>
            </p>            
          </td>      
        </tr> 
        <tr style="background-color:#ffffff">            
          <td style="padding:10px" align="left">
              {!! $content_emails[2]->text_1 !!}          
          </td>      
        </tr> 
      </tbody>
    </table>
@endcomponent