<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>

<div class="container my-3 pb-5">
    <?php foreach ($topup as $topup) : ?>
        <a href="<?php echo base_url('driver/topup/detail/' . $topup->id); ?>" class="text-muted">
            <div class="card my-2">
                <div class="card-body">
                    <div class="row">

                        <div class="col-7 text-muted">
                            <?php echo date('d/m/Y', strtotime($topup->date_created)); ?> -
                            <?php echo date('H:i:s', strtotime($topup->date_created)); ?><br>
                            <?php //echo $topup->keterangan; 
                            ?>
                            <?php echo $topup->topup_reason; ?>
                        </div>


                        <div class="col-5 text-right">
                            <span class="text-muted"> Rp. <?php echo number_format($topup->nominal, 0, ",", "."); ?></span><br>
                            <?php if ($topup->status_bayar == "Pending") : ?>
                                <span class="text-warning">Pending</span>
                            <?php elseif ($topup->status_bayar == "Success") : ?>
                                <span class="text-success">Success</span>
                            <?php else : ?>
                                <span class="text-danger">Cancel</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </a>

    <?php endforeach; ?>
</div>