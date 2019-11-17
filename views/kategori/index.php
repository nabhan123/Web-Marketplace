<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="bd-example">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?= base_url('assets/img/Profile/buy.png') ?>" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">

                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('assets/img/Profile/1.png') ?>" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">

                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="row text-center mt-4 mb-4">

        <?php foreach ($barang as $brg) : ?>

            <div class="card ml-3 mb-3" style="width: 16rem;">
                <img src="<?= base_url('assets/img/Profile/') . $brg->gambar ?>" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title mb-1"><?= $brg->nama_brg ?></h5>
                    <small><?= $brg->keterangan ?></small><br>
                    <span class="badge badge-pill badge-success mb-1">Rp. <?= number_format($brg->harga, 0, ',', '.') ?></span>
                    <?= anchor('User/tambah_keranjang/' . $brg->id, '<div class="btn btn-sm btn-primary mb-3">Tambah ke Keranjang</div>'); ?>
                    <a href="#" class="btn btn-sm btn-warning mb-1">Detail</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>