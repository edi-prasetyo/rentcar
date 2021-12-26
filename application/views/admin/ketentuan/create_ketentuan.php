<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?php echo $title; ?>
    </div>
    <div class="card-body">


        <div class="text-center">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
        echo form_open('admin/ketentuan/create');
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama Ketentuan <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="ketentuan_name" placeholder="Nama Ketentuan">
                <?php echo form_error('ketentuan_name', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Deskripsi <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <textarea class="form-control" name="ketentuan_desc" id="summernote" placeholder="Deskripsi.."></textarea>
                <?php echo form_error('ketentuan_desc', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Create
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>