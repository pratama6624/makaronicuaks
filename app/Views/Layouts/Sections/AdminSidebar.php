                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li
                            class="sidebar-item <?= $sideMenuTitle == "home" || $sideMenuTitle == "flash_info" ? 'active' : '' ?>">
                            <a href="<?= base_url("/admin/home") ?>" class='sidebar-link'>
                                <i class="bi bi-house-fill"></i>
                                <span>Beranda</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= $sideMenuTitle == "customers" ? 'active' : '' ?>">
                            <a href="<?= base_url("/admin/customers") ?>" class='sidebar-link'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                                <span>Pelanggan</span>
                            </a>
                        </li>
                        <li
                            class="sidebar-item <?= $sideMenuTitle == "list" || $sideMenuTitle == "complete" || $sideMenuTitle == "cancel" ? 'active' : '' ?> has-sub">
                            <a href="#" class='sidebar-link'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                                </svg>
                                <span>Pesanan</span>
                            </a>
                            <ul class="submenu"
                                style="display:  <?= $sideMenuTitle == "list" || $sideMenuTitle == "complete" || $sideMenuTitle == "cancel" ? 'block' : 'none' ?>">
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

                        <li
                            class="sidebar-item <?= $sideMenuTitle == "products" || $sideMenuTitle == "product_lists" ? 'active' : '' ?>">
                            <a href="<?= base_url("/admin/products") ?>" class='sidebar-link'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-box-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z" />
                                </svg>
                                <span>Produk</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item <?= $sideMenuTitle == "discount_event" || $sideMenuTitle == "add_discount_event" || $sideMenuTitle == "discount" ? 'active' : '' ?> has-sub">
                            <a href="#" class='sidebar-link'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-tags-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                                    <path
                                        d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043z" />
                                </svg>
                                <span>Promosi & Diskon</span>
                            </a>
                            <ul class="submenu"
                                style="display:  <?= $sideMenuTitle == "discount_event" || $sideMenuTitle == "add_discount_event" || $sideMenuTitle == "discount" ? 'block' : 'none' ?>">
                                <li class="submenu-item <?= $sideMenuTitle == "list" ? 'active' : '' ?>">
                                    <a href="<?= base_url("/admin/discount_event") ?>">Diskon Event</a>
                                </li>
                                <li class="submenu-item <?= $sideMenuTitle == "complete" ? 'active' : '' ?>">
                                    <a href="<?= base_url("/admin/discount") ?>">Diskon Mandiri</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item <?= $sideMenuTitle == "review" ? 'active' : '' ?>">
                            <a href="<?= base_url("/admin/review") ?>" class='sidebar-link'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                </svg>
                                <span>Ulasan & Testimoni</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= $sideMenuTitle == "reports" ? 'active' : '' ?>">
                            <a href="<?= base_url("/admin/reports") ?>" class='sidebar-link'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-bar-chart-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1z" />
                                </svg>
                                <span>Laporan</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= $sideMenuTitle == "setting" ? 'active' : '' ?>">
                            <a href="<?= base_url("/admin/reports") ?>" class='sidebar-link'>
                                <i class="bi bi-gear-fill"></i>
                                <span>Pengaturan</span>
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