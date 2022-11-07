<div class="bg-primary">
    <div class="container my-2">
        <?php echo form_open('daily/kendaraan/' . md5($kota_id), array('method' => 'get')); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label text-white">Pilih Kota</label>
                    <select class="form-control form-control-chosen" name="kota_id">
                        <?php foreach ($kota as $data) : ?>
                            <option value="<?php echo md5($data->id); ?>"><?php echo $data->kota_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="select-arrow"></span>
                </div>
            </div>

            <div class="col-md-3">
                <label class="form-label text-white">Tanggal Jemput <span class="text-danger">*</span></label>
                <input type="text" name="tanggal_sewa" class="form-control" placeholder="Tanggal" id="id_tanggal" required>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label text-white">Jam Sewa <span class="text-danger">*</span></label>
                    <select class="form-control form-control-chosen" name="jam_sewa" value="" required>
                        <option value="">- Jam Jemput -</option>
                        <option value='05:00'>05:00</option>
                        <option value='05:30'>05:30</option>
                        <option value='06:00'>06:00</option>
                        <option value='06:30'>06:30</option>
                        <option value='06:00'>06:00</option>
                        <option value='06:30'>06:30</option>
                        <option value='07:00'>07:00</option>
                        <option value='07:30'>07:30</option>
                        <option value='08:00'>08:00</option>
                        <option value='08:30'>08:30</option>
                        <option value='09:00'>09:00</option>
                        <option value='09:30'>09:30</option>
                        <option value='10:00'>10:00</option>
                        <option value='10:30'>10:30</option>
                        <option value='11:00'>11:00</option>
                        <option value='11:30'>11:30</option>
                        <option value='12:00'>12:00</option>
                        <option value='12:30'>12:30</option>
                        <option value='13:00'>13:00</option>
                        <option value='13:30'>13:30</option>
                        <option value='14:00'>14:00</option>
                        <option value='14:30'>14:30</option>
                        <option value='15:00'>15:00</option>
                        <option value='15:30'>15:30</option>
                        <option value='16:00'>16:00</option>
                        <option value='16:30'>16:30</option>
                        <option value='17:00'>17:00</option>
                        <option value='17:30'>17:30</option>
                        <option value='18:00'>18:00</option>
                        <option value='18:30'>18:30</option>
                        <option value='19:00'>19:00</option>
                        <option value='19:30'>19:30</option>
                        <option value='20:00'>20:00</option>
                        <option value='20:30'>20:30</option>
                        <option value='21:00'>21:00</option>
                        <option value='21:30'>21:30</option>
                        <option value='22:00'>22:00</option>
                        <option value='22:30'>22:30</option>
                        <option value='23:00'>23:00</option>
                        <option value='23:30'>23:30</option>
                        <option value='00:00'>00:00</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label" style="visibility: hidden;">A</label>
                <button type="submit" class="btn btn-warning btn-block">Cari Mobil</button>
            </div>
        </div>

        <?php echo form_close(); ?>
    </div>
</div>
<div class="container my-5">
    <h3><?php echo $kota_name;
        ?></h3>
    <p><?php echo $tanggal_sewa; ?> <?php echo $jam_sewa; ?> </p>
    <div class="row">

        <?php foreach ($paket_sewa as $data) : ?>
            <?php if ($data->mobil_gambar == null) : ?>
            <?php else : ?>
                <div class="col-md-3 col-6 my-2">
                    <div class="card">
                        <img src="<?php echo base_url('assets/img/mobil/' . $data->mobil_gambar); ?>" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h4><?php echo $data->mobil_name; ?></h4>
                            <i class="fa fa-user"></i> <?php echo $data->mobil_penumpang; ?> <i class="fa fa-briefcase ml-3"></i> <?php echo $data->mobil_bagasi; ?>
                            <?php echo form_open('daily/paket/' . $kota_id . '/' . md5($data->mobil_id), array('method' => 'get')); ?>
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
</div>