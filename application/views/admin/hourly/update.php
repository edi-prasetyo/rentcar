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
            <div class="col-lg-6">
                <input type="text" class="form-control" name="product_name" placeholder="Nama Produk" value="<?php echo $product->product_name; ?>">
                <?php echo form_error('product_name', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Harga Awal
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="start_price" placeholder="Harga Awal" value="<?php echo $product->start_price; ?>">
                <?php echo form_error('product_price', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Harga KM
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="price" placeholder="Harga km" value="<?php echo $product->price; ?>">
                <?php echo form_error('product_price', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Status Product <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="product_status" class="form-control form-control-chosen select2_demo_1">
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif" <?php if ($product->product_status == "Nonaktif") {
                                                    echo "selected";
                                                } ?>>Nonaktif</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary btn-block">
                    Update
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>