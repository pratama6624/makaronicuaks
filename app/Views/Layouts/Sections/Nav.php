<nav id="navbar-header" class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand navbar-brand-center d-flex align-items-center p-0 only-mobile" href="/">
                    <img src="img/logo.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="lnr lnr-menu"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex justify-content-between">
                        <li class="nav-item only-desktop">
                            <a class="nav-link" id="side-nav-open" href="#">
                                <span class="lnr lnr-menu"></span>
                            </a>
                        </li>
                        <div class="d-flex flex-lg-row flex-column">
                            <li class="nav-item active">
                                <a class="nav-link" href="/"><b>Beranda</b> <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url("/products") ?>"><b>Menu</b></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="margin-right: 15px" href="<?= base_url("/blog") ?>"><b>Blog</b></a>
                            </li>
                        </div>
                    </ul>
                    
                    <a class="navbar-brand navbar-brand-center d-flex align-items-center only-desktop" href="#">
                        <img src="img/logo.png" alt="">
                    </a>
                    <ul class="navbar-nav d-flex justify-content-between">
                        <div class="d-flex flex-lg-row flex-column">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?= base_url("/about") ?>"><b>Tentang</b></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url("/shoppingcart") ?>"><b>Keranjang</b></a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link" href="<?= base_url("/login") ?>"><b>Masuk</b></a>
                            </li>
                        </div>
                        <li class="nav-item">
                            <a id="side-search-open" class="nav-link" href="#">
                                <span class="lnr lnr-magnifier"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>