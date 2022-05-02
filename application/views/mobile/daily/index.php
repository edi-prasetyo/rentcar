<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>

<div class="container my-2">
    <?php echo form_open('daily/kendaraan/' . md5($kota_id), array('method' => 'get', 'class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>


    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Pilih Kota</label>
            <select class="form-control form-control-lg" name="kota_id">
                <?php foreach ($kota as $data) : ?>
                    <option value="<?php echo md5($data->id); ?>"><?php echo $data->kota_name; ?></option>
                <?php endforeach; ?>
            </select>
            <span class="select-arrow"></span>
        </div>
    </div>

    <div class="col-md-3">
        <label class="form-label">Tanggal Jemput </label>
        <input type="text" name="tanggal_sewa" class="form-control form-control-lg" placeholder="Tanggal" id="id_tanggal" required>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Jam Jemput </label>
            <select class="form-control form-control-lg" name="jam_sewa" value="" required>
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
    <div class="col-md-3 mt-4">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Cari Mobil</button>
    </div>


    <?php echo form_close(); ?>
</div>