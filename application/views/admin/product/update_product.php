<div class="col-md-7">
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
            echo form_open_multipart('admin/product/update/' . $product->id);
            ?>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Nama Produk
                </label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="product_name" placeholder="Nama Produk" value="<?php echo $product->product_name; ?>">
                    <?php echo form_error('product_name', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Status Product <span class="text-danger">*</span>
                </label>
                <div class="col-lg-9">
                    <select name="product_status" class="form-control form-control-chosen select2_demo_1">
                        <option value="1">Aktif</option>
                        <option value="0" <?php if ($product->product_status == "0") {
                                                echo "selected";
                                            } ?>>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Ganti Gambar <span class="text-danger">*</span>
                </label>
                <div class="col-lg-5">
                    <div class="input-group mb-3">
                        <input type="file" name="image">
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php if ($product->image == null) : ?>
                    <?php else : ?>
                        <img class="img-fluid" src="<?php echo base_url('assets/img/galery/' . $product->image); ?>">
                    <?php endif; ?>
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

            <?php echo form_close() ?>

        </div>
    </div>
</div>