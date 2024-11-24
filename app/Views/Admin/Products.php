<?= $this->extend('Layouts/TemplateAdmin') ?>
<?= $this->section('content') ?>

<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo">
                        <a href="index.html"><img src="/assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>

            <?= $this->include('Layouts/Sections/AdminSidebar') ?>

            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title mb-3">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Makaroni Cuaks - Produk</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Beranda</li>
                                <li class="breadcrumb-item active" aria-current="page">Produk</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div style="background-color: #f2f7ff;" class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <!-- Tombol di sisi kiri -->
                        <a href="/admin/products/add" class="btn btn-primary">Tambah Produk</a>

                        <!-- Tombol di sisi kanan -->
                        <div>
                            <a href="/admin/products/add" class="btn btn-primary">List Gambar</a>
                            &nbsp;
                            <a href="/admin/products/add" class="btn btn-secondary">List Detail</a>
                        </div>
                    </div>
                    <div class="card-body" style="margin-top:30px">
                        <div class="row">
                            <?php if(empty($productData)) { ?>
                            <div class="col-xl-4 col-md-6 col-sm-12">
                                <div class="alert alert-danger">TIdak ada produk tersedia</div>
                            </div>
                            <?php } ?>
                            <?php foreach($productData as $product) { ?>
                            <div class="col-xl-2 col-md-6 col-sm-12">
                                <a
                                    href="/admin/product/detail/<?= encrypt($product["id_product"]) . "?return_url=" . urlencode(current_url()); ?>">

                                    <div class="card">
                                        <div class="card-content">
                                            <h6 style="padding: 10px; margin-bottom: 0px" class="">
                                                <?= $product["product_name"]?></h6>
                                            <div class="image-container position-relative">
                                                <?php if ($product["discount_status"] == 1 || $product["id_discount"] != null) { ?>
                                                <!-- Overlay warna hitam semi-transparan di atas gambar -->
                                                <div class="overlay"></div>
                                                <!-- Label Diskon -->
                                                <div class="discount-label">
                                                    <?php if($product["discount_status"] == 0 && $product["id_discount"] != null) : ?>
                                                        <?= $product["name"] ?><br>
                                                    <?php endif ?>
                                                    <?php if($product["discount_note"] != "") : ?>
                                                        <?= $product["discount_note"] ?><br>
                                                    <?php endif ?>
                                                    <?= $product["discount_status"] == 1 && $product["id_discount"] == null ? $product["discount_amount"] : $product["precentage"] ?>%
                                                    OFF
                                                </div>
                                                <?php } ?>
                                                <img class="img-fluid w-100"
                                                    src="/assets/images/products/<?= $product["image"] ?>"
                                                    alt="Card image cap">
                                            </div>
                                        </div>
                                        <div style="padding: 10px; height: 40px;"
                                            class="d-flex justify-content-between align-items-center">
                                            <?php if($product["discount_status"] == 0 && $product["id_discount"] == null) { ?>
                                            <span>Rp <?= number_format($product["price"], 0, ',', '.'); ?></span>
                                            <?php } else { ?>
                                            <b><s style="color: red"><span>Rp
                                                        <?= number_format($product["price"], 0, ',', '.'); ?></span></s></b>
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
                                            <span><?= $product["discount_status"] == 1 || $product["id_discount"] != null ? "Rp " . number_format($afterDiscount, 0, ',', '.') : ""; ?></span>
                                        </div>
                                    </div>

                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?= $this->endSection() ?>