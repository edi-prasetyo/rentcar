<?php
//Error warning
echo validation_errors('<div class="alert alert-warning">', '</div>');
//Error Upload Gabar
if (isset($error_upload)) {
  echo '<div class="alert alert-warning">' . $error_upload . '</div>';
}


// Form Open
echo form_open_multipart(base_url('admin/mobil/update/' . $mobil->id));
?>

<div class="row">
  <div class="col-md-3">
    <label>Upload Gambar</label>
  </div>
  <div class="col-md-9">
    <div class="form-group">

      <input type="file" name="mobil_gambar"><br>
      <img src="<?php echo base_url('assets/img/mobil/' . $mobil->mobil_gambar); ?>">

      <div class="invalid-feedback">Silahkan Pilih Gambar.</div>
    </div>
  </div>
  <div class="col-md-3">
    <label>Nama Mobil</label>
  </div>
  <div class="col-md-9">
    <div class="form-group form-group-lg">
      <input type="text" name="mobil_name" class="form-control" value="<?php echo $mobil->mobil_name; ?>" required>
      <div class="invalid-feedback">Silahkan masukan nama Mobil.</div>
    </div>
  </div>

  <div class="col-md-3">
    <label>Kapasitas Penumpang</label>
  </div>
  <div class="col-md-9">
    <div class="form-group form-group-lg">
      <input type="text" name="mobil_penumpang" class="form-control" value="<?php echo $mobil->mobil_penumpang; ?>" required>
      <div class="invalid-feedback">Silahkan masukan Kapasitas Penumpang.</div>
    </div>
  </div>

  <div class="col-md-3">
    <label>Kapasitas Bagasi</label>
  </div>
  <div class="col-md-9">
    <div class="form-group form-group-lg">
      <input type="text" name="mobil_bagasi" class="form-control" value="<?php echo $mobil->mobil_bagasi; ?>" required>
      <div class="invalid-feedback">Silahkan masukan Kapasitas Bagasi.</div>
    </div>
  </div>



  <div class="col-md-3">
    <label>Status Mobil</label>
  </div>
  <div class="col-md-9">
    <div class="form-group">
      <select name="mobil_status" class="form-control custom-select" required>
        <option value="">--Status Mobil--</option>
        <option value="Aktif" <?php if ($mobil->mobil_status == 'Aktif') {
                                echo "selected";
                              } ?>>Aktif</option>
        <option value="Nonaktif" <?php if ($mobil->mobil_status == 'Nonaktif') {
                                    echo "selected";
                                  } ?>>Nonaktif</option>
      </select>
      <div class="invalid-feedback">Silahkan Pilih Status Mobil.</div>
    </div>
  </div>

  <div class="col-md-3">
  </div>
  <div class="col-md-9">
    <div class="form-group">
      <button type="submit" name="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Simpan Mobil</button>
    </div>
  </div>
</div>


<?php
//Form close
echo form_close();
?>