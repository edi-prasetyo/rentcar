<div class="container my-5">
    <h3><?php echo $kota->kota_name; ?> - <?php echo $mobil->mobil_name; ?></h3>
    <p><?php echo $tanggal_sewa; ?>
        <?php echo $jam_sewa; ?> </p>
    <div class="row">

        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="<?php echo base_url('assets/img/mobil/' . $mobil->mobil_gambar); ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="col-md-8">
                            <h4><?php echo $mobil->mobil_name; ?></h4>
                            <i class="fa fa-user"></i> <?php echo $mobil->mobil_penumpang; ?> <i class="fa fa-briefcase ml-3"></i> <?php echo $mobil->mobil_bagasi; ?>
                        </div>
                    </div>

                    <?php foreach ($paket as $data) : ?>
                        <div class="row border-top py-3">
                            <div class="col-md-7">
                                <h4><?php echo $data->paket_name; ?></h4>
                                <i class="fas fa-check-circle text-success"></i> <?php echo $data->paket_point; ?> Point
                            </div>
                            <div class="col-md-5">
                                <h2>Rp. <?php echo number_format($data->paket_price, 0, ",", "."); ?></h2>
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
                    <?php endforeach; ?>
                </div>
            </div>
        </div>


    </div> <!-- row.// -->

</div>