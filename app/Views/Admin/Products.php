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
                            <h3>Makaroni Cuaks</h3>
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
                    <div class="card">
                        <div class="card-header">
                            <a href="/admin/products/add" class="btn btn-primary">Tambah Produk</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php foreach($productData as $product) { ?>
                                    <div class="col-xl-2 col-md-6 col-sm-12">
                                        <a href="/admin/product/detail/<?= encrypt($product["id_product"]); ?>">
                                            <div class="card" style="border: 1px solid grey">
                                                <div class="card-content">
                                                    <?php if($product["discount_status"] == 1) { ?>
                                                        <!-- Overlay warna hitam semi-transparan di atas gambar -->
                                                        <div class="overlay"></div>                
                                                        <!-- Label Diskon Bulat -->
                                                        <div class="discount-label"><?= $product["discount_amount"] ?>% OFF</div>
                                                    <?php } ?>
                                                    <img src="/assets/images/samples/cuaks.png" class="card-img-top img-fluid" alt="singleminded" style="width: 100%;">
                                                    <div class="card-text-overlay">
                                                        <h6 class="card-title"><?= $product["product_name"]?></h6>
                                                        <h6 class="font-extrabold mb-0">Rp <?= number_format($product["price"], 0, ',', '.'); ?></h6>
                                                    </div>
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