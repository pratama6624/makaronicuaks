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
                        <button type="button" class="btn btn-secondary" style="margin-right: 10px">Rekomendasi</button>
                        <button type="button" class="btn btn-light" style="margin-right: 10px">Lagi Diskon</button>
                        <button type="button" class="btn btn-light" style="margin-right: 10px">Termurah</button>
                        <button type="button" class="btn btn-light">Termahal</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 menu-wrap">
                        <?php foreach($productData as $product) { ?>
                        <div class="menus d-flex align-items-center">
                            <div class="menu-img rounded-circle">
                                <img class="img-fluid" src="/assets/images/products/<?= $product["image"] ?>" alt="" style="display: block; margin: 0 auto; width: 150%">
                            </div>
                            <div class="text-wrap">
                                <div class="row align-items-start">
                                    <div class="col-4">
                                        <h4><?= $product["product_name"] ?></h4>
                                        <h6 style="color: gray">Rasa <?= $product["flavor"] ?></h6>
                                    </div>
                                    <div class="col-4 text-center">
                                        <h4><?= $product["name"] ?> (<span style="color: red">50% OFF</span>)</h4>
                                        <h6>Rp 15.000</h6>
                                    </div>
                                    <div class="col-4">
                                        <a href="#"><h4 class="text-muted menu-price"><u>Kerangjang</u></h4></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
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