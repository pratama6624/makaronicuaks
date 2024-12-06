<?= $this->extend('Layouts/TemplateUser') ?>
<?= $this->section('content') ?>

<div id="canvas-overlay"></div>
	<div class="boxed-page">
	
    <?= $this->include('Layouts/Sections/Nav') ?>

    <!-- Menu Section -->
    <section id="gtco-menu" class="section-padding">
        <div class="container">
            <div class="section-content">
                <div class="row mb-5" style="margin-top: -70px">
                    <div class="col-md-12">
                        <div class="heading-section text-center">
                            <button type="button" class="btn btn-secondary"
                                onclick="window.location.href='/products?filter=price_desc';">Termahal</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 menu-wrap">
                        <div class="menus d-flex align-items-center">
                            <div class="menu-img rounded-circle">
                                <img class="img-fluid" src="/assets/images/products/1731603562_cf63ed5d2745244362a2.jpg" alt=""
                                    style="display: block; margin: 0 auto; width: 150%">
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
                                    <div class="col-4">
                                        <a href="#">
                                            <h4 class="text-muted menu-price"><u>Kerangjang</u></h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of menu Section -->

    <?= $this->include('Layouts/Sections/Footer') ?>

</div>
</div>

<?= $this->endSection() ?>