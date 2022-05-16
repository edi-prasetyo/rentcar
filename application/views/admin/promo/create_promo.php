<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?php echo $title; ?>
    </div>
    <div class="card-body">


        <div class="text-center">
            <?php
            echo $this->session->flashdata('message');
            if (isset($errors_upload)) {
                echo '<div class="alert alert-warning">' . $error_upload . '</div>';
            }
            ?>
        </div>
        <?php
        echo form_open_multipart('admin/promo/create');
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama Promo <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="name" placeholder="Nama Promo" value="<?php echo set_value('name'); ?>">
                <?php echo form_error('promo_title', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Status <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="is_active" class="form-control form-control-chosen select2_demo_1">
                    <option value="">Pilih Status</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" name="image">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nominal Promo
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="price" placeholder="Nominal Promo" value="<?php echo set_value('price'); ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Expired
            </label>
            <div class="col-lg-6">
                <input type="date" class="form-control" name="expired_at" placeholder="expired" value="<?php echo set_value('price'); ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Deskripsi <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">

                <textarea class="form-control" id="summernote" name="description" placeholder="Deskripsi Berita"></textarea>
                <?php echo form_error('description', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>


        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Publish Berita
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>