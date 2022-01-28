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
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <?php if ($saldo->pemasukan == 0) : ?>
                <span class="text-danger"> <i class="ri-indeterminate-circle-line"></i> Rp. <?php echo $saldo->pengeluaran; ?></span>
            <?php elseif ($saldo->pengeluaran == 0) : ?>
                <span class="text-success"> <i class="ri-add-circle-line"></i> Rp. <?php echo $saldo->pemasukan; ?></span>
            <?php else : ?>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <?php echo $saldo->reason; ?>
        </div>
    </div>
</div>