<div class="row">

  <div class="col-md-8">

    <div class="card">
      <div class="card-body">

        <?php
        //Error warning
        echo validation_errors('<div class="alert alert-warning">', '</div>');
        //Error Upload Gabar
        if (isset($error_upload)) {
          echo '<div class="alert alert-warning">' . $error_upload . '</div>';
        }

        echo form_open_multipart('admin/mobil/create', array('class' => 'needs-validation', 'novalidate' => 'novalidate'));
        ?>
        <div class="row">
          <div class="col-md-3">
            <label>Upload Gambar</label>
          </div>
          <div class="col-md-9">
            <div class="form-group">

              <input type="file" name="mobil_gambar" required>
              <div class="invalid-feedback">Silahkan Pilih Gambar.</div>
            </div>
          </div>
          <div class="col-md-3">
            <label>Nama Mobil</label>
          </div>
          <div class="col-md-9">
            <div class="form-group form-group-lg">
              <input type="text" name="mobil_name" class="form-control" placeholder="Nama Mobil" value="<?php echo set_value('mobil_name') ?>" required>
              <div class="invalid-feedback">Silahkan masukan nama Mobil.</div>
            </div>
          </div>

          <div class="col-md-3">
            <label>Kapasitas Penumpang</label>
          </div>
          <div class="col-md-9">
            <div class="form-group form-group-lg">
              <input type="text" name="mobil_penumpang" class="form-control" placeholder="Kapasitas Penumpang" value="<?php echo set_value('mobil_penumpang') ?>" required>
              <div class="invalid-feedback">Silahkan masukan Kapasitas Penumpang.</div>
            </div>
          </div>

          <div class="col-md-3">
            <label>Kapasitas Bagasi</label>
          </div>
          <div class="col-md-9">
            <div class="form-group form-group-lg">
              <input type="text" name="mobil_bagasi" class="form-control" placeholder="Kapasitas Bagasi" value="<?php echo set_value('mobil_bagasi') ?>" required>
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
                <option value="Aktif">Aktif</option>
                <option value="Nonaktif">Nonaktif</option>
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

      </div>
    </div>
  </div>
</div>