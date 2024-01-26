<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>
<div class="container my-3 mb-5">
    <!-- <div class="row">
        <div class="col-6">
            <a class="btn btn-success btn-block" href="<?php echo base_url('driver/topup'); ?>">Top Up</a>
        </div>
        <div class="col-6">
            <a class="btn btn-info btn-block" href="<?php echo base_url('driver/withdraw'); ?>">Tarik</a>
        </div>
    </div> -->
    <?php foreach ($saldo as $saldo) : ?>
        <a class="text-decoration-none text-muted" href="<?php echo base_url('driver/saldo/detail/' . $saldo->id); ?>">
            <div class="card my-2 shadow-sm border-0">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-6">
                            <i class="ri-calendar-todo-line"></i> <?php echo date('d/m/Y', strtotime($saldo->date_created)); ?>
                        </div>
                        <div class="col-6 text-right">
                            <?php if ($saldo->pengeluaran == 0) : ?>
                                <span class="text-success"> + Rp. <?php echo number_format($saldo->pemasukan, 0, ",", "."); ?></span>
                            <?php else : ?>
                                <span class="text-danger"> - Rp. <?php echo number_format($saldo->pengeluaran, 0, ",", "."); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <?php if ($saldo->pengeluaran == 0) : ?>
                                <i class="ri-arrow-up-s-fill text-success"></i>
                            <?php else : ?>
                                <i class="ri-arrow-down-s-fill text-danger"></i>
                            <?php endif; ?>

                        </div>
                        <div class="col-5">

                            <?php echo $saldo->keterangan; ?>
                        </div>
                        <div class="col-5 text-right">
                            Rp. <?php echo number_format($saldo->total_saldo, 0, ",", "."); ?>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    <?php endforeach; ?>

    <div class="pagination col-md-12 text-center my-3 mb-5">
        <?php if (isset($pagination)) {
            echo $pagination;
        } ?>
    </div>

</div>