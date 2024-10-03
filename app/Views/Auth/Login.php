<?= $this->extend('Layouts/TemplateUser') ?>
<?= $this->section('content') ?>

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
                    </div>
                    <form method="post" name="contact-us" action="">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Kata sandi">
                            </div>
                            <div class="col-md-12 form-group mt-4">
                                <a href="<?= base_url("/register") ?>">Belum punya akun, Daftar sekarang!</a>
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
