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
                echo form_open('admin/mobil/create_dropoff/' . $mobil->id . '/' . $kota->id);
                ?>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Kota Asal <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="kota_asal" placeholder="Kota Asal" value="<?php echo $kota->kota_name; ?>" readonly>
                        <?php echo form_error('product_name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Kota Tujuan</label>
                    <div class="col-md-9">
                        <select class="form-control custom-select" name="kota_tujuan" value="" required>
                            <option value="">-- Pilih Kota Tujuan --</option>
                            <?php foreach ($listkota as $data) : ?>
                                <option value='<?php echo $data->id; ?>'><?php echo $data->kota_name; ?></option>
                            <?php endforeach; ?>

                        </select>
                        <div class="invalid-feedback">Silahkan Pilih Ketentuan.</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Nama Paket <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="paket_name" placeholder="Nama Paket" value="<?php echo set_value('paket_name'); ?>">
                        <?php echo form_error('paket_name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Ketentuan</label>
                    <div class="col-md-9">
                        <select class="form-control custom-select" name="ketentuan_id" value="" required>
                            <option value="">-- Pilih Ketentuan --</option>
                            <?php foreach ($ketentuan as $ketentuan) : ?>
                                <option value='<?php echo $ketentuan->id; ?>'><?php echo $ketentuan->ketentuan_name; ?></option>
                            <?php endforeach; ?>

                        </select>
                        <div class="invalid-feedback">Silahkan Pilih Ketentuan.</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Harga <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="paket_price" placeholder="Harga Paket" value="<?php echo set_value('paket_price'); ?>">
                        <?php echo form_error('product_name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Point <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="paket_point" placeholder="Point" value="<?php echo set_value('paket_point'); ?>">
                        <?php echo form_error('point', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Batas Pemakaian <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <textarea class="form-control" id="summernote" name="paket_desc" placeholder="Point"><?php echo set_value('paket_desc'); ?></textarea>

                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Status <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <select name="paket_status" class="form-control form-control-chosen select2_demo_1">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>



                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-9">
                        <button type="submit" class="btn btn-primary btn-block">
                            Publish
                        </button>
                    </div>
                </div>

                <?php echo form_close() ?>



            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                List Paket
            </div>
            <span class="mr-3 ml-3">
                <?php echo $this->session->flashdata('message');
                unset($_SESSION['message']); ?>
            </span>

            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Paket</th>
                            <th>Price</th>
                            <th>Point</th>
                            <th width="15%"></th>
                        </tr>
                    </thead>
                    <?php $no = 1;
                    foreach ($dropoff as $paket) { ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $paket->paket_name; ?></td>
                            <td><?php echo $paket->paket_price; ?></td>
                            <td><?php echo $paket->paket_point; ?></td>
                            <td>
                                <a href="<?php echo base_url('admin/mobil/delete_dropoff/' . $paket->id); ?>" class="text-danger"><i class="far fa-times-circle"></i></a>
                                <!-- <a href="<?php //echo base_url('admin/mobil/update_paket/' . $data->id); 
                                                ?>" class="text-danger"><i class="far fa-times-circle"></i></a> -->

                                <?php include "update_paket.php";
                                ?>
                            </td>
                        </tr>

                    <?php $no++;
                    }; ?>
                </table>
            </div>
        </div>
    </div>
</div>