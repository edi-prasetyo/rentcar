<a href="#" class="text-success" data-toggle="modal" data-target="#Edit<?php echo $paket_airport->id; ?>">
    <i class="fa fa-edit"></i>
</a>

<div class="modal modal-default fade" id="Edit<?php echo $paket_airport->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <?php
                echo validation_errors('<div class="alert alert-warning">', '</div>');
                echo form_open(base_url('admin/mobil/update_paket_airport/' . $paket_airport->id)); ?>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Nama Paket <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="paket_name" placeholder="Nama Paket" value="<?php echo $paket_airport->paket_name; ?>">
                        <?php echo form_error('product_name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Harga <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="paket_price" placeholder="Harga Paket" value="<?php echo $paket_airport->paket_price; ?>">
                        <?php echo form_error('product_name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Point <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="paket_point" placeholder="Point" value="<?php echo $paket_airport->paket_point; ?>">
                        <?php echo form_error('point', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Batas Pemakaian <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <textarea class="form-control" id="summernote2" name="paket_desc" placeholder="Point"><?php echo $paket_airport->paket_desc; ?></textarea>

                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-9">
                        <button type="submit" class="btn btn-primary btn-block">
                            Update
                        </button>
                    </div>
                </div>
                <?php echo form_close(); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary pull-right" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->