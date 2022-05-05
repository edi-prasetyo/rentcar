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
    <div class="col-md-7 mx-auto">
        <div class="card mb-3">
            <div class="card-body">
                <div class="text-center">
                    <div style="font-size:20px"><i class="fa fa-ticket-alt"></i> Total Point</div>
                    <h2 class="text-success"><?php echo number_format($total_pointku->nominal_point, 0, ",", "."); ?></h2>
                </div>
            </div>
        </div>


        <?php foreach ($point as $data) : ?>

            <div class="card mb-2 shadow border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            Order ID : <b><?php echo $data->order_id; ?></b>
                            <?php $tanggal_sekarang = date("Y-m-d"); ?>
                            <?php if ($data->expired <= $tanggal_sekarang) : ?>
                                <div class="badge badge-danger">Expired</div>
                            <?php elseif ($data->point_status == 0) : ?>
                                <div class="badge badge-danger">Used</div>
                            <?php else : ?>
                                <div class="badge badge-success">Active</div>
                            <?php endif; ?>
                        </div>
                        <div class="col-7 text-right">
                            Point : <b><?php echo number_format($data->nominal_point, 0, ",", "."); ?></b><br>
                            Expired : <br><?php echo date("j F Y", strtotime($data->expired)); ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>