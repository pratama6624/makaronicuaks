<?= $this->extend('Layouts/TemplateUser') ?>
<?= $this->section('content') ?>

<div id="canvas-overlay"></div>
<div class="boxed-page">

    <?= $this->include('Layouts/Sections/Nav') ?>

    <!-- Menu Section -->
    <section id="gtco-menu" class="section-padding">
        <div class="container">
            <?php if($cartData != []) { ?>
            <div class="section-content">
                <div class="row mb-5" style="margin-top: -70px">
                    <div class="col-md-12">
                        <div class="heading-section text-center">
                            <a style="border-radius: 10px" class="btn btn-light btn-lg"
                                href="/products?filter=recomendation" role="button">Belanja lagi</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 menu-wrap">
                        <?php foreach($cartData as $product) { ?>
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
                                                style="color: red"><?= $product["precentage"] ?>%
                                                OFF</span>)</h4>
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
                                    <div class="col-4 text-right">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" class="bi bi-dash-circle btn-decrement" data-product-id="<?= $product["id_product"] ?>" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8" />
                                        </svg>
                                        &nbsp; &nbsp;
                                        <div class="quantity" style="position: relative; display: inline-block;">
                                            <?= $product["quantity"] ?>
                                        </div>
                                        &nbsp; &nbsp;
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" class="bi bi-plus-circle btn-increment" data-product-id="<?= $product["id_product"] ?>" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end align-items-center vh-100 mt-5" style="margin-bottom: -50px">
                <div class="col-lg-5 text-right"
                    style="background-color: light; border: 2px solid black; padding-top: 40px; padding-bottom: 30px; border-radius: 20px">
                    <div class="footer-widget px-lg-5 px-0">
                        <h4 style="margin-bottom: 30px">Total Belanja</h4>
                        <ul class="list-unstyled open-hours" style="margin-bottom: 30px;">
                            <?php foreach($shoppingSummary as $ss) { ?>
                                <li class="d-flex justify-content-between" style="margin-bottom: 10px"><span><?= $ss["product_name"] ?> (x<?= $ss["quantity"] ?>)</span><span><?= "Rp " . number_format($ss["total_price"], 0, ',', '.') ?></span></li>
                            <?php } ?>
                            <br>
                            <li class="d-flex justify-content-between"><span>Total</span><span style="color: red"><b><?= "Rp " . number_format($totalAmount, 0, ',', '.') ?></b></span></li>
                        </ul>
                        <a style="border-radius: 10px" class="btn btn-primary btn-lg"
                                href="" role="button">Pesan Sekarang</a>
                    </div>
                </div>
            </div>

            <?php } else { ?>
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading-section text-center">
                            <h2>Keranjang belanja kosong</h2>
                            <a style="border-radius: 5px" class="btn btn-light btn-shadow btn-lg mt-5"
                                href="/products?filter=recomendation" role="button">Belanja sekarang</a>
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