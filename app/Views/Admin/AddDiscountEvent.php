<?= $this->extend('Layouts/TemplateAdmin') ?>
<?= $this->section('content') ?>

<?php
    $session = session()->getFlashdata('validation'); 
    $sessionSuccess = session()->getFlashdata('success');
?>

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
                            <h3>Makaroni Cuaks - Diskon Event</h3>
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
                            <div class="row">
                                <div class="col-7">
                                    <div class="card">
                                    <form method="POST" class="form form-horizontal" action="/admin/add_discount_event/save" enctype="multipart/form-data">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <!-- Tombol di sisi kiri -->
                                            <a href="/admin/discount_event" class="btn btn-secondary d-flex align-items-center" style="width: 160px;">
                                                <i class="bi bi-chevron-left"></i>&nbsp; Tambah Event
                                            </a>
                                            
                                            <!-- Tombol di sisi kanan -->
                                            <div>
                                                <a href="/admin/add_discount_event" class="btn btn-danger">Reset</a>
                                                &nbsp;
                                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                    <div class="row">
                                                        <!-- Kolom Kiri -->
                                                        <div class="col-md-12">
                                                        <?php if(isset($sessionSuccess) && $sessionSuccess != null) : ?>
                                                            <div class="alert alert-success flashdata"><?= $sessionSuccess ?></div>
                                                            <br>
                                                        <?php endif ?>
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label>Nama Event</label>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <?php if(isset($session["event_name"]) && $session["event_name"] != null) : ?>
                                                                            <b><span class="flashdata" style="color: red;"><?= $session["event_name"] ?></span></b>
                                                                        <?php endif ?>
                                                                        <input type="text" id="event_name" class="form-control" name="event_name" value="<?= old('event_name') ?>" placeholder="">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Tanggal Mulai Event</label>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <?php if(isset($session["event_start_date"]) && $session["event_start_date"] != null) : ?>
                                                                            <b><span class="flashdata" style="color: red;"><?= $session["event_start_date"] ?></span></b>
                                                                        <?php endif ?>
                                                                        <input type="date" style="height: 40px" id="event_start_date" class="form-control" name="event_start_date" value="<?= old('event_start_date') ?>" placeholder="">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Tanggal Selesai Event</label>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <?php if(isset($session["event_end_date"]) && $session["event_end_date"] != null) : ?>
                                                                            <b><span class="flashdata" style="color: red;"><?= $session["event_end_date"] ?></span></b>
                                                                        <?php endif ?>
                                                                        <input type="date" style="height: 40px" id="event_end_date" class="form-control" name="event_end_date" value="<?= old('event_end_date') ?>" placeholder="">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Diskon (Satuan %)</label>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <?php if(isset($session["precentage"]) && $session["precentage"] != null) : ?>
                                                                            <b><span class="flashdata" style="color: red;"><?= $session["precentage"] ?></span></b>
                                                                        <?php endif ?>
                                                                        <input type="number" id="precentage" class="form-control" value="<?= old('precentage') ?>" name="precentage" placeholder="0.00" step="0.01" min="0">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Deskripsi Event</label>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <textarea class="form-control" name="event_description" id="event_description" rows="6"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>