<?= $this->extend('Layouts/TemplateUser') ?>
<?= $this->section('content') ?>

<?php
    $sessionValidator = session()->getFlashdata('errors');
    $sessionError = session()->getFlashdata('error');
    $sessionSuccess = session()->getFlashdata('success');
?>

<div id="canvas-overlay"></div>
	<div class="boxed-page">
	
    <?= $this->include('Layouts/Sections/Nav') ?>
	
 <!-- Login Section -->
<section id="gtco-reservation" class="bg-fixed bg-white section-padding overlay mb-5" style="background-image: url(img/reservation-bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-content bg-white p-5 shadow">
                    <div class="heading-section text-center">
                        <h2>
                            Selamat Datang
                        </h2>
                        <?php if(isset($sessionError) && $sessionError != null) : ?>
                            <b><span class="flashdata" style="color: red;"><?= $sessionError ?></span></b>
                        <?php endif ?>
                        <?php if(isset($sessionSuccess) && $sessionSuccess != null) : ?>
                            <b><span class="flashdata" style="color: green;"><?= $sessionSuccess ?></span></b>
                        <?php endif ?>
                    </div>
                    <form method="POST" name="contact-us" action="/login/checkLogin">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <?php if(isset($sessionValidator["email"]) && $sessionValidator["email"] != null) : ?>
                                    <b><span class="flashdata" style="color: red;"><?= $sessionValidator["email"] ?></span></b>
                                <?php endif ?>
                                <input type="email" class="form-control" id="email" name="email" value="<?= old('email')?>" placeholder="Email">
                            </div>
                            <div class="col-md-12 form-group">
                                <?php if(isset($sessionValidator["password"]) && $sessionValidator["password"] != null) : ?>
                                    <b><span class="flashdata" style="color: red;"><?= $sessionValidator["password"] ?></span></b>
                                <?php endif ?>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Kata sandi">
                            </div>
                            <div class="col-md-12 form-group mt-4">
                                <b><a style="color: black" href="<?= base_url("/register") ?>">Belum punya akun, Daftar sekarang!</a></b>
                            </div>
                            <div class="col-md-12 text-center mt-4">
                                <button class="btn btn-primary btn-shadow btn-lg" type="submit" name="submit">Masuk</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</section>
<!-- End of Login Section -->		

<?= $this->include('Layouts/Sections/Footer') ?>

</div>
</div>

<?= $this->endSection() ?>
