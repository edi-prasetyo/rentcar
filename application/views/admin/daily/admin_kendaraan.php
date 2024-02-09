<h3><?php echo $kota_name;
    ?></h3>
<p><?php echo $tanggal_sewa; ?> <?php echo $jam_sewa; ?> </p>
<div class="row">

    <?php foreach ($paket_sewa as $data) : ?>
        <?php if ($data->mobil_gambar == null) : ?>
        <?php else : ?>
            <div class="col-md-2 col-6 my-2">
                <div class="card">
                    <img src="<?php echo base_url('assets/img/mobil/' . $data->mobil_gambar); ?>" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h4><?php echo $data->mobil_name; ?></h4>
                        <i class="fa fa-user"></i> <?php echo $data->mobil_penumpang; ?> <i class="fa fa-briefcase ml-3"></i> <?php echo $data->mobil_bagasi; ?>
                        <?php echo form_open('admin/admindaily/paket/' . $kota_id . '/' . md5($data->mobil_id), array('method' => 'get')); ?>
                        <input type="hidden" name="tanggal_sewa" value="<?php echo $tanggal_sewa; ?>">
                        <input type="hidden" name="jam_sewa" value="<?php echo $jam_sewa; ?>">
                        <button type="submit" class="btn btn-sm btn-primary btn-block">Pilih</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>

            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div> <!-- row.// -->