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
                                <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Detail Produk</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-6 col col-sm-12 xs-12">
                                                        <div class="form-group">
                                                            <div class="card" style="border: 1px solid grey; position: relative;">
                                                                <div class="card-content">
                                                                    <!-- Overlay warna hitam semi-transparan di atas gambar -->
                                                                    <div class="overlay"></div>
                                                                    
                                                                    <!-- Label Diskon Bulat -->
                                                                    <div class="discount-label">50%</div>
                                                                    
                                                                    <!-- Gambar -->
                                                                    <img src="/assets/images/samples/cuaks.png" class="card-img-top img-fluid" alt="singleminded" style="width: 100%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="/admin/products" class="btn btn-danger">Kembali</a>
                                                        &nbsp; &nbsp;
                                                        <a href="/admin/products/add" class="btn btn-primary">Edit Produk</a>
                                                    </div>
                                                    <div class="col-xl-8 col-md-6 col col-sm-12 xs-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-lg">
                                                                <thead style="background-color: #f2f7ff;">
                                                                    <tr>
                                                                        <th width="40%">PROPERTI</th>
                                                                        <th width="60%">KETERANGAN</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-bold-500">Nama Produk</td>
                                                                        <td>Makaroni Cuaks Pedas</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-bold-500">Harga</td>
                                                                        <td><b><s style="color: red">Rp 15.000</s></b> &nbsp; Rp 7.500</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-bold-500">Varian Rasa</td>
                                                                        <td>Pedas</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-bold-500">Stok Barang</td>
                                                                        <td>15</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-bold-500">Kategori Makanan/Minuman</td>
                                                                        <td>Makanan Ringan</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-bold-500">Berat</td>
                                                                        <td>1000 Gram</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-bold-500">Deskripsi</td>
                                                                        <td><textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
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