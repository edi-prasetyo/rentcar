<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>
<div class="container my-3 ">
    <div class="card shadow border-0">
        <div class="card-body text-center">
            <img src="<?php echo base_url('assets/img/mobil/' . $mobil->mobil_gambar); ?>" class="img-fluid" style="padding-top:-50px" alt="...">
            <h4><?php echo $mobil->mobil_name; ?></h4>
            <i class="fa fa-user"></i> <?php echo $mobil->mobil_penumpang; ?> <i class="fa fa-briefcase ml-3"></i> <?php echo $mobil->mobil_bagasi; ?>
        </div>
    </div>
</div>

<div class="container my-3">
    <div class="row">
        <div class="col-6">
            <h4><?php echo $kota->kota_name; ?></h4>
        </div>
        <div class="col-6">
            <p><?php echo $tanggal_sewa; ?>
                <?php echo $jam_sewa; ?> </p>
        </div>
    </div>

    <div class="mb-5 pb-5">
        <?php foreach ($paket as $data) : ?>
            <div class="card mb-3 shadow border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h6><?php echo $data->paket_name; ?></h6>
                            <i class="fas fa-check-circle text-success"></i> <?php echo number_format($data->paket_point, 0, ",", "."); ?> Point
                        </div>
                        <div class="col-6">
                            <h5>Rp. <?php echo number_format($data->paket_price, 0, ",", "."); ?></h5>
                            <?php echo form_open('daily/order/', array('method' => 'get')); ?>
                            <input type="hidden" name="paket_id" value="<?php echo $data->id; ?>">
                            <input type="hidden" name="tanggal_sewa" value="<?php echo $tanggal_sewa; ?>">
                            <input type="hidden" name="jam_sewa" value="<?php echo $jam_sewa; ?>">
                            <input type="hidden" name="kota_name" value="<?php echo $kota->kota_name; ?>">
                            <input type="hidden" name="kota_id" value="<?php echo $kota->id; ?>">
                            <input type="hidden" name="mobil_name" value="<?php echo $mobil->mobil_name; ?>">
                            <input type="hidden" name="mobil_id" value="<?php echo $mobil->id; ?>">
                            <button type="submit" class="btn btn-sm btn-primary btn-block">Pilih</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>