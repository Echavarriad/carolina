@include('_partials.header_home')
<main class="main">
    <section class="section_one_main">
        <section class="banner fade-bottom reveal">
            <div>
                <h1>DISCOVER NOW / scrolling down</h1>
            </div>
            <div class="backgroun-img">
                <img src="{{ asset('img/video 2.png') }}" alt="" width="100%">
            </div>
        </section>
        <section class="section_two_main">
            <div class="section_two_main--top">
                {{-- <h2>Nuestros tratamientos makeup<br> that’s skin loving</h2> --}}
                <img src="{{ asset('img/services 01.png') }}" alt="" width="100%">
            </div>

            <div class="section_two_main--body flex">
                <div>
                    <img src="{{ asset('img/images.png') }}" alt="" width="100%">
                </div>
                <div class="section_two_text">
                    <p class="section_two_text--one-p">Perfilamiento y aumento<br> labial.</p>
                    <p class="section_two_text--two-p">On the other<br> hand, we magna<br> with righteous<br> labial.
                    </p>
                    <p class="section_two_text--three-p">
                        who are so beguiled and demoralized by the<br> charms of pleasure of the moment, so blinded<br>
                        by
                        desire, that they cannot foresee the pain<br> and trouble that are bound to ensue; and<br> equal
                        blame
                        belongs to those who fail in their<br> duty through weakness of will,<br><br> which is the same
                        as
                        saying
                        through<br> shrinking from toil and pain. These cases are<br> perfectly simple and easy to
                        distinguish.
                    </p>
                    <a href="" type="buttom" class="">... Conoce más</a>
                </div>
            </div>
        </section>
    </section>

    <section class="section_three_main">
        <div class="flex">
            <div class="content section_content_one">
                <img src="{{ asset('img/01.png') }}" alt="" width="100%">
            </div>
            <div class="content section_content_two">
                <img src="{{ asset('img/02.png') }}" alt="" width="100%">
            </div>
            <div class="content section_content_three section_content_three--text">
                <div class="flex">
                    <div>
                        <img src="{{ asset('img/info(5).png') }}" alt="">
                    </div>

                </div>
                <div class="section_title">
                    <h3>We have carefully selected each ingredient, so that not only the products</h3>
                </div>
                <div class="section_texte">
                    <p>
                        who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by
                        desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame
                        belongs to those who fail in their duty through weakness of will, <br><br>which is the same as
                        saying
                        through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="section_four_main">
        <div class="flex center">
            <div class="section_four_content overlay">
                <div><img class="img" src="{{ asset('img/Rectangle 17.png') }}" alt=""></div>
                <div>
                    <p>New survey sheds light on providers'
                        embrace of telemedicine</p>
                    <a href="">... Leer este blog</a>
                </div>
            </div>
            <div class="section_four_content overlay">
                <div><img class="img" src="{{ asset('img/Rectangle 17 (1).png') }}" alt=""></div>
                <div>
                    <p>New survey sheds light on providers'
                        embrace of telemedicine</p>
                    <a href="">... Leer este blog</a>
                </div>
            </div>
            <div class="section_four_content overlay">
                <div><img class="img" src="{{ asset('img/01(7).png') }}" alt=""></div>
                <div>
                    <p>New survey sheds light on providers'
                        embrace of telemedicine</p>
                    <a href="">... Leer este blog</a>
                </div>
            </div>
        </div>
    </section>
    <section class="section_five_content">
        <div class="section_five_content--top">
            <h1>What people are saying</h1>
            <p>Experience worry / free beauty</p>
        </div>
        <div class="section_five_content--buttom flex">
            <div class="section_five_content--text">
                <h3 class="name">Sara Martínez</h3>
                <p class="type">testimonio</p>
                {{-- <i class="fa-brands fa-gratipay" style="color: #d3bf90;"></i> --}}
                <hr>
                <p class="comment">products feel amazing on the skin and so nourishing. I am able to easily create a
                    natural look or an
                    evening look.</p>
            </div>
            <div class="section_five_content--text">
                <h3>Alejandra Buitrago</h3>
                <p class="type">testimonio</p>
                <hr>
                <p>products feel amazing on the skin and so nourishing. I am able to easily create a natural look or an
                    evening look.</p>
            </div>
            <div class="section_five_content--text">
                <h3>Ronald Ayazo</h3>
                <p class="type">testimonio</p>
                <hr>
                <p>products feel amazing on the skin and so nourishing. I am able to easily create a natural look or an
                    evening look.</p>
            </div>
        </div>
    </section>
</main>
<script>
    function reveal() {
        var reveals = document.querySelectorAll(".reveal");

        for (var i = 0; i < reveals.length; i++) {
            var windowHeight = window.innerHeight;
            var elementTop = reveals[i].getBoundingClientRect().top;
            var elementVisible = 150;

            if (elementTop < windowHeight - elementVisible) {
                reveals[i].classList.add("active");
            } else {
                reveals[i].classList.remove("active");
            }
        }
    }

    window.addEventListener("scroll", reveal);
</script>

@include('_partials.footer')
