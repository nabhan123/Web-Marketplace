<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">

        <?php foreach ($makanan as $mkn) : ?>
            <div class="col-lg-6">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $mkn->nama_brg ?></h5>
                        <p class="card-text"><?= $mkn->keterangan ?></p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    <?php endforeach; ?>

                    </div>
                </div>
            </div>

    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->