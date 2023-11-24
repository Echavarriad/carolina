@extends('errors::minimal')

@section('title', '404 - Página no encontrada')
@section('content')
<section class="error">
    <div class="error_cnt">
        <h1>¡ups!</h1>
        <h1>ERROR 404 </h1>
        <h3>LA PÁGINA QUE ESTÁ BUSCANDO NO EXISTE</h3>
        <a href="{{ url('/') }}" class="btn">Ir al inicio</a>
    </div>
</section>
@endsection

	<style>

        body{
            font-family: "Outfit",sans-serif;
        }
            .error {
            width: 100%;
            position: relative;
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .error_cnt {
            width: 80%;
            max-width: 1300px;
            position: relative;
            margin: 0 auto;
        }

        .error_cnt h1:first-of-type {
            color: #41BBCA;
            margin: 0 0 7px 0px;
        }
        .error_cnt h1:last-of-type {
            color: #FF0000;
            text-transform: uppercase;
            display: flex;
            align-items: center;
        }

        .error_cnt h3 {
            font-family: "Outfit",sans-serif;
            color: #474747;
            margin: 9px 0 36px 0;
        }

        .error_cnt a {
            font-family: "Outfit",sans-serif;
            padding: 10px 25px;
            font-size: 1.14286em;
            text-transform: uppercase;
            font-weight: 700;
            background: #41BBCA;
            color: #fff;
            text-transform: uppercase;
            transition: 0.5s ease-in-out;
            margin-top: 10px;
        }
	</style>
