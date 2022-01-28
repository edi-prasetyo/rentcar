<?php
$meta = $this->meta_model->get_meta();
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
    <div class="row">
        <div class="col-md-9 mb-3">
            <div class="card shadow-none border text-center">
                <div class="card-header bg-white">
                    Detail Top Up Anda
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <address>
                            <strong><?php echo $topup->name; ?> </strong> <br>
                            Phone : <?php echo $topup->user_phone; ?> <br>
                            Email : <?php echo $topup->email; ?>
                        </address>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <b>Kode Topup #<?php echo $topup->code_topup; ?></b><br>
                        <br>
                        <b>Status :</b>
                        <?php if ($topup->status_bayar == "Pending") : ?>
                            <span class="badge badge-warning badge-pill"> <?php echo $topup->status_bayar; ?></span>
                        <?php elseif ($topup->status_bayar == "Decline") : ?>
                            <span class="badge badge-danger badge-pill"> <?php echo $topup->status_bayar; ?></span>
                        <?php else : ?>
                            <span class="badge badge-success badge-pill"> <?php echo $topup->status_bayar; ?></span>
                        <?php endif; ?>

                    </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- Table row -->

                <div class="col-xs-12 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode Top Up</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong><?php echo $topup->code_topup; ?></strong></td>
                                <td> <strong> Rp. <?php echo number_format($topup->nominal, 0, ",", "."); ?></strong></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Foto Bukti Transfer
                </div>
                <div class="card-body">
                    <img src="<?php echo base_url('assets/img/struk/' . $topup->foto_struk); ?>" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>