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
                        <h3>Makaroni Cuaks - Beranda</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Beranda</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <section class="section" style="margin-bottom: 15px;>
                    <div class="card">
                        <div class="card-header">
                            <h5>Simple Datatable</h5>
                        </div>
                    </div>
                </section>
                <section class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Penjualan</h6>
                                                <h6 class="font-extrabold mb-0">23</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Pesanan Baru</h6>
                                                <h6 class="font-extrabold mb-0">10</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Stok Menipis</h6>
                                                <h6 class="font-extrabold mb-0">19</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Pengguna Baru</h6>
                                                <h6 class="font-extrabold mb-0">112</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Simple Datatable
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Graiden</td>
                                        <td>vehicula.aliquet@semconsequat.co.uk</td>
                                        <td>076 4820 8838</td>
                                        <td>Offenburg</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dale</td>
                                        <td>fringilla.euismod.enim@quam.ca</td>
                                        <td>0500 527693</td>
                                        <td>New Quay</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nathaniel</td>
                                        <td>mi.Duis@diam.edu</td>
                                        <td>(012165) 76278</td>
                                        <td>Grumo Appula</td>
                                        <td>
                                            <span class="badge bg-danger">Inactive</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Darius</td>
                                        <td>velit@nec.com</td>
                                        <td>0309 690 7871</td>
                                        <td>Ways</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <?= $this->endSection() ?>