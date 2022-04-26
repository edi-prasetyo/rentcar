<div class="card">
    <div class="card-header">
        <?php echo $title; ?>
    </div>
    <div class="card-body">
        <?php
        //Form Open
        echo form_open(base_url('admin/page/update/' . $page->id));
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Judul Halaman</label>

            <div class="col-lg-9">
                <input type="text" class="form-control" name="page_title" value="<?php echo $page->page_title; ?>">
                <?php echo form_error('page_title', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Deskripsi Halaman <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <textarea class="form-control" id="summernote" name="page_desc"><?php echo $page->page_desc; ?></textarea>
                <?php echo form_error('page_desc', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3"></label>
            <div class="col-lg-9">
                <input type="submit" class="btn btn-primary" name="submit" value="Update Data">
            </div>
        </div>


        <?php
        //Form Close
        echo form_close();
        ?>

    </div>
</div>