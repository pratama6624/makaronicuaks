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
                            Pemulihan Akun
                        </h2>
                    </div>
                    <form method="POST" name="contact-us" action="/recovery">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <?php if(isset($session["email"]) && $session["email"] != null) : ?>
                                    <b><span class="flashdata" style="color: red;"><?= $session["email"] ?></span></b>
                                <?php endif ?>
                                <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" placeholder="Email">
                            </div>
                            <div class="col-md-12 form-group">
                                <?php if(isset($session["reason"]) && $session["reason"] != null) : ?>
                                    <b><span class="flashdata" style="color: red;"><?= $session["reason"] ?></span></b>
                                <?php endif ?>
                                <input type="text" class="form-control" id="reason" name="reason" value="<?= old('reason') ?>" placeholder="Alasan Pemulihan">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="checkbox" id="use-new-password" name="use-new-password" onclick="togglePasswordOptions()">
                                &nbsp;
                                <label for="use-new-password">Gunakan Kata Sandi Baru</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <!-- Alert untuk password reset -->
                                <div id="reset-password-alert" style="display: none">
                                    <p style="color: red;">Link reset password akan dikirim ke email setelah pemulihan akun disetujui.</p>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary btn-shadow btn-lg" disabled id="recoverybutton" type="submit" name="submit">Pulihkan</button>
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
