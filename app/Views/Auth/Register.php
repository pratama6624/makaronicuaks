<?= $this->extend('Layouts/TemplateUser') ?>
<?= $this->section('content') ?>

<?php $session = session()->getFlashdata('validation') ?>

<div id="canvas-overlay"></div>
	<div class="boxed-page">
	
    <?= $this->include('Layouts/Sections/Nav') ?>
	
 <!-- Register Section -->
<section id="gtco-reservation" class="bg-fixed bg-white section-padding overlay" style="background-image: url(img/reservation-bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-content bg-white p-5 shadow">
                    <div class="heading-section text-center">
                        <h2>
                            Mulai Bergabung
                        </h2>
                    </div>
                    <form method="POST" name="contact-us" action="/register/save">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <?php if(isset($session["username"]) && $session["username"] != null) : ?>
                                    <b><span class="flashdata" style="color: red;"><?= $session["username"] ?></span></b>
                                <?php endif ?>
                                <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>" placeholder="Nama">
                            </div>
                            <div class="col-md-12 form-group">
                                <?php if(isset($session["email"]) && $session["email"] != null) : ?>
                                    <b><span class="flashdata" style="color: red;"><?= $session["email"] ?></span></b>
                                <?php endif ?>
                                <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" placeholder="Email">
                            </div>
                            <div class="col-md-12 form-group">
                                <?php if(isset($session["no_tlp"]) && $session["no_tlp"] != null) : ?>
                                    <b><span class="flashdata" style="color: red;"><?= $session["no_tlp"] ?></span></b>
                                <?php endif ?>
                                <input type="number" class="form-control" id="no_tlp" name="no_tlp" value="<?= old('no-tlp') ?>" placeholder="Nomor telepon">
                            </div>
                            <div class="col-md-12 form-group">
                                <?php if(isset($session["address"]) && $session["address"] != null) : ?>
                                    <b><span class="flashdata" style="color: red;"><?= $session["address"] ?></span></b>
                                <?php endif ?>
                                <input type="text" class="form-control" id="address" name="address" value="<?= old('address') ?>" placeholder="Alamat">
                            </div>
                            <div class="col-md-12 form-group">
                                <?php if(isset($session["password"]) && $session["password"] != null) : ?>
                                    <b><span class="flashdata" style="color: red;"><?= $session["password"] ?></span></b>
                                <?php endif ?>
                                <input type="password" class="form-control" id="password" name="password" value="<?= old('password') ?>" placeholder="Kata Sandi">
                            </div>
                            <div class="col-md-12 form-group">
                                <?php if(isset($session["confirm_password"]) && $session["confirm_password"] != null) : ?>
                                    <b><span class="flashdata" style="color: red;"><?= $session["confirm_password"] ?></span></b>
                                <?php endif ?>
                                <input type="password" class="form-control" id="confirm_password" value="<?= old('confirm_password') ?>" name="confirm_password" placeholder="Konfirmasa Kata Sandi">
                            </div>
                            <div class="col-md-12 form-group mt-4">
                                <b><a style="color: black" href="<?= base_url("/login") ?>">Sudah punya akun, Masuk sekarang!</a></b>
                            </div>
                            <div class="col-md-12 text-center mt-4">
                                <button class="btn btn-primary btn-shadow btn-lg" type="submit" name="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</section>
<!-- End of Register Section -->		

<?= $this->include('Layouts/Sections/Footer') ?>

</div>
</div>

<?= $this->endSection() ?>
