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
    <h4><?php echo $kota_asal_name;
        ?> - <?php echo $kota_tujuan_name;
                ?> </h4>
    <p><?php echo $tanggal_sewa; ?> <?php echo $jam_sewa; ?> </p>

    <div class="mb-5 pb-3">
        <?php foreach ($paket_dropoff as $data) : ?>
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
                                <h5><?php echo $data->mobil_name; ?></h5>
                                <h4>Rp. <?php echo number_format($data->paket_price, 0, ",", "."); ?></h4>
                                <?php echo form_open('dropoff/order/', array('method' => 'get')); ?>
                                <input type="hidden" name="mobil_name" value="<?php echo $data->mobil_name; ?>">
                                <input type="hidden" name="mobil_id" value="<?php echo $data->mobil_id; ?>">
                                <input type="hidden" name="tanggal_sewa" value="<?php echo $tanggal_sewa; ?>">
                                <input type="hidden" name="jam_sewa" value="<?php echo $jam_sewa; ?>">
                                <input type="hidden" name="kota_asal" value="<?php echo $kota_asal; ?>">
                                <input type="hidden" name="kota_tujuan" value="<?php echo $kota_tujuan; ?>">
                                <input type="hidden" name="kota_asal_name" value="<?php echo $kota_asal_name; ?>">
                                <input type="hidden" name="kota_tujuan_name" value="<?php echo $kota_tujuan_name; ?>">
                                <input type="hidden" name="paket_price" value="<?php echo $paket_price; ?>">
                                <button type="submit" class="btn btn-sm btn-primary btn-block">Pilih</button>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>