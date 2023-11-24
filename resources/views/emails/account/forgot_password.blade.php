@component('emails.layouts.master', array('content_emails' => $content_emails))
		<table align="center" width="800" border="0" cellpadding="0" cellspacing="0"> 
			<tbody>
        <tr style="background-color:#ffffff">            
          <td style="padding:10px" align="left">               
            <p style="font-family:'Poppins', sans-serif;font-size:13px;color:#3d3d3d">
              {!! $content_emails[1]->text_1 !!}
            </p>              
          </td>      
        </tr> 
        <tr style="background-color:#ffffff">            
          <td style="padding:10px" align="left">               
            <h3 style="font-size: 20px; font-weight: 700; color: {{ config('settings.color_primary') }}; margin: -20px 0;text-align: center;">{{ __('titles.temporary_key') }}</h3>
            <p style="text-align: center;font-size: 25px;font-weight: 600; color: #5e5f6b;">{{ $passwordTemporary }}</p>
          </td>      
        </tr> 
      </tbody>
    </table>
    <div style="width: 100%;position: relative;text-align: center;">
    	<a style="font-size: 16px; font-weight: 700; padding: 9px 9px; width: 17%; background-color: {{ config('settings.color_primary') }};color: #fff; margin: 0 0 14px 0; border-radius: 5px; text-align: center; text-decoration: none;" href="{{ route('home') }}" target="_blank">{{ __('links.go_store') }}</a>
    </div>
@endcomponent