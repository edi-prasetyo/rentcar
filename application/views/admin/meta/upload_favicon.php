<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?php echo $title; ?>
    </div>
    <div class="card-body">



        <?php

        //Notifikasi
        if ($this->session->flashdata('sukses')) {
            echo '<div class="alert alert-success custom-alert">';
            echo $this->session->flashdata('sukses');
            echo '</div>';
        }
        //Error upload
        if (isset($error)) {
            echo '<div class="alert alert-danger">';
            echo $error;
            echo '</div>';
        }

        //Error warning
        echo validation_errors('<div class="alert alert-warning">', '</div>');
        //Error Upload Gabar
        if (isset($error_upload)) {
            echo '<div class="alert alert-warning">' . $errors_upload . '</div>';
        }

        // Form Open
        echo form_open_multipart(base_url('admin/meta/favicon/' . $meta->id));
        ?>
        <input type="hidden" name="id" value="<?php echo $meta->id ?>">
        <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id'); ?>">

        <div class="row">
            <div class="col-md-4">

                <div class="form-group">
                    <label>Upload Favicon Website</label><br>
                    <input type="file" name="favicon" required="required">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-lg" value="Upload Favicon">
                </div>

            </div>

            <div class="col-md-2">
                Favicon Saat Ini<br>
                <?php if ($meta->favicon != "") { ?>
                    <img src="<?php echo base_url('assets/img/logo/' . $meta->favicon) ?>" class="img-fluid">
                <?php } else { ?>
                    <p class="alert alert-warning text-center">Anda Belum Memiliki Favicon</p>
                <?php } ?>


            </div>
        </div>

        <?php
        //Form Close
        echo form_close();
        ?>

    </div>
</div>