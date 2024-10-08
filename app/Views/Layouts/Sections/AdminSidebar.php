                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item <?= $sideMenuTitle == "home" ? 'active' : '' ?>">
                            <a href="<?= base_url("/admin/home") ?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Beranda</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= $sideMenuTitle == "customers" ? 'active' : '' ?>">
                            <a href="<?= base_url("/admin/customers") ?>" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Pelanggan</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?= $sideMenuTitle == "list" || $sideMenuTitle == "complete" || $sideMenuTitle == "cancel" ? 'active' : '' ?> has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Pesanan</span>
                            </a>
                            <ul class="submenu" style="display:  <?= $sideMenuTitle == "list" || $sideMenuTitle == "complete" || $sideMenuTitle == "cancel" ? 'block' : 'none' ?>">
                                <li class="submenu-item <?= $sideMenuTitle == "list" ? 'active' : '' ?>">
                                    <a href="<?= base_url("/admin/orders/list") ?>">Daftar Pesanan</a>
                                </li>
                                <li class="submenu-item <?= $sideMenuTitle == "complete" ? 'active' : '' ?>">
                                    <a href="<?= base_url("/admin/orders/complete") ?>">Pesanan Selesai</a>
                                </li>
                                <li class="submenu-item <?= $sideMenuTitle == "cancel" ? 'active' : '' ?>">
                                    <a href="<?= base_url("/admin/orders/cancel") ?>">Pesanan Dibatalkan</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item <?= $sideMenuTitle == "products" ? 'active' : '' ?>">
                            <a href="<?= base_url("/admin/products") ?>" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Produk</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= $sideMenuTitle == "discount" ? 'active' : '' ?>">
                            <a href="<?= base_url("/admin/discount") ?>" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Promosi & Diskon</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= $sideMenuTitle == "review" ? 'active' : '' ?>">
                            <a href="<?= base_url("/admin/review") ?>" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Ulasan & Testimoni</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= $sideMenuTitle == "reports" ? 'active' : '' ?>">
                            <a href="<?= base_url("/admin/reports") ?>" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Laporan</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="/logout" class='sidebar-link'>
                                <i class="bi bi-power"></i>
                                <span>Keluar</span>
                            </a>
                        </li>

                    </ul>
                </div>