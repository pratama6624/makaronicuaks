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
                            <a style="border-radius: 10px" class="btn btn-primary btn-shadow btn-lg"
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
                                    <h4><?= $product["name"] ?> (<span style="color: red"><?= $product["precentage"] ?>%
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
                                    <a href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="red"
                                            class="bi bi-eye" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                        </svg>
                                    </a>
                                    &nbsp; &nbsp; &nbsp;
                                    <div style="position: relative; display: inline-block;">
                                        <?= $product["quantity"] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    </div>
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