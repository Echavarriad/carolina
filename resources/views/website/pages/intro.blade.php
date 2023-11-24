<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/layouts.min.css?v=1.0') }}">
    <!-- Home's stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/intro.min.css?v=1.0') }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/png">

    <title>Dulcy</title>
</head>

<div>
    <div class="logo_dulcy_container">
        <img class="logo_dulcy_img" src="{{ asset('img/logo_web_dulcy.png') }}" alt="">
    </div>
    <div class="banner_home">
        <div class="text_container">
            <div class="text_container_2">
                <p class="text_small">Bienvenido a Dulcy,</p>
                <h1>Tienda de ropa <br>Colombiana</h1>
            </div>
        </div>
    </div>
</div>
<div class="container_form_2">
    <form class="container_text_icon" action="{{ route('validation') }}" method="POST">
        {{ csrf_field() }}
        <input class="container_text_icon_input" type="text" name="document" id="document"
            placeholder="numero de cedula" required>
        <img class="container_img_icon" src="{{ asset('img/icomo_write.png') }}" alt="">

        <label class="checkbox_t">
            <input type="checkbox" id="terms" name="terms" value="first_checkbox" required /> He leído y acepto
            las
            condiciones de
            tratamiento de datos // clic aquí</label><br />

        <div class="container_btn">
            <button type="submit" class="btn_form">Ingresar</button>
        </div>
    </form>
</div>

<body>
    <main>

        <body>
            <main>
            </main>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
                integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
                crossorigin="anonymous"></script>
            <script src="./assets/js/main.js"></script>
        </body>
    </main>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <script src="./assets/js/main.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        /*
               function validation(){
                    let documento = document.getElementById('document').value;
                    let terms = document.getElementById('terms').value;
                    axios.post('ajax/validacion',{documento: documento, terms: terms}).then((response) =>{
                        console.log(response.data);
                    }).catch((error) =>{
                        console.log(error);
                    });
                   /* console.log(terms);
                    $.post({
                        type: 'POST',
                        url: 'ajax/validacion',
                        data: {documento: documento, terms: terms},
                        Datatype: 'json',
                        success : function(json) {
                            console.log('hecho')
                        },
                        error: function(json){
                            console.log('error')
                        },
                    })*/
        /*}*/
    </script>
</body>

<footer class="container_footer">
    <div class="container_footer_content">
        <div class="container_col_1">
            <img class="img_maps" src="{{ asset('img/google_maps.png') }}" alt="">
            <div>
                <p class="footer_text">Creaciones Dulcy © 2023 all rights reserved.</p>
            </div>
        </div>

        <div class="img_webcreativa_">
            <img class="img_webcreativa" src="{{ asset('img/logo_web_creativa.png') }}" alt="">
        </div>
    </div>
</footer>

</html>
