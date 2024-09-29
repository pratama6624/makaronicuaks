<?= $this->extend('Layouts/TemplateUser') ?>
<?= $this->section('content') ?>

<div id="canvas-overlay"></div>
	<div class="boxed-page">

    <?= $this->include('Layouts/Sections/Nav') ?>

    <?= $this->include('Components/About') ?>

    <?= $this->include('Layouts/Sections/Footer') ?>

</div>
</div>

<?= $this->endSection() ?>