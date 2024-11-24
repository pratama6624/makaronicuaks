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
                        <h3>Makaroni Cuaks - Diskon Event</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Beranda</li>
                                <li class="breadcrumb-item active" aria-current="page">Diskon</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <!-- Tombol di sisi kiri -->
                        <a href="/admin/discount_event" class="btn btn-secondary d-flex align-items-center"
                            style="width: 200px;">
                            <i class="bi bi-chevron-left"></i>&nbsp; Detail Event Diskon
                        </a>

                        <!-- Tombol di sisi kanan -->
                        <div>
                            <a href="" class="btn btn-primary">Edit</a>
                            &nbsp;
                            <a href="" class="btn btn-danger">Hapus</a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div>
                            <div class="card-header" style="margin-bottom: -20px">
                                <h4 class="card-title">Nama Event : <?= $discountEventData["name"] ?></h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="alert alert-secondary" style="padding-top: 25px">
                                        <h4 class="alert-heading">
                                            <?= strftime("%d %B %Y", strtotime($discountEventData['start_date'])) ?> -
                                            <?= strftime("%d %B %Y", strtotime($discountEventData['end_date'])) ?>
                                            &nbsp;
                                            <button type="button" class="btn btn-danger">
                                                <?= $discountEventData["precentage"] ?>% OFF
                                            </button>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <section class="section">
                <div style="background-color: #f2f7ff;" class="card">
                    <div class="card-body">
                        <div class="row">
                            <?php if(empty($discountEventProductData)) : ?>
                            <div class="col-xl-4 col-md-6 col-sm-12">
                                <div class="alert alert-danger">TIdak ada produk tersedia</div>
                            </div>
                            <?php endif ?>
                            <?php foreach($discountEventProductData as $productData) : ?>
                            <div class="col-xl-2 col-md-6 col-sm-12">
                                <a href="/admin/product/detail/<?= encrypt($productData["id_product"]) . "?return_url=" . urlencode(current_url()); ?>">
                                    <div class="card">
                                        <div class="card-content">
                                            <h6 style="padding: 10px; margin-bottom: 0px" class="">
                                                <?= $productData["product_name"] ?></h6>
                                            <div class="image-container position-relative">
                                                <div class="overlay"></div>
                                                <!-- Label Diskon -->
                                                <div class="discount-label">
                                                    <?= $productData["name"] ?> <br>
                                                    <?= $productData["precentage"] ?>% OFF
                                                </div>
                                                <img class="img-fluid w-100"
                                                    src="/assets/images/products/<?= $productData["image"] ?>"
                                                    alt="Card image cap">
                                            </div>
                                        </div>
                                        <div style="padding: 10px; height: 40px;"
                                            class="d-flex justify-content-between align-items-center">
                                            <b><s style="color: red"><span>Rp <?= number_format($productData["price"], 0, ',', '.') ?></span></s></b>
                                            <span>Rp <?= number_format(($productData["price"] - ($productData["price"] * ($productData["precentage"] / 100))), 0, ',', '.') ?></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?= $this->endSection() ?>