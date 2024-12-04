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

    <div class="hero mb-5">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6 hero-left">
                    <h1 class="display-4 mb-5">Kami Cinta <br>Camilan Lezat!</h1>
                    <div class="mb-2">
                        <a class="btn btn-primary btn-shadow btn-lg" href="#" role="button">Jelajahi Menu</a>
                        <a class="btn btn-icon btn-lg" href="https://player.vimeo.com/video/33110953"
                            data-featherlight="iframe" data-featherlight-iframe-allowfullscreen="true">
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
                            <img class="img-fluid" src="/assets/images/samples/cuakspedas.png" alt="">
                        </div>
                        <div class="item">
                            <img class="img-fluid" src="/assets/images/samples/1732635119_e8c79be5a1e9c2b631da.png" alt="">
                        </div>
                        <div class="item">
                            <img class="img-fluid" src="/assets/images/samples/cuaks.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('Layouts/Sections/Footer') ?>

    <?= $this->endSection() ?>