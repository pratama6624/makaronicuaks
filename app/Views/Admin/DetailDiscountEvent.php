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
                            <!-- Tombol di sisi kiri -->
                            <a href="/admin/discount_event" class="btn btn-secondary d-flex align-items-center" style="width: 200px;">
                                <i class="bi bi-chevron-left"></i>&nbsp; Detail Event Diskon
                            </a>
                                        
                            <!-- Tombol di sisi kanan -->
                            <div>
                                <a href="" class="btn btn-primary">Edit</a>
                                &nbsp;
                                <a href="" class="btn btn-danger">Hapus</a>
                            </div>
                        </div>
                        <section class="section">
                            
                        </section>
                    </div>
                </section>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>