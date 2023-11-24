@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('content')
<section class="error">
    <div class="error_cnt">
        <h1>¡ups!</h1>
        <h1>ERROR 403 </h1>
        <h3>No tiene permisos para acceder a esta URL</h3>
    </div>
</section>
@endsection

	<style>
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
    color: #f58f35;
    margin: 0 0 7px 0px;
}
.error_cnt h1:last-of-type {
    color: #FF0000;
    text-transform: uppercase;
    display: flex;
    align-items: center;
}

.error_cnt h3 {
    font-family: "Poppins",sans-serif;
    color: #474747;
    margin: 9px 0 36px 0;
}

.error_cnt a {
    font-family: "Poppins",sans-serif;
    padding: 10px 25px;
    font-size: 1.14286em;
    text-transform: uppercase;
    font-weight: 700;
    background: #f58f35;
    color: #fff;
    text-transform: uppercase;
    transition: 0.5s ease-in-out;
    margin-top: 10px;
}
	</style>
