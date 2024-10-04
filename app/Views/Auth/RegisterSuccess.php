<?= $this->extend('Layouts/TemplateUser') ?>
<?= $this->section('content') ?>

<div id="canvas-overlay"></div>
	<div class="boxed-page">
	
    <?= $this->include('Layouts/Sections/Nav') ?>

    <!-- Menu Section -->
    <section id="gtco-menu" class="section-padding">
        <div class="container">
            <div class="section-content">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="heading-section text-center">
                            <h2>
                                Berhasil
                            </h2>
                            <a href="https://accounts.google.com/AddSession/signinchooser?hl=en&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&service=mail&ec=GAlAFw&authuser=0&ddm=1&flowName=GlifWebSignIn&flowEntry=AddSession" class="btn btn-primary mt-3">Verifikasi Email</a>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    
                </div>
            </div>
        </div>
    </section>
    <!-- End of menu Section -->

    <?= $this->include('Layouts/Sections/Footer') ?>

</div>
</div>

<?= $this->endSection() ?>