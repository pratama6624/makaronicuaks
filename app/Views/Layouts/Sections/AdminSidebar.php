                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active ">
                            <a href="<?= base_url("/admin/home") ?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Beranda</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= base_url("/admin/customers") ?>" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Pelanggan</span>
                            </a>
                        </li>
                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Pesanan</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="<?= base_url("/admin/orders") ?>">Daftar Pesanan</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?= base_url("/admin/orders/complete") ?>">Pesanan Selesai</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?= base_url("/admin/order/cancel") ?>">Pesanan Dibatalkan</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= base_url("/admin/products") ?>" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Produk</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="application-checkout.html" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Promosi & Diskon</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="application-checkout.html" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Ulasan & Testimoni</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= base_url("/admin/reports") ?>" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Laporan</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= base_url("/login") ?>" class='sidebar-link'>
                                <i class="bi bi-power"></i>
                                <span>Keluar</span>
                            </a>
                        </li>

                    </ul>
                </div>