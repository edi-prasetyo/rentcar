<?php
$meta = $this->meta_model->get_meta();
$user_id = $this->session->userdata('id');
$user = $this->user_model->user_detail($user_id); ?>

<nav class="site-header sticky-top py-1" style="background-color: transparent;position:absolute">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a class="text-white text-center" href="#" aria-label="Product">
        </a>
    </div>
</nav>


<div class="col-md-7 mx-auto">
    <div class="row">
        <div class="col-md-12">
            <!-- small card -->
            <div class="card bg-info shadow-sm my-3">
                <div class="card-body text-white">
                    <div class="row">
                        <div class="col-8">
                            <h4>Rp. <?php echo number_format($user->saldo_driver, 0, ",", "."); ?></h4>
                            <p>Saldo</p>
                        </div>
                        <div class="col-4">
                            <span style="font-size: 40px;">
                                <i class="ri-wallet-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-7 mx-auto mb-3">
    <button class="btn btn-primary btn-block" onClick="window.location.href=window.location.href"><i class="fa fa-redo-alt mr-3"></i> Refresh Page</button>
</div>

<?php if ($transaksi_driver == Null && $transaksi_driver_onroad == Null) : ?>
    <div class="col-md-7 mx-auto">
        <div class="card">
            <div class="card-body text-center">
                <div class="display-1 text-info">
                    <i class="ri-cactus-line"></i>
                </div>
                <span style="font-weight:bold">Belum dapet Order?</span> <br>
                Sabar dulu ya.. sales lagi cariin order!
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="col-md-7 mx-auto">
        <?php foreach ($transaksi_driver as $data) : ?>

            <?php if ($data->order_type == "Daily" || $data->order_type == "Hourly") : ?>
                <div class="card my-3 shadow border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <?php echo $data->alamat_jemput; ?><br>
                                <?php echo $data->mobil_name; ?><br>
                                <small><?php echo $data->paket_name; ?></small><br>

                                <h3 class="font-weight-bold"> Rp <?php echo number_format($data->total_price, 0, ",", "."); ?> </h3>
                            </div>
                            <div class="col-4">
                                <a href="<?php echo base_url('driver/transaksi/terima/' . $data->id); ?>" class="btn btn-success btn-block">Terima</a>
                                <a href="<?php echo base_url('driver/transaksi/tolak/' . $data->id); ?>" class="btn btn-danger btn-block">Tolak</a>
                            </div>
                        </div>



                    </div>
                </div>
            <?php elseif ($data->order_type == "Drop Off") : ?>
                <div class="card my-2">
                    <div class="card-body">
                        <div class="col-12 mx-auto mb-3">
                            <div class="list-wrapper">
                                <div class="red-line"></div>
                                <div class="list-item-wrapper">
                                    <div class="list-bullet bg-primary"><i class="ri-stop-fill"></i></div>
                                    <div class="list-item">
                                        <div class="list-text"><?php echo $data->origin; ?></div>
                                    </div>
                                </div>

                                <div class="list-item-wrapper">
                                    <div class="list-bullet bg-success"><i class="ri-map-pin-2-fill"></i></div>
                                    <div class="list-item">
                                        <div class="list-text"><?php echo $data->destination; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body text-center">
                            <h3 class="font-weight-bold"> Rp <?php echo number_format($data->total_price, 0, ",", "."); ?> </h3>
                            <span class="text-muted">
                                <?php if ($data->product_id == 1) : ?>
                                    <?php echo $data->jarak; ?> Km</span>
                        <?php else : ?>
                        <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <a href="<?php echo base_url('driver/transaksi/terima/' . $data->id); ?>" class="btn btn-success btn-block">Terima</a>
                            </div>
                            <div class="col-6">
                                <a href="<?php echo base_url('driver/transaksi/tolak/' . $data->id); ?>" class="btn btn-danger btn-block">Tolak</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
            <?php endif; ?>

        <?php endforeach; ?>
    </div>

<?php endif; ?>


<div class="col-md-7 mx-auto">
    <?php foreach ($transaksi_driver_onroad as $data) : ?>
        <div class="card">
            <div class="card-body">

                <span class="font-italic">- Alamat Tujuan -</span> <br>
                <p><?php echo $data->destination; ?></p>


                <a href="https://maps.google.com/?q=<?php echo $data->destination; ?>" class="btn btn-info btn-block">Buka Google Maps</a>

                <div class="card-body text-center">
                    <h3 class="font-weight-bold"> Rp <?php echo number_format($data->total_price, 0, ",", "."); ?> </h3>
                    <span class="text-muted">
                        <?php if ($data->product_id == 1) : ?>
                            <?php echo $data->jarak; ?> Km</span>
                <?php else : ?>
                <?php endif; ?>
                </div>
                <div class="row">

                    <div class="col-12">
                        <a href="<?php echo base_url('driver/transaksi/finish/' . $data->id); ?>" class="btn btn-success btn-block">Selesai</a>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
</div>