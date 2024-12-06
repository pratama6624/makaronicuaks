<?= $this->extend('Layouts/TemplateAdmin') ?>
<?= $this->section('content') ?>

<?php
    $numberOfActiveCustomers = count($activeCustomers);
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
                                    <li class="breadcrumb-item active" aria-current="page">Pelanggan Aktif</li>
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
                                            <a class="nav-link active" id="active-tab" data-bs-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">
                                                Pelanggan Aktif &nbsp; <span class="badge bg-<?= $numberOfActiveCustomers == 0 ? 'danger' : 'success' ?>"><?= $numberOfActiveCustomers ?></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade active show mt-4" id="active" role="tabpanel" aria-labelledby="active-tab">
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
                                                            <th>Bergabung</th>
                                                            <th>Status</th>
                                                            <th>Aksi</th>
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
                                                                <td><?= $activeCustomer["status"] == 1 ? "Aktif" : "Belum Aktif" ?></td>
                                                                <td>
                                                                    <button class="btn btn-sm btn-primary">
                                                                        <svg class="svg-inline--fa fa-info fa-w-6 fa-fw select-all" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="info" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg=""><path fill="currentColor" d="M20 424.229h20V279.771H20c-11.046 0-20-8.954-20-20V212c0-11.046 8.954-20 20-20h112c11.046 0 20 8.954 20 20v212.229h20c11.046 0 20 8.954 20 20V492c0 11.046-8.954 20-20 20H20c-11.046 0-20-8.954-20-20v-47.771c0-11.046 8.954-20 20-20zM96 0C56.235 0 24 32.235 24 72s32.235 72 72 72 72-32.235 72-72S135.764 0 96 0z"></path></svg>
                                                                    </button>
                                                                    <button class="btn btn-sm btn-danger">
                                                                        <svg class="svg-inline--fa fa-trash-alt fa-w-14 fa-fw select-all" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path></svg>
                                                                    </button>
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