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
                            <button type="button" class="btn btn-secondary" style="margin-right: 10px"
                                onclick="window.location.href='/products/recomendation';">Rekomendasi</button>
                            <button type="button" class="btn btn-light" style="margin-right: 10px"
                                onclick="window.location.href='/products/discount';">Lagi Diskon</button>
                            <button type="button" class="btn btn-light" style="margin-right: 10px"
                                onclick="window.location.href='/products/price_asc';">Termurah</button>
                            <button type="button" class="btn btn-light"
                                onclick="window.location.href='/products/price_desc';">Termahal</button>
                        </div>


                        ENTAH KENAPA CSS TIDAK TERLOAD DI HALAMAN PRODUK INI, COBA CARI TAU AJA



                    </div>
                </div>
                <div class="row">
                    <div class="col-12 menu-wrap">
                        <?php foreach($productData as $product) { ?>
                        <div class="menus d-flex align-items-center">
                            <div class="menu-img rounded-circle">
                                <img class="img-fluid" src="/assets/images/products/<?= $product["image"] ?>" alt=""
                                    style="display: block; margin: 0 auto; width: 150%">
                            </div>
                            <div class="text-wrap">
                                <div class="row align-items-start">
                                    <div class="col-4">
                                        <h4><?= $product["product_name"] ?></h4>
                                        <h6 style="color: gray">Rasa <?= $product["flavor"] ?></h6>
                                    </div>
                                    <div class="col-4 text-center">
                                        <?php if($product["id_discount"] != null) { ?>
                                        <h4><?= $product["name"] ?> (<span
                                                style="color: red"><?= $product["precentage"] ?>% OFF</span>)</h4>
                                        <?php } else if($product["id_discount"] == null && $product["discount_status"] == 1) { ?>
                                        <h4><?= $product["discount_note"] ?> (<span
                                                style="color: red"><?= $product["discount_amount"] ?>% OFF</span>)</h4>
                                        <?php } else { ?>
                                        <h4>-</h4>
                                        <?php } ?>

                                        <?php
                                                        if($product["discount_status"] == 1) {
                                                            $discountAmount = $product["price"] * ($product["discount_amount"] / 100);
                                                            $afterDiscount = $product["price"] - $discountAmount;
                                                        } else if($product["id_discount"] != null) {
                                                            $discountAmount = $product["price"] * ($product["precentage"] / 100);
                                                            $afterDiscount = $product["price"] - $discountAmount;
                                                        }
                                                    ?>
                                        <h6>
                                            <?= $product["id_discount"] != null || $product["discount_status"] == 1 ? "<s style='color: red'>Rp" . number_format($product["price"], 0, ',', '.') . "</s>" : "Rp" . number_format($product["price"], 0, ',', '.') ?>
                                            <?= $product["discount_status"] == 1 || $product["id_discount"] != null ? "&nbsp; Rp " . number_format($afterDiscount, 0, ',', '.') : ""; ?>
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