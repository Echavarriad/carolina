<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="icon" type="image/png" href="{{asset('uploads/'.config('settings.shop_favicon')) }}" />  
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="message" style="padding: 10px;">
                @yield('content')
            </div>
        </div>
    </body>
</html>
