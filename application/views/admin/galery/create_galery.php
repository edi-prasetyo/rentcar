<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?php echo $title; ?>
    </div>
    <div class="card-body">


        <div class="text-center">
            <?php
            echo $this->session->flashdata('message');
            if (isset($error_upload)) {
                echo '<div class="alert alert-warning">' . $error_upload . '</div>';
            }
            ?>
        </div>
        <?php
        echo form_open_multipart('admin/galery/create');
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Judul Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="galery_title" placeholder="Judul Gambar" value="<?php echo set_value('galery_title'); ?>">
                <?php echo form_error('galery_title', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Url Gambar <span class="text-success">(Optional)</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="galery_url" placeholder="Url Gambar" value="<?php echo set_value('galery_url'); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Tipe Galery <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="galery_type" class="form-control form-control-chosen">
                    <option value="Slider">Slider</option>
                    <option value="Halaman">Halaman</option>
                    <option value="Featured">featured</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" name="galery_img">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Deskripsi Gambar <span class="text-success">Optional</span>
            </label>
            <div class="col-lg-9">

                <textarea class="form-control" id="summernote" name="galery_desc" placeholder="Deskripsi Galery"></textarea>
                <?php echo form_error('galery_desc', '<small class="text-danger">', '</small>'); ?>
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