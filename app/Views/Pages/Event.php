<?= $this->extend('Layouts/TemplateUser') ?>
<?= $this->section('content') ?>

<div id="canvas-overlay"></div>
<div class="boxed-page">

    <?= $this->include('Layouts/Sections/Nav') ?>

    <!-- Menu Section -->
    <section id="gtco-menu" class="section-padding">
        <div class="container">
            <div class="section-content">
                <div class="row" style="margin-bottom: 50px; margin-top: -70px">
                    <div class="col-md-12">
                        <div class="heading-section text-center">
                            <h4>Event</h4>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12 d-flex flex-wrap justify-content-center">
                        <?php foreach($eventData as $event) { ?>
                        <div class="item-event col-lg-3 col-md-6 align-self-center py-4 shadow mx-2 mb-5"
                            style="border-radius: 10px">
                            <h3><span><?= $event["name"] ?></span></h3>
                            <h6><?= date('d M', strtotime($event["start_date"])) ?> - <?= date('d M Y', strtotime($event["end_date"])) ?></h6>
                            <p class="pt-2"></p>
                            <h3 class="special-dishes-price"><?= $event["precentage"] ?>%</h3>
                            <a href="/eventproduct?id=<?= $event["id_discount"] ?>" class="btn-primary mt-3">Jelajahi</a>
                        </div>
                        <?php } ?>
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