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
    <?php foreach ($my_withdraw as $my_withdraw) : ?>
        <a class="text-muted text-decoration-none" href="<?php echo base_url('driver/withdraw/detail/' . $my_withdraw->id); ?>">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div class="text-left"><i class="ri-calendar-line"></i> <?php echo date('d/m/Y', strtotime($my_withdraw->date_created)); ?>
                        <?php echo date('H:i:s', strtotime($my_withdraw->date_created)); ?></div>

                    <div class="text-right">Code : <?php echo $my_withdraw->code_withdraw; ?> </div>
                </div>

                <div class="card-body">

                    <b>Rp. <?php echo number_format($my_withdraw->nominal_withdraw, 0, ",", "."); ?></b>
                    <br>
                    <?php if ($my_withdraw->status_withdraw == 'Pending') : ?>
                        <div class="badge badge-warning">Pending</div>
                    <?php elseif ($my_withdraw->status_withdraw == 'Process') : ?>
                        <div class="badge badge-info">Proses</div>
                    <?php elseif ($my_withdraw->status_withdraw == 'Decline') : ?>
                        <div class="badge badge-danger">Decline</div>
                    <?php else : ?>
                        <div class="badge badge-success">Selesai</div>

                    <?php endif; ?>

                </div>
            </div>
        </a>

</div>
<?php endforeach; ?>
<ul class="pagination m-0">
    <div class="pagination col-md-12 text-center">
        <?php if (isset($pagination)) {
            echo $pagination;
        } ?>
    </div>
</ul>
</div>