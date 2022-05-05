<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>

<div class="container my-3">
    <?php foreach ($transaksi_saya as $data) : ?>
        <a class="text-muted" href="<?php echo base_url('myaccount/detail_transaksi/' . md5($data->id)); ?>">
            <div class="card mb-2 shadow border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            Order ID : <?php echo $data->order_id; ?>
                            <?php echo $data->order_type; ?><br>
                            <?php if ($data->status == 'Pending') : ?>
                                <div class="badge badge-warning"> <?php echo $data->status; ?></div>
                            <?php elseif ($data->status == 'Dikonfirmasi') : ?>
                                <div class="badge badge-info"> <?php echo $data->status; ?></div>
                            <?php else : ?>
                                <div class="badge badge-success"> <?php echo $data->status; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-6 text-right">
                            <b>Rp. <?php echo number_format($data->total_price, 0, ",", "."); ?></b><br>
                            <?php if ($data->status_pembayaran == 'Belum Bayar') : ?>
                                <div class="badge badge-warning"> <?php echo $data->status_pembayaran; ?></div>
                            <?php elseif ($data->status_pembayaran == 'Lunas') : ?>
                                <div class="badge badge-success"> <?php echo $data->status_pembayaran; ?></div>
                            <?php else : ?>
                                <div class="badge badge-danger"> <?php echo $data->status_pembayaran; ?></div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

            </div>
        </a>
    <?php endforeach; ?>


    <div class="pagination col-md-12 text-center">
        <?php if (isset($pagination)) {
            echo $pagination;
        } ?>
    </div>

</div>