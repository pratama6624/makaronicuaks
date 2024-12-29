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
                                <a class="nav-link" style="color: <?= $sideMenuTitle == "" ? "red" : "black" ?>" href="/"><b>Beranda</b> <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: <?= $sideMenuTitle == "products" ? "red" : "black" ?>" href="<?= base_url("/products?filter=recomendation") ?>"><b>Menu</b></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: <?= $sideMenuTitle == "event" || $sideMenuTitle == "eventproduct" ? "red" : "black" ?>" style="margin-right: 15px" href="<?= base_url("/event?filter=terbesar") ?>"><b>Event</b></a>
                            </li>
                        </div>
                    </ul>
                    
                    <a class="navbar-brand navbar-brand-center d-flex align-items-center only-desktop" href="#">
                        <img src="img/logo.png" onclick="window.location.href='<?= base_url('/about') ?>'" alt="">
                    </a>

                    <ul class="navbar-nav d-flex justify-content-between">
                        <div class="d-flex flex-lg-row flex-column">
                            <li class="nav-item">
                                <a class="nav-link" style="color: <?= $sideMenuTitle == "shoppingcart" ? "red" : "black" ?>" href="<?= base_url("/shoppingcart") ?>">
                                    <b>Keranjang</b>
                                    <?php if(session()->has('user') && isset($cartItemCount)) { ?>
                                        <span class="realtime-quantity-cart cart-badge"><?= $cartItemCount ?></span>
                                    <?php } else if(session()->has('cart') != null && count(session()->get('cart')) > 0) { ?>
                                        <span class="realtime-quantity-cart cart-badge"><?= array_sum(session()->get('cart')) ?></span>
                                    <?php } else { ?>
                                        <span class="realtime-quantity-cart cart-badge">0</span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" style="color: <?= $sideMenuTitle == "about" ? "red" : "black" ?>" href="<?= base_url("/about") ?>"><b>Pesanan</b></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" style="color: <?= $sideMenuTitle == "login" ? "red" : "black" ?>" href="<?= base_url(!session()->has('user') ? "/login" : "/logout") ?>"><b><?= !session()->has('user') ? "Masuk" : "Keluar" ?></b></a>
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