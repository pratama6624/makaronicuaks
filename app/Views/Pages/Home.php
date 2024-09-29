<?= $this->extend('Layouts/TemplateUser') ?>
<?= $this->section('content') ?>

<div id="side-nav" class="sidenav">
	<a href="javascript:void(0)" id="side-nav-close">&times;</a>
	
	<div class="sidenav-content">
		<p>
			Kuncen WB1, Wirobrajan 10010, DIY
		</p>
		<p>
			<span class="fs-16 primary-color">(+68) 120034509</span>
		</p>
		<p>info@yourdomain.com</p>
	</div>
</div>
<div id="side-search" class="sidenav">
	<a href="javascript:void(0)" id="side-search-close">&times;</a>
	<div class="sidenav-content">
		<form action="">
			<div class="input-group md-form form-sm form-2 pl-0">
			  <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search">
			  <div class="input-group-append">
			    <button class="input-group-text red lighten-3" id="basic-text1">
			    	<i class="fas fa-search text-grey" aria-hidden="true"></i>
			    </button>
			  </div>
			</div>

		</form>
    </div>
</div>

<div id="canvas-overlay"></div>
	<div class="boxed-page">
	
    <?= $this->include('Layouts/Sections/Nav') ?>
    
<div class="hero">
  <div class="container">
	<div class="row d-flex align-items-center">
		<div class="col-lg-6 hero-left">
		    <h1 class="display-4 mb-5">Kami Cinta <br>Camilan Lezat!</h1>
		    <div class="mb-2">
		    	<a class="btn btn-primary btn-shadow btn-lg" href="#" role="button">Jelajahi Menu</a>
			    <a class="btn btn-icon btn-lg" href="https://player.vimeo.com/video/33110953" data-featherlight="iframe" data-featherlight-iframe-allowfullscreen="true">
			    	<span class="lnr lnr-film-play"></span>
			    	Putar Vidio
			    </a>
		    </div>
		   
		    <ul class="hero-info list-unstyled d-flex text-center mb-0">
		    	<li class="border-right">
		    		<span class="lnr lnr-rocket"></span>
		    		<h5>
		    			Kirim Cepat
		    		</h5>
		    	</li>
		    	<li class="border-right">
		    		<span class="lnr lnr-leaf"></span>
		    		<h5>
		    			Siap Makan
		    		</h5>
		    	</li>
		    	<li class="">
		    		<span class="lnr lnr-bubble"></span>
		    		<h5>
		    			24/7 Layanan
		    		</h5>
		    	</li>
		    </ul>

	    </div>
	    <div class="col-lg-6 hero-right">
	    	<div class="owl-carousel owl-theme hero-carousel">
			    <div class="item">
			    	<img class="img-fluid" src="img/hero-1.jpg" alt="">
			    </div>
			    <div class="item">
			    	<img class="img-fluid" src="img/hero-2.jpg" alt="">
			    </div>
			    <div class="item">
			    	<img class="img-fluid" src="img/hero-3.jpg" alt="">
			    </div>
			</div>
	    </div>
	</div>
  </div>
</div>		

<!-- Special Dishes Section -->
<section id="gtco-special-dishes" class="bg-grey section-padding mb-5 mt-5">
    <div class="container">
        <div class="section-content">
            <div class="heading-section text-center">
                <h2>
                    Menu Spesial
                </h2>
            </div>
            <div class="row mt-5">
                <div class="col-lg-5 col-md-6 align-self-center py-5">
                    <h2 class="special-number">01.</h2>
                    <div class="dishes-text">
                        <h3><span>Rasa Barbeque</span></h3>
                        <p class="pt-3">Nikmati sensasi panggangan autentik dengan Makaroni Cuaks rasa Barbeque! Kombinasi bumbu yang pas menciptakan cita rasa smoky dan gurih yang sempurna, membuat setiap gigitan terasa seperti pesta BBQ di lidah Anda.</p>
                        <h3 class="special-dishes-price">Rp 15.000</h3>
                        <a href="#" class="btn-primary mt-3">Beli Sekarang</a>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-2 col-md-6 align-self-center mt-4 mt-md-0">
                    <img src="img/steak.jpg" alt="" class="img-fluid shadow w-100">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-5 col-md-6 align-self-center order-2 order-md-1 mt-4 mt-md-0">
                    <img src="img/salmon-zucchini.jpg" alt="" class="img-fluid shadow w-100">
                </div>
                <div class="col-lg-5 offset-lg-2 col-md-6 align-self-center order-1 order-md-2 py-5">
                    <h2 class="special-number">02.</h2>
                    <div class="dishes-text">
                        <h3><span>Rasa Keju</span></h3>
                        <p class="pt-3">Untuk para pecinta pedas, Makaroni Cuaks rasa Pedas Keju adalah pilihan tepat! Perpaduan keju yang creamy dengan cabai yang menggigit menciptakan sensasi rasa yang luar biasa, membuat Anda ketagihan dalam setiap gigitan.</p>
                        <h3 class="special-dishes-price">Rp 15.000</h3>
                        <a href="#" class="btn-primary mt-3">Beli Sekarang<span><i class="fa fa-long-arrow-right"></i></span></a>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-5 col-md-6 align-self-center py-5">
                    <h2 class="special-number">03.</h2>
                    <div class="dishes-text">
                        <h3><span>Rasa Pedas</span></h3>
                        <p class="pt-3">Makaroni Cuaks rasa Pedas menghadirkan kelezatan yang menggigit dengan sentuhan pedas yang memanjakan lidah. Cocok untuk Anda yang suka tantangan rasa, setiap gigitan memberikan ledakan rasa pedas yang membuat Anda ingin lagi dan lagi.</p>
                        <h3 class="special-dishes-price">Rp 15.000</h3>
                        <a href="#" class="btn-primary mt-3">Beli Sekarang</a>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-2 col-md-6 align-self-center mt-4 mt-md-0">
                    <img src="img/steak.jpg" alt="" class="img-fluid shadow w-100">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-5 col-md-6 align-self-center order-2 order-md-1 mt-4 mt-md-0">
                    <img src="img/salmon-zucchini.jpg" alt="" class="img-fluid shadow w-100">
                </div>
                <div class="col-lg-5 offset-lg-2 col-md-6 align-self-center order-1 order-md-2 py-5">
                    <h2 class="special-number">04.</h2>
                    <div class="dishes-text">
                        <h3><span>Rasa Jagung Manis</span></h3>
                        <p class="pt-3">Rasakan manisnya kenikmatan Makaroni Cuaks rasa Jagung Manis! Dengan aroma jagung yang harum dan rasa manis yang lezat, camilan ini menjadi teman sempurna di setiap kesempatan. Membawa Anda kembali ke nostalgia camilan masa kecil yang penuh kenangan.</p>
                        <h3 class="special-dishes-price">Rp 15.000</h3>
                        <a href="#" class="btn-primary mt-3">Beli Sekarang<span><i class="fa fa-long-arrow-right"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of Special Dishes Section -->

<?= $this->include('Layouts/Sections/Footer') ?>

</div>
</div>

<?= $this->endSection() ?>
