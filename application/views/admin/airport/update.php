<div class="row">
    <div class="col-md-7">
        <div class="card mb-4">
            <div class="card-header py-3">
                <?php echo $title; ?>
            </div>
            <div class="card-body">


                <div class="text-center">
                    <?php

                    if (isset($errors_upload)) {
                        echo '<div class="alert alert-warning">' . $error_upload . '</div>';
                    }
                    ?>
                </div>
                <?php
                echo form_open_multipart('admin/airport/update/' . $airport->id);
                ?>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Nama Bandara <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="airport_name" placeholder="Nama Bandara" value="<?php echo $airport->airport_name; ?>">
                        <?php echo form_error('airport_name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Kode Bandara <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="airport_code" placeholder="Kode Bandara" value="<?php echo $airport->airport_code; ?>">
                        <?php echo form_error('airport_code', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Kota</label>
                    <div class="col-md-9">
                        <select class="form-control custom-select" name="kota_id" value="" required>
                            <option value="">-- Pilih Kota --</option>
                            <?php foreach ($listkota as $data) : ?>
                                <option value='<?php echo $data->id; ?>' <?php if ($data->id == $airport->kota_id) {
                                                                                echo "selected";
                                                                            }; ?>><?php echo $data->kota_name; ?></option>
                            <?php endforeach; ?>

                        </select>
                        <div class="invalid-feedback">Silahkan Pilih Ketentuan.</div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Publish
                        </button>
                    </div>
                </div>

                <?php echo form_close() ?>



            </div>
        </div>
    </div>


</div>