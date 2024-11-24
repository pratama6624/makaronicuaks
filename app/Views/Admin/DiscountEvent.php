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
                    <div style="background-color: #f2f7ff;" class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <a href="/admin/add_discount_event" class="btn btn-primary">Buat Event Diskon</a>
                        </div>
                        <section class="section">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                        <div class="dataTable-top">
                                            <div class="dataTable-search">
                                                <input class="dataTable-input" placeholder="Search..." type="text">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="dataTable-container">
                                            <!-- Membungkus tabel dalam container dengan scroll -->
                                            <div style="overflow-x: auto;">
                                                <table class="table dataTable-table" id="table1">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Event</th>
                                                            <th>Deskripsi</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Tanggal Selesai</th>
                                                            <th>Potongan</th>
                                                            <th>Total Produk</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        foreach ($discountEventData as $discountEvent) : ?>
                                                            <tr class="clickable-row" onclick="window.location.href='/admin/discount_event/detail/<?= encrypt($discountEvent['id_discount']) ?>'">
                                                                <td><?= $no++ ?></td>
                                                                <td><?= $discountEvent["name"] ?></td>
                                                                <td><?= $discountEvent["description"] ?></td>
                                                                <td><?= $discountEvent["start_date"] ?></td>
                                                                <td><?= $discountEvent["end_date"] ?></td>
                                                                <td><?= $discountEvent["precentage"] ?>%</td>
                                                                <td>11 Produk</td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="dataTable-bottom">
                                            <div class="dataTable-info">Showing 1 to 10 of 26 entries</div>
                                            <ul class="pagination pagination-primary float-end dataTable-pagination">
                                                <li class="page-item pager"><a href="#" class="page-link" data-page="1">‹</a></li>
                                                <li class="page-item active"><a href="#" class="page-link" data-page="1">1</a></li>
                                                <li class="page-item"><a href="#" class="page-link" data-page="2">2</a></li>
                                                <li class="page-item"><a href="#" class="page-link" data-page="3">3</a></li>
                                                <li class="page-item pager"><a href="#" class="page-link" data-page="2">›</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>