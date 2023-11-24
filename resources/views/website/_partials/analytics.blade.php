@if(config('settings.code_analytics'))  
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id={{ config('settings.code_analytics') }}"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', '{{ config('settings.code_analytics') }}');
	</script>
@endif