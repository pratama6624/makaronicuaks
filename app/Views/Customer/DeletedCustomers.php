<?= $this->extend('Layouts/TemplateAdmin') ?>
<?= $this->section('content') ?>

<?php
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
                            <h3>Makaroni Cuaks - Pelanggan</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Beranda</li>
                                    <li class="breadcrumb-item" aria-current="page">Pelanggan</li>
                                    <li class="breadcrumb-item active" aria-current="page">Pelanggan Dihapus</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="deleted-tab" data-bs-toggle="tab" href="#deleted" role="tab" aria-controls="deleted" aria-selected="false">
                                                Pelanggan Dihapus &nbsp; <span class="badge bg-<?= $numberOfDeletedCustomers == 0 ? 'danger' : 'success' ?>"><?= $numberOfDeletedCustomers ?></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade active show mt-4" id="deleted" role="tabpanel" aria-labelledby="deleted-tab">
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
                                                            <th>Dihapus</th>
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
                                                                <td><?= $deletedCustomer["deleted_at"] ?></td>
                                                                <td>
                                                                    <span class="badge bg-danger"><?= $deletedCustomer["is_recovery"] == 1 ? "Dalam pemulihan" : "Mati" ?></span>
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