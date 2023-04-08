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
        echo form_open_multipart('admin/berita/update/' . $berita->id);
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Judul Berita <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="berita_title" placeholder="Judul Berita" value="<?php echo $berita->berita_title ?>">
                <?php echo form_error('berita_title', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Kategori <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="category_id" class="form-control form-control-chosen select2_demo_1">
                    <?php foreach ($category as $category) { ?>
                        <option value="<?php echo $category->id ?>" <?php if ($berita->category_id == $category->id) {
                                                                        echo "selected";
                                                                    } ?>>
                            <?php echo $category->category_name ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Status Berita <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="berita_status" class="form-control form-control-chosen select2_demo_1">
                    <option value="Publish">Publish</option>
                    <option value="Draft" <?php if ($berita->berita_status == "Draft") {
                                                echo "selected";
                                            } ?>>Draft</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" name="berita_gambar">
                    <img src="<?php echo base_url('assets/img/artikel/' . $berita->berita_gambar) ?>" width="70%" class="img img-thumbnail">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Deskripsi Berita <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">

                <textarea class="form-control" id="summernote" name="berita_desc" placeholder="Deskripsi Berita"> <?php echo $berita->berita_desc ?></textarea>
                <?php echo form_error('berita_desc', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Keywords
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="berita_keywords" placeholder="Pisahkan dengan koma" value="<?php echo $berita->berita_keywords ?>">
            </div>
        </div>

        <div class=" form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Update Berita
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>