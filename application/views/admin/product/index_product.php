<div class="card">
    <div class="card-header bg-white">
        <h3 class="card-title">
            <?php echo $title; ?>
        </h3>
        <div class="card-tools">
            <a class="btn btn-primary" href="<?php echo base_url('admin/product/create'); ?>"> <i class="fa fa-plus"></i> Buat Produk</a>
        </div>

    </div>
    <?php
    //Notifikasi
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
    }
    echo validation_errors('<div class="alert alert-warning">', '</div>');

    ?>

    <div class="table-responsive">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Order Type</th>
                    <th>Harga Awal</th>
                    <th>Harga KM</th>
                    <th width="25%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($product as $product) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $product->product_name; ?></td>
                    <td>Rp. <?php echo number_format($product->start_price, '0', ',', '.'); ?></td>
                    <td>Rp. <?php echo number_format($product->price, '0', ',', '.'); ?></td>
                    <td>
                        <!-- <a href="<?php //echo base_url('product/detail/' . $product->id); 
                                        ?>" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Lihat</a> -->
                        <a href="<?php echo base_url('admin/product/update/' . $product->id); ?>" class="btn btn-success btn-sm"><i class="far fa-edit"></i> Edit</a>
                        <?php include "delete_product.php";
                        ?>
                    </td>
                </tr>

            <?php $no++;
            }; ?>
        </table>
        <hr>
        <div class="pagination col-md-12 text-center">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>

    </div>
</div>