<!DOCTYPE html>

<html lang="{{ config('app.locale') }}">
  @include('layouts._partials.head')
  <body>    
    <div class="loader"><div class="spinner"></div></div>
    <section id="vue" class="container-main"> 
        @include('_partials.header')
        @yield('content')
        @include('_partials.footer')
    </section>
    
    @include('layouts._partials.scripts')
  </body>

</html>

