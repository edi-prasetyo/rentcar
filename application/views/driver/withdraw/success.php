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
    <div class="card">
        <div class="card-header bg-white">Detail</div>
        <div class="card-body">



            <!-- title row -->

            <!-- info row -->
            <div class="row">

                <div class="col-sm-6">
                    <address>
                        <strong><?php echo $last_withdraw->name; ?> </strong> <br>

                        Phone : <?php echo $last_withdraw->user_phone; ?> <br>
                        Email : <?php echo $last_withdraw->email; ?>
                    </address>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <b>Invoice #<?php echo $last_withdraw->code_withdraw; ?></b><br>
                    <br>
                    <b>Status :</b>
                    <?php if ($last_withdraw->status_withdraw == 'Pending') : ?>
                        <span class="badge badge-warning badge-pill"> <?php echo $last_withdraw->status_withdraw; ?></span>
                    <?php else : ?>
                        <span class="badge badge-success badge-pill"> <?php echo $last_withdraw->status_withdraw; ?></span>
                    <?php endif; ?>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- Table row -->
            <div class="row">
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
                                <td><strong><?php echo $last_withdraw->code_withdraw; ?></strong></td>
                                <td> <strong> Rp. <?php echo number_format($last_withdraw->nominal_withdraw, 0, ",", "."); ?></strong></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- /.col -->



                <div class="col-md-6">
                </div>


            </div><!-- /.row -->


        </div>
    </div>
</div>