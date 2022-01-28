<?php
$user_id = $this->session->userdata('id');
$user = $this->user_model->user_detail($user_id);
//Notifikasi
if ($this->session->flashdata('message')) {
    echo $this->session->flashdata('message');
    unset($_SESSION['message']);
}
echo validation_errors('<div class="alert alert-warning">', '</div>');
?>

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
    <div class="card bg-info">
        <div class="card-body">
            <div class="inner">
                <h3 class="text-white font-weight-bold">Rp. <?php echo number_format($user->saldo_driver, 0, ",", ","); ?></h3>
                <a class="text-white" href="<?php echo base_url('driver/withdraw/riwayat'); ?>">Riwayat Penarikan Saldo</a>
            </div>
            <div class="icon">
                <i class="fas fa-coins"></i>
            </div>
        </div>
    </div>


    <?php if ($my_withdraw == NULL) : ?>
    <?php else : ?>

        <?php foreach ($my_withdraw as $my_withdraw) : ?>
            <a class="text-muted text-decoration-none" href="<?php echo base_url('driver/withdraw/detail/' . $my_withdraw->id); ?>">
                <div class="card shadow-sm border-0 my-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                Kode Penarikan :<br> <b><?php echo $my_withdraw->code_withdraw; ?></b>
                            </div>
                            <div class="col-6 text-right">
                                Jumlah Penarikan :<br> <b>Rp. <?php echo number_format($my_withdraw->nominal_withdraw, 0, ",", "."); ?></b><br>
                                <span class="badge badge-pill badge-warning badge-pill"> <?php echo $my_withdraw->status_withdraw; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>


    <?php if ($user->saldo_driver > 50000 && $my_withdraw == NULL) : ?>

        <?php echo form_open('driver/withdraw'); ?>
        <input type="hidden" name="keterangan" value="Tarik Saldo">
        <button type="submit" class="btn btn-primary btn-block my-2" href="">Tarik Saldo</button>
        <?php echo form_close(); ?>

    <?php elseif ($my_withdraw) : ?>
        <div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Tidak dapat Melakukan Penarikan!</h5>Maaf Anda tidak dapat melakukan Penarikan Saldo Karena Masih Ada penarikan yang belum di setujui silahkan hubungi admin
        </div>

    <?php else : ?>
        <div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Tidak dapat Melakukan Penarikan!</h5>Maaf Anda tidak dapat melakukan Penarikan Saldo Karena Saldo Belum Mencapai Rp. 50.000
        </div>


    <?php endif; ?>

</div>