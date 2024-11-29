Produk list<?= $this->extend('Layouts/TemplateAdmin') ?>
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
                        <h3>Makaroni Cuaks - Produk</h3>
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
                <div style="background-color: #f2f7ff;" class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <!-- Tombol di sisi kiri -->
                        <a href="/admin/products/add<?= "?return_url=" . urlencode(current_url()); ?>"
                            class="btn btn-primary">Tambah Produk</a>

                        <!-- Tombol di sisi kanan -->
                        <div>
                            <a href="/admin/products"
                                class="btn btn-<?= $sideMenuTitle == "products" ? "primary" : "secondary" ?>">List
                                Gambar</a>
                            &nbsp;
                            <a href="/admin/product_lists"
                                class="btn btn-<?= $sideMenuTitle == "product_lists" ? "primary" : "secondary" ?>">List
                                Detail</a>
                        </div>
                    </div>
                    <div class="" style="margin-top:30px">
                        <section class="section">
                            <div style="background-color: #f2f7ff;" class="card">
                                <section class="section">
                                    <div class="card">
                                        <div class="card-body">
                                            <div
                                                class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                                <div class="dataTable-top">
                                                    <div class="dataTable-search">
                                                        <input class="dataTableProductList-input" name="query"
                                                            placeholder="Nama, deskripsi, kategori & rasa" type="text">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="dataTable-container">
                                                    <!-- Membungkus tabel dalam container dengan scroll -->
                                                    <div style="overflow-x: auto;">
                                                        <table class="table dataTable-table" id="table1">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 5%;">No</th>
                                                                    <th style="width: 15%;">Nama Produk</th>
                                                                    <th style="width: 15%;">Deskripsi</th>
                                                                    <th style="width: 5%;">Kategori</th>
                                                                    <th style="width: 10%;">Rasa</th>
                                                                    <th style="width: 30%;">Harga</th>
                                                                    <th style="width: 10%;">Event</th>
                                                                    <th style="width: 5%;">Potongan</th>
                                                                    <th style="width: 5%;">Stok</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="liveSearchProductDetailList">
                                                                <?php
                                                        $no = 1;
                                                        foreach($productData as $product) :
                                                    ?>
                                                                <tr class="clickable-row"
                                                                    data-id="<?= encrypt($product['id_product']) ?>"
                                                                    onclick="window.location.href='/admin/product/detail/<?= encrypt($product['id_product']) . "?return_url=" . urlencode(current_url()); ?>'">
                                                                    <td><?= $no++ ?></td>
                                                                    <td><?= $product["product_name"] ?></td>
                                                                    <td><?= $product["description"] ?></td>
                                                                    <td><?= $product["category"] ?></td>
                                                                    <td><?= $product["flavor"] ?></td>
                                                                    <td>
                                                                        <?php if($product["discount_status"] == 0 && $product["id_discount"] == null) { ?>
                                                                        <span>Rp
                                                                            <?= number_format($product["price"], 0, ',', '.'); ?></span>
                                                                        <?php } else { ?>
                                                                        <b><s style="color: red"><span>Rp
                                                                                    <?= number_format($product["price"], 0, ',', '.'); ?></span></s></b>
                                                                        <?php } ?>
                                                                        <?php
                                                                            if($product["discount_status"] == 1) {
                                                                                $discountAmount = $product["price"] * ($product["discount_amount"] / 100);
                                                                                $afterDiscount = $product["price"] - $discountAmount;
                                                                            } else if($product["id_discount"] != null) {
                                                                                $discountAmount = $product["price"] * ($product["precentage"] / 100);
                                                                                $afterDiscount = $product["price"] - $discountAmount;
                                                                            }
                                                                        ?>
                                                                        <span><?= $product["discount_status"] == 1 || $product["id_discount"] != null ? "Rp " . number_format($afterDiscount, 0, ',', '.') : ""; ?></span>
                                                                    </td>
                                                                    <td>
                                                                        <?php if($product["id_discount"] != null) { ?>
                                                                        <?= $product["name"] ?>
                                                                        <?php } else if($product["discount_status"] == 1 && $product["discount_note"] != "") { ?>
                                                                        <?= $product["discount_note"] ?>
                                                                        <?php } else { ?>
                                                                        -
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if($product["id_discount"] != null) { ?>
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-danger"><?= $product["precentage"]; ?>%</button>
                                                                        <?php } else if($product["discount_status"] == 1) { ?>
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-danger"><?= $product["discount_amount"]; ?>%</button>
                                                                        <?php } else { ?>
                                                                        -
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td><?= $product["stock"] ?></td>
                                                                </tr>
                                                                <?php endforeach ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="dataTable-bottom">
                                                        <div class="dataTable-info">Showing 1 to 10 of 26 entries</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                </section>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script type="module" src="/js/livesearch_lazyload/utils.js"></script>
<script type="module" src="/js/livesearch_lazyload/livesearch.js"></script>
<script type="module" src="/js/livesearch_lazyload/pages/productlist.js"></script>

<?= $this->endSection() ?>