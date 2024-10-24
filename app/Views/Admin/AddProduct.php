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
                                            <h4 class="card-title">Tambahkan Produk Baru</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="form form-horizontal">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Nama Produk</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="product_name" class="form-control" name="product_name" placeholder="">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Harga</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="number" id="price" class="form-control" name="price" placeholder="">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Varian Rasa</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="falvor" class="form-control" name="falvor" placeholder="">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Stok Barang</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="number" id="stock" class="form-control" name="stock" placeholder="">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Kategori</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="category" class="form-control" name="category" placeholder="">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Berat</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="weight" class="form-control" name="weight" placeholder="">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Status Diskon</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <fieldset class="form-group">
                                                                    <select class="form-select" id="discount_status">
                                                                        <option>Tidak Sedang Diskon</option>
                                                                        <option>Sedang Diskon</option>
                                                                    </select>
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Diskon (Satuan %)</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="discount_amount" class="form-control" name="discount_amount" placeholder="">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Deskripsi Produk</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <textarea class="form-control" id="description" rows="3"></textarea>
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