<?= $this->extend('Layouts/TemplateUser') ?>
<?= $this->section('content') ?>

<div id="canvas-overlay"></div>
<div class="boxed-page">

    <?= $this->include('Layouts/Sections/Nav') ?>

    <!-- Menu Section -->
    <section id="gtco-menu" class="section-padding">
        <div class="container">
            <?php if(session()->get('cart') != null) { ?>
            <div class="section-content">
                <div class="row mb-5" style="margin-top: -70px">
                    <div class="col-md-12">
                        <div class="heading-section text-center">
                            <a style="border-radius: 10px" class="btn btn-primary btn-shadow btn-lg"
                                href="/products?filter=recomendation" role="button">Belanja lagi</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php foreach(session()->get('cart') as $shoppingCart) { ?>
                    <div class="col-12 menu-wrap">
                        <div class="menus d-flex align-items-center">
                            <div class="menu-img rounded-circle">
                                <img class="img-fluid" src="/assets/images/products/1731603562_cf63ed5d2745244362a2.jpg"
                                    alt="" style="display: block; margin: 0 auto; width: 150%">
                            </div>
                            <div class="text-wrap">
                                <div class="row align-items-start">
                                    <div class="col-4">
                                        <h4>Makaroni pedas</h4>
                                        <h6 style="color: gray">Rasa pedas</h6>
                                    </div>
                                    <div class="col-4 text-center">
                                        <h4>-</h4>
                                        <h6>
                                            <?= number_format("15000", 0, ',', '.') ?>
                                        </h6>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8" />
                                            </svg>
                                        </a>
                                        <span style="margin-left: 15px; margin-right: 15px"><b>4</b></span>
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="d-flex justify-content-end align-items-center vh-100 mt-5" style="margin-bottom: -80px">
                <div class="col-lg-4 text-center"
                    style="background-color: lightgrey; padding-top: 40px; padding-bottom: 30px; border-radius: 20px">
                    <div class="footer-widget px-lg-5 px-0">
                        <h4>Jam Operasional</h4>
                        <ul class="list-unstyled open-hours">
                            <li class="d-flex justify-content-between"><span>Makaroni pedas (x1)</span><span>Rp
                                    15.000</span></li>
                            <li class="d-flex justify-content-between"><span>makaroni keju (x1)</span><span>Rp
                                    12.000</span></li>
                            <br>
                            <li class="d-flex justify-content-between"><span>Total</span><span style="color: red"><b>Rp
                                        27.000</b></span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php } else { ?>
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading-section text-center">
                            <h2>Keranjang belanja kosong</h2>
                            <a style="border-radius: 5px" class="btn btn-light btn-shadow btn-lg mt-5" href="/products?filter=recomendation" role="button">Belanja sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
    <!-- End of menu Section -->

    <?= $this->include('Layouts/Sections/Footer') ?>

</div>
</div>

<?= $this->endSection() ?>