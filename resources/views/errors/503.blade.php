@extends('errors::minimal')

@section('title', 'Sitio en Mantenimiento')
@section('content')
<section class="content_503">
    <div class="content_503_cnt">
        <img src="{{ asset('img/maintenance.png') }}" alt="">
        <div class="error_txt">
            <h2>En mantenimiento.</h2>
            <p></p>
        </div>
    </div>
</section>
@endsection

	<style>

    .content_503_cnt img{
        position: absolute;
        left: 0;
        top: 34px;
        margin: auto;
    }

    .error_txt {
        width: 60%;
        position: absolute;
        top: 250px;
        left: 20%;
        right: 0;
        margin: auto;
    }

	.error_txt  h2{
        text-align: center;
        color: #000000;
        font-size: 70px;
    }

    .error_txt  p{
        text-align: center;
        color: #000000;
        font-size: 15px;
    }

    @media (max-width: 3000px) {

}

@media (max-width: 1441px) {

}

@media (max-width: 1210px) {
}

@media (max-width: 1100px) {
}
@media (max-width: 1024px) {


}
@media (max-width: 768px) {
}
@media (max-width: 576px) {
}

@media (max-width: 425px) {

    .content_503_cnt img {
        top: 75px;
    }
    .error_txt {
        width: 100%;
        top: 60%;
    }

    .error_txt h2 {
    font-size: 70px;
    width: 500px;
}

}

@media (max-width: 375px) {    
  
}

@media (max-width: 320px) {

  
}
</style>
