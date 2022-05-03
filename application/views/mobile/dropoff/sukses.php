<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
$meta           = $this->meta_model->get_meta();
?>

<section class="invoice bg-primary py-5">
    <div class="container">
        <div class="col-md-8 mx-auto">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-white"> ID Order </h6>
                    <h1 class="text-white"><b><?php echo $transaksi->order_id; ?></b></h1>

                </div>
                <div class="col-md-6 text-right">
                    <h6 class="text-white"><b><?php echo $transaksi->alamat_jemput; ?></b></h6>
                    <h6 class="text-white"><b><?php echo $transaksi->passenger_name; ?></b></h6>
                    <h6 class="text-white"><b><?php echo $transaksi->passenger_phone; ?></b></h6>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container my-5">
    <div class="col-md-9 mx-auto">

        <div class="card mb-3" style="margin-top:-90px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        ORDER BERHASIL<br>
                        <?php echo $transaksi->mobil_name; ?><br>
                        <?php echo $transaksi->paket_name; ?><br>
                        Status Penggunaan :
                        <?php if ($transaksi->status == "Pending") : ?>
                            <span class="badge badge-warning"><?php echo $transaksi->status; ?></span>
                        <?php elseif ($transaksi->status == "Dikonfirmasi") : ?>
                            <span class="badge badge-primary"><?php echo $transaksi->status; ?></span>
                        <?php elseif ($transaksi->status == "Selesai") : ?>
                            <span class="badge badge-success"><?php echo $transaksi->status; ?></span>
                        <?php endif; ?>
                        <br>


                    </div>
                    <div class="col-md-6">
                        <div class="text-right"> Total Pembayaran</div>
                        <div class="display-4 text-right">
                            Rp. <b><?php echo number_format($transaksi->grand_total, 0, ",", "."); ?></b>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                Rincian Pesanan

            </li>


            <li class="list-group-item d-flex justify-content-between align-items-center">
                Total Harga
                <span class="font-weight-bold">Rp. <?php echo number_format($transaksi->total_price, 0, ",", "."); ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Diskon Point
                <span class="font-weight-bold"><?php echo number_format($transaksi->diskon_point, 0, ",", "."); ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Grand Total
                <span class="font-weight-bold">Rp. <?php echo number_format($transaksi->grand_total, 0, ",", "."); ?></span>
            </li>
        </ul>
        <?php if ($transaksi->pembayaran == "Cash") : ?>
        <?php else : ?>
            <a class="btn btn-success btn-block" href="<?php echo $transaksi->payment_url; ?>">Bayar</a>
        <?php endif; ?>


        <br>
        <a class="btn btn-primary" href="<?php echo base_url(); ?>">Kembali Ke Home</a>
        <a class="btn btn-success" href="<?php echo base_url('myaccount'); ?>">Halaman Akun Saya</a>
    </div>


</div>