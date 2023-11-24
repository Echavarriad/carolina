<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="base-url" content="{{ url('/') }}" />
    <meta name="main-color" content="{{ config('settings.color_primary') }}" />
    <title>{{ isset($meta_title) ? $meta_title : config('settings.shop_name') }}</title>
    <meta name="description" content="{{ isset($meta_description) ? $meta_description : '' }}">
    <meta name="keywords" content="{{ isset($meta_keywords) ? $meta_keywords : '' }}">
       <!-- favicon
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="icon" type="image/png" href="{{asset('uploads/'.config('settings.shop_favicon')) }}" />
    <meta name="apple-mobile-web-app-title" content="{{ config('settings.shop_name') }}">
    <meta name="application-name" content="{{ config('settings.shop_name') }}">
    <meta name="msapplication-TileColor" content="{{ config('settings.color_primary') }}">
    <meta name="theme-color" content="{{ config('settings.color_primary') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="base-url" content="{{ url('/') }}" />

    @yield('metas')
    <style type="text/css">
       [v-cloak] {
          display: none;
      } 

    </style>
    <link rel="preconnect" href="//fonts.googleapis.com">
    <link rel="preconnect" href="//fonts.gstatic.com" crossorigin>
    <link href="//fonts.googleapis.com/css2?family=Asap:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Caveat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.css" integrity="sha512-N2IsWuKsBYYiHNYdaEuK4eaRJ0onfUG+cdZilndYaMEhUGQq/McsFU75q3N+jbJUNXm6O+K52DRrK+bSpBGj0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" /> 

    @php
      $name= request()->route()->getName();
      $css= $name == 'article' ? 'articles' : (in_array($name, ['login', 'account.register', 'account.forgot', 'account.change_password', 'account.home' , 'account.address']) ? 'account' :  (in_array($name, ['products.cat', 'products.subcat', 'product.cat', 'product.subcat', 'products.favorites']) ? 'products' : (in_array($name, ['shop.cart', 'shop.checkout', 'shop.payment', 'shop.return']) ? 'cart' : $name)));
    @endphp  
    <link type="text/css" rel="stylesheet" href="{{ asset('css/layouts.min.css?v='. config('settings.version_cache') . ')') }}" />    
    <link type="text/css" rel="stylesheet" href="{{ asset('css/my_styles.css?v=' . config('settings.version_cache')) }}" />   
    <link type="text/css" rel="stylesheet" href="{{ asset('css/'. $css . '.min.css?v='. config('settings.version_cache') . ')') }}" /> 
    <link type="text/css" rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}" />  

    @stack('css')
    
    @if(!empty(config('settings.recaptcha_key_site')) && !empty(config('settings.recaptcha_key_secret')) )
      <script src="//www.google.com/recaptcha/api.js?render={{ config('settings.recaptcha_key_site') }}"></script>
    @endif
    @include('_partials.analytics')
  </head>