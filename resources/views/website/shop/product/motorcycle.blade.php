@extends('layouts.master')
@section('metas')



<meta property="og:site_name" content="{{config('settings.shop_name')}}">

<meta property="og:url" content="{{ route('motorcycle' , [$category->slug, $product->slug]) }}">

<meta property="og:type" content="website">

<meta property="og:title" content="{{ $product->name }}">

<meta property="og:description" content="{{ $product->detail }}">

<meta property="og:image" content="{{ asset('uploads/'.$product->image) }}">

@stop



@section('content')

    @include('_partials.banner')



    <!-- BLOQUE MGS -->

    <div class="w_migs">

      @include('_partials.breadcrumb')



      <a href="{{ route('motorcycles', $category->slug) }}" class="bl_back">

        <span>{{ __('links.back_motorcycles') }}</span>

      </a>



      @include('_partials.scrolling')

    </div>



    <!-- AMP ACC -->



    <div class="w_acca w_motosam">

      <div class="bq_acca">

        <div class="acca_sld">

          <div class="swiper swiper-container swiper-motos">

            <div class="swiper-wrapper">
              @php $index = 0;@endphp
              @foreach ($product->images as $gallery)
              @php  $index++;  @endphp
                <div class="swiper-slide">
                  <div class="mot_sld_int">
                      <img src="{{ asset('uploads/' . $gallery->image) }}">
                  </div>
                </div>  
              @endforeach
              @foreach ($product->colors as $item)
                @if(!empty($item->image))
                      @php 
                          $item->index = $index;
                          $index++;  
                      @endphp
                      <div class="swiper-slide">
                          <div class="mot_sld_int">
                          <img src="{{ asset('uploads/' . $item->image) }}">
                          </div>
                      </div>
                @endif                      
              @endforeach      

            </div>

            <!-- Add Scrollbar -->

            <div class="swiper-scrollbar"></div>

            <div class="swiper-button-next_m swiper-button-next"></div>

            <div class="swiper-button-prev_m swiper-button-prev"></div>

          </div>

          <!-- Add Pagination -->

          <div class="swiper-pagination swiper-pagination_motos"></div>

          <div class="mot_marcc">

            @foreach ($features as $item)

             <img src="{{ asset('uploads/' . $item->image) }}">

            @endforeach

          </div>

        </div>

        <div class="acca_txt">

          <div class="acca_tit">

            <h2>{{ $product->name }}</h2>

            <h3>{{ $product->subtitle }}</h3>

          </div>

          <div class="acca_prc">

            @if ($product->special_price != 0.00)

              <h5><del>{{ $product->showPrice() }}</del></h5>

              <strong>{{ $product->showPriceSpecial() }}</strong>

            @else

            <strong>{{ $product->showPrice() }}</strong>

            @endif            

            <small>IVA INCLUIDO /</small>

          </div>
          @if(!empty($product->btn_buy) && !empty($product->btn_pay))
              <div class="buttons-wompi">
                  @if(!empty($product->btn_buy))
                      <button class="btn-wompi" data-url="{{ $product->btn_buy }}">Comprar</button>
                       {{-- <button onclick="window.open('{{ $product->btn_buy }}')">Comprar</button> --}}
                  @endif
                  @if(!empty($product->btn_pay))
                      <button class="btn-wompi" data-url="{{ $product->btn_pay }}">Abonar</button>
                       {{-- <button onclick="window.open('{{$product->btn_pay}}')">Abonar</button> --}}
                  @endif
              </div>
          @endif
          <div class="mtsm_list">
              {!! $product->detail !!}
              @if ($product->colors()->count() > 0)
                <ul class="colors">
                  <li>
                    <h3>{{ __('titles.colors') }}</h3>
                    @foreach ($product->colors as $key => $item)
                    @if (!empty($item->image))
                        <span class="select-color" data-index="{{ $item->index }}" style="background-color: {{ $item->color->color }};" title="{{ $item->color->name }}"></span>
                    @endif
                    @endforeach
                  </li>
                </ul>
              @endif
          </div>
          <div class="acca_btns">
               @if($sections_actived[6]->is_show)
                    <div class="add_c" onclick="window.location.href=('{{ route('financing', ['moto' => $product->slug]) }}')">{{ __('links.quote_your_motorcycle') }}</div>
               @endif
            <div class="add_c btn_action_wtspp" data-option="1">{{ __('links.request_an_advisor') }}</div>
            <a href="Javascript:void(0);" class="see_legal">Ver información legal</a>
          </div>

        </div>

      </div>

    </div>
    @if (count($productRelateds) > 0)
          <div class="wp_product relateds-motorcycle">
               @foreach ($productRelateds as $item)
                    @php
                         $slug_type = $item->product->type == 0 ? 'accesorios' : 'repuestos';
                    @endphp
                    <div class="box_productw">
                    <div class="box_product cursor" onclick="window.location.href=('{{ route('product.view', [$slug_type, $item->product->category->slug, $item->product->slug]) }}')">
                         <div class="box_product_tit">
                         <h2>{{ $item->product->name }}</h2>
                         </div>
                         <div class="box_product_img">
                         <img src="{{ asset('uploads/' . $item->product->image) }}" alt="{{ $item->product->alt }}" title="{{ $item->product->tit }}">
                         </div>
                         <div class="box_product_pre">
                         @if ($item->product->special_price != 0.00)
                              <strong>{{ $item->product->showPriceSpecial() }}</strong>
                         @else
                              <strong>{{ $item->product->showPrice() }}</strong>
                         @endif
                         <span>{{ !empty($item->product->reference) ? 'Modelo' : ''}} {{ $item->product->reference }} IVA incluido</span>    
                         </div>
                    </div>
                    <a href="{{ route('product.view', [$slug_type, $item->product->category->slug, $item->product->slug]) }}" class="box_product_lm">+ {{ __('links.know_more_here') }}</a>
                    @include('_partials.favorite', array('class' => 'box_product_lk', 'type' => 0, 'favorites' => $favorites_p, 'record' => $item->product))
                    </div>
               @endforeach
          </div>

     @endif


  <!-- AMP mt2 -->
  @if(!empty($product->image_background))
     <div class="wpi_b3">
          <div class="ib3">
          <img src="{{ asset('uploads/' . $product->image_background) }}" alt="">
          <div class="ib3_txt_amp">
          <div class="ib3_txt_amp_cu">
               {!! $product->info_additional_1 !!}
          </div>
          <div class="ib3_txt_amp_cu">
               {!! $product->info_additional_2 !!}
          </div>
          </div>
          </div>
     </div>
  @endif
    

    @if (count($product->images1) == 5)
      <div class="gal_motsam">
        <div class="gal_motsam2">
          @foreach ($product->images1 as $gallery)
               @if (!$loop->last)
               <div class="gal_motsam4">
                    <img src="{{ asset('uploads/' . $gallery->image) }}">
               </div>  
               @endif    
          @endforeach 

        </div>

        <div class="gal_motsam2">

           @foreach ($product->images1 as $gallery)

            @if ($loop->last)

                   <img src="{{ asset('uploads/' . $gallery->image) }}"> 

            @endif                    

          @endforeach 

         

        </div>

      </div>

    @endif

    





  <!-- CONTACTENOS -->

    <div class="w_form1">

      <div class="cont_form1">

        <div class="form1_tit">

          {!! $section->contents[1]->text_1 !!}

        </div>

         <form action="{{ url()->current() }}" class="fr_dsform1" id="form_contact" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

          <input type="hidden" name="motorcycle" value="{{ $product->name }}">

            <input type="hidden" name="section" value="{{ __('menu.motorcycle') }}"> 

          <div class="fg_grd_c">

            <div class="fg_grd">

              <div class="fg_inpt">

                <input type="text" id="name" name="name" placeholder="{{ __('forms.name') }}" value="{{ old('name') }}">

              </div>

            </div>

            <div class="fg_grd">

              <div class="fg_inpt">

                <input type="text" name="phone" placeholder="{{ __('forms.phone') }}" value="{{ old('phone') }}">

              </div>

            </div>

            <div class="fg_grd">

              <div class="fg_inpt">

                <input type="text" id="email" name="email" placeholder="{{ __('forms.email') }}" value="{{ old('email') }}">

              </div>

            </div>

            <div class="fg_grd">

              <div class="fg_inpt">
                <input type="text" id="subject" name="subject" placeholder="{{ __('forms.subject') }}" value="{{ old('subject') }}">
              </div>

            </div>

          </div>

          <div class="fg_grd_c">
            <div class="fg_txtrea">
              <textarea name="message" id="message" cols="30" rows="10" placeholder="{{ __('forms.message') }}" >{{ old('message') }}</textarea>
            </div>

          </div>

          @if ($document_check != null)
              <div class="fg_grd_d">
                <div class="fg_check">
                  <input type="checkbox" id="_check_policy" name="_check_policy" {{ old('_check_policy') ? 'checked' : '' }}>
                  <label for="">{{ __('forms.check') }} // <a href="{{ route('links', $document_check->slug) }}" target="_blank">{{ __('links.clic_here') }} </a> </label>

                </div>

              </div>

          @endif         

          <div class="fg_grd_e">
            <div class="fg_grd_md">
              <div class="fg_inpt fg_inpt_sbmt">
                <input type="button" value="{{ __('links.send_message') }}" id="btnSendContactMoto">
              </div>
            </div>
          </div>
          <input type="hidden" name="_recaptcha" id="recaptcha">
        </form>

      </div>

    </div>
    <div id="container-popup" style="display: none">
      <div class="popup" id="popup">
          <div class="popup-inner-motorcycle"> 
            <div class="popuptitle">     
             {!! $section->contents[2]->text_1 !!}
            </div>
            <div class="popuptext">
                {!! $section->contents[2]->text_2 !!}
            </div>

            <div class="popupbutton">
              <button class="close_popop">{{ __('links.reject') }}</button>
              <button class="ok acept-terms">{{ __('links.acept') }}</button>
            </div>
            <a class="closepopup" href="javascript:void(0)">X</a>
          </div>
        </div>
    </div>
@stop
@push('js')
<script>
  $(document).ready(function($) {
     $('.popup').addClass('active');
    var url_wompi = '';
    $('.btn-wompi').click(function(event) {
      url_wompi = $(this).data('url');
      $('#container-popup').show();
       $('.popup').addClass('active');
    });

    $('.see_legal').click(function(event) {
      $('#container-popup').show();
       $('.popup').addClass('active');
    });

    $('.acept-terms').click(function(event) {
      window.open(url_wompi);
      $('.popup').removeClass('active');
    });
    $('.closepopup').click(function(event) {
      $('.popup').removeClass('active');
    });

    $('.close_popop').click(function(event) {
      $('.popup').removeClass('active');
    });
  });
</script>
<script src="https://www.google.com/recaptcha/api.js?render={{ config('settings.recaptcha_key_site') }}"></script>

@include('_partials.script_validate', array('action' => 'motorcycle'))

@endpush

