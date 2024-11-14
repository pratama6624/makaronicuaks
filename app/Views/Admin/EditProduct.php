<?= $this->extend('Layouts/TemplateAdmin') ?>
<?= $this->section('content') ?>

<?php $session = session()->getFlashdata('validation') ?>

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
                        <div class="col-xl-6 col-md-6 order-md-2 order-last">
                            <h3>Makaroni Cuaks</h3>
                        </div>
                        <div class="col-xl-6 col-md-6 order-md-2 order-first">
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Edit Produk</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form method="POST" class="form form-horizontal" action="/admin/products/save">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Nama Produk</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <?php if(isset($session["product_name"]) && $session["product_name"] != null) : ?>
                                                                    <b><span class="flashdata" style="color: red;"><?= $session["product_name"] ?></span></b>
                                                                <?php endif ?>
                                                                <input type="text" id="product_name" class="form-control" name="product_name" value="<?= $productDetailData["product_name"] ?>" placeholder="">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Harga</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="number" id="price" class="form-control" name="price" value="<?= $productDetailData["price"] ?>" placeholder="">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Varian Rasa</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <?php if(isset($session["flavor"]) && $session["flavor"] != null) : ?>
                                                                    <b><span class="flashdata" style="color: red;"><?= $session["flavor"] ?></span></b>
                                                                <?php endif ?>
                                                                <input type="text" id="flavor" class="form-control" name="flavor" value="<?= $productDetailData["flavor"] ?>" placeholder="">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Stok Barang</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="number" id="stock" class="form-control" name="stock" value="<?= $productDetailData["stock"] ?>" placeholder="">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Kategori</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <fieldset class="form-group">
                                                                    <select class="form-select" id="category">
                                                                        <option value="Camilan" <?= $productDetailData["category"] == "Camilan" ? "selected" : ""?>> Camilan </option>
                                                                        <option value="Minuman" <?= $productDetailData["category"] == "Minuman" ? "selected" : ""?>> Minuman </option>
                                                                        <option value="Makanan Berat" <?= $productDetailData["category"] == "Makanan Berat" ? "selected" : ""?>> Makanan Berat </option>
                                                                    </select>
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Berat</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="number" id="weight" class="form-control" name="weight" value="<?= $productDetailData["weight"] ?>" placeholder="">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Status Diskon</label>
                                                            </div>

                                                            <div class="col-md-8 form-group">
                                                                <fieldset class="form-group">
                                                                    <select class="form-select" id="discount_status" onchange="toggleDiscountAmount()">
                                                                        <option value="Tidak sedang diskon" <?= $productDetailData["discount_status"] == 0 ? "selected" : "" ?>>Tidak Sedang Diskon</option>
                                                                        <option value="Sedang diskon" <?= $productDetailData["discount_status"] == 1 ? "selected" : "" ?>>Sedang Diskon</option>
                                                                    </select>
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-4" id="discount_label" <?= $productDetailData["discount_status"] == 0 ? "style='display: none;'" : "" ?>>
                                                                <label>Diskon (Satuan %)</label>
                                                            </div>
                                                            <div class="col-md-8 form-group" id="discount_input" <?= $productDetailData["discount_status"] == 0 ? "style='display: none;'" : "" ?>>
                                                                <input type="number" id="discount_amount" class="form-control" value="<?= $productDetailData["discount_status"] == 1 ? $productDetailData["discount_amount"] : "" ?>" name="discount_amount" placeholder="0.00" step="0.01" min="0">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Deskripsi Produk</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <textarea class="form-control" id="description" rows="3"><?= $productDetailData["description"] ?></textarea>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Gambar</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <div class="card" style="border: 1px solid grey">
                                                                    <div class="card-content">
                                                                        <img src="/assets/images/samples/cuaks.png" class="card-img-top img-fluid" alt="singleminded" style="width: 100%;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 d-flex justify-content-end">
                                                                <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Batal</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>