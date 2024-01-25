<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>

<div class="container my-3">

    <div class="row">
        <div class="col-12">
            <h4><?php echo $airport_name;
                ?> - <?php echo $kota_name;
                        ?></h4>
        </div>
        <div class="col-12">
            <p><?php echo $tanggal_sewa; ?> <?php echo $jam_jemput; ?> </p>
        </div>
    </div>


    <div class="mb-5 pb-3">
        <?php foreach ($paket_airport as $data) : ?>
            <?php if ($data->mobil_gambar == null) : ?>
            <?php else : ?>

                <div class="card shadow border-0 mb-3">
                    <div class="row">
                        <div class="col-5 border-right">
                            <div class="card-body">
                                <img src="<?php echo base_url('assets/img/mobil/' . $data->mobil_gambar); ?>" class="card-img-top" alt="...">
                                <div class="text-center"><i class="fa fa-user"></i> <?php echo $data->mobil_penumpang; ?> <i class="fa fa-briefcase ml-3"></i> <?php echo $data->mobil_bagasi; ?></div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="card-body text-center">
                                <h6><?php echo $data->mobil_name; ?></h6>
                                <h4>Rp. <?php echo number_format($data->paket_price, 0, ",", "."); ?></h4>
                                <small> <i class="fas fa-check-circle text-success"></i> <?php echo number_format($data->paket_point, 0, ",", "."); ?> Point </small>
                                <?php echo form_open('airport/order/', array('method' => 'get')); ?>
                                <input type="hidden" name="mobil_name" value="<?php echo $data->mobil_name; ?>">
                                <input type="hidden" name="mobil_id" value="<?php echo $data->mobil_id; ?>">
                                <input type="hidden" name="tanggal_sewa" value="<?php echo $tanggal_sewa; ?>">
                                <input type="hidden" name="jam_jemput" value="<?php echo $jam_jemput; ?>">
                                <input type="hidden" name="airport_id" value="<?php echo $airport_id; ?>">
                                <input type="hidden" name="kota_id" value="<?php echo $kota_id; ?>">
                                <input type="hidden" name="airport_name" value="<?php echo $airport_name; ?>">
                                <input type="hidden" name="kota_name" value="<?php echo $kota_name; ?>">
                                <input type="hidden" name="order_point" value="<?php echo $data->paket_point; ?>">
                                <button type="submit" class="btn btn-sm btn-primary btn-block">Pilih</button>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        <?php endforeach; ?>
    </div>
</div>