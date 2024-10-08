<?= $this->extend('Layouts/TemplateAdmin') ?>
<?= $this->section('content') ?>

<?php
    $numberOfActiveCustomers = count($activeCustomers);
    $numberOfInActiveCustomers = count($inActiveCustomers);
    $numberOfDeletedCustomers = count($deletedCustomers);
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
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Makaroni Cuaks</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Beranda</li>
                                    <li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Data Pelanggan
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                                                Pelanggan Aktif &nbsp; <span class="badge bg-<?= $numberOfActiveCustomers == 0 ? 'danger' : 'success' ?>"><?= $numberOfActiveCustomers ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                                                Pelanggan Belum Aktif &nbsp; <span class="badge bg-<?= $numberOfInActiveCustomers == 0 ? 'danger' : 'success' ?>"><?= $numberOfInActiveCustomers ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                                                Pelanggan Dihapus &nbsp; <span class="badge bg-<?= $numberOfDeletedCustomers == 0 ? 'danger' : 'success' ?>"><?= $numberOfDeletedCustomers ?></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade active show mt-4" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <?php if(empty($activeCustomers)) { ?>
                                                <div class="alert alert-danger">Belum ada pelanggan terdaftar</div>
                                            <?php } else { ?>
                                                <table class="table table-striped" id="table1">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Email</th>
                                                            <th>Telepon</th>
                                                            <th>Alamat</th>
                                                            <th>Tanggal Bergabung</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            $noTableActiveCustomers = 1;
                                                            foreach($activeCustomers as $activeCustomer) {
                                                        ?>
                                                            <tr>
                                                                <td><?= $noTableActiveCustomers++ ?></td>
                                                                <td><?= $activeCustomer["username"] ?></td>
                                                                <td><?= $activeCustomer["email"] ?></td>
                                                                <td><?= $activeCustomer["no_tlp"] ?></td>
                                                                <td><?= $activeCustomer["address"] ?></td>
                                                                <td><?= $activeCustomer["created_at"] ?></td>
                                                                <td>
                                                                    <span class="badge bg-success">Aktif</span>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            <?php } ?>
                                        </div>
                                        <div class="tab-pane fade mt-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <?php if(empty($inActiveCustomers)) { ?>
                                                <div class="alert alert-danger">Semua pelanggan sudah terverifikasi</div>
                                            <?php } else { ?>
                                                <table class="table table-striped" id="table1">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Email</th>
                                                            <th>Telepon</th>
                                                            <th>Alamat</th>
                                                            <th>Tanggal Bergabung</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $noInActiveCustomers = 1;
                                                            foreach($inActiveCustomers as $inActiveCustomer) {
                                                        ?>
                                                            <tr>
                                                                <td><?= $noInActiveCustomers++ ?></td>
                                                                <td><?= $inActiveCustomer["username"] ?></td>
                                                                <td><?= $inActiveCustomer["email"] ?></td>
                                                                <td><?= $inActiveCustomer["no_tlp"] ?></td>
                                                                <td><?= $inActiveCustomer["address"] ?></td>
                                                                <td><?= $inActiveCustomer["created_at"] ?></td>
                                                                <td>
                                                                    <span class="badge bg-danger">Tidak Aktif</span>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            <?php } ?>
                                        </div>
                                        <div class="tab-pane fade mt-4" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                            <?php if(empty($deletedCustomers)) { ?>
                                                <div class="alert alert-danger">Tidak ada akun pelanggan yang dihapus</div>
                                            <?php } else { ?>
                                                <table class="table table-striped" id="table1">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Email</th>
                                                            <th>Telepon</th>
                                                            <th>Alamat</th>
                                                            <th>Tanggal Bergabung</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $noDeletedCustomers = 1;
                                                            foreach($deletedCustomers as $deletedCustomer) {
                                                        ?>
                                                            <tr>
                                                                <td><?= $noDeletedCustomers++ ?></td>
                                                                <td><?= $deletedCustomer["username"] ?></td>
                                                                <td><?= $deletedCustomer["email"] ?></td>
                                                                <td><?= $deletedCustomer["no_tlp"] ?></td>
                                                                <td><?= $deletedCustomer["address"] ?></td>
                                                                <td><?= $deletedCustomer["created_at"] ?></td>
                                                                <td>
                                                                    <span class="badge bg-danger">Mati</span>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                    </div>

                </section>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>