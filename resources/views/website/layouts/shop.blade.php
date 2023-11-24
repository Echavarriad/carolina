<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    @include('layouts._partials.head')
    <body>     
        <div class="loader_shop"><div class="spinner"></div></div>
        <section id="vue" class="container-main"> 
            @if (request()->route()->getName() != 'shop.checkout' && request()->route()->getName() != 'shop.payment')
                @include('_partials.header')
            @endif            
            @yield('content')
            @if (request()->route()->getName() != 'shop.checkout' && request()->route()->getName() != 'shop.payment')
                @include('_partials.footer')
            @endif 
        </section>
        @include('layouts._partials.scripts')
    </body>

</html>

