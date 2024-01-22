<?php $meta = $this->meta_model->get_meta(); ?>


<style>
    * {
        box-sizing: border-box;
    }

    /* Create two equal columns that floats next to each other */
    .column {
        float: left;
        width: 50%;
        padding: 10px;
        /* Should be removed. Only for demonstration */
    }
</style>



<div class="column">
    From
    <address>
        <strong><?php echo $meta->title; ?></strong><br>
        <?php echo $meta->alamat; ?><br>
        Phone: <?php echo $meta->telepon; ?><br>
        Email: <?php echo $meta->email; ?>
    </address>
</div>
<!-- /.col -->
<div class="column">
    To
    <address>
        <strong><?php echo $transaksi->passenger_name; ?></strong><br>
        Alamat Jemput : <?php echo $transaksi->alamat_jemput; ?><br>
        Kota : <?php echo $transaksi->kota_name; ?><br>
        Phone: <?php echo $transaksi->passenger_phone; ?><br>
        Email: <?php echo $transaksi->passenger_email; ?>
    </address>
</div>
<!-- /.col -->

<!-- /.col -->

<!-- /.row -->

<!-- Table row -->

<div class="col-12 table-responsive">
    <table class="table table-striped" style="border:1px solid grey;width:100%;">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Lama Sewa</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php echo $transaksi->mobil_name; ?> <br>
                    <?php if ($transaksi->order_type == 'daily') : ?>
                        <?php echo $transaksi->paket_name; ?> - <?php echo $transaksi->kota_name; ?>
                    <?php elseif ($transaksi->order_type == 'airport') : ?>
                        <?php echo $transaksi->origin; ?> - <?php echo $transaksi->destination; ?>
                    <?php elseif ($transaksi->product_id == 'dropoff') : ?>
                        <?php echo $transaksi->origin; ?> - <?php echo $transaksi->destination; ?>
                    <?php endif; ?>
                </td>
                <td><?php echo $transaksi->lama_sewa; ?> Hari<br>


                </td>
                <td>Rp. <?php echo number_format($transaksi->start_price, 0, ",", "."); ?></td>
                <td>Rp. <?php echo number_format($transaksi->total_price, 0, ",", "."); ?></td>
            </tr>

        </tbody>
    </table>
</div>
<!-- /.col -->

<!-- /.row -->


<!-- accepted payments column -->
<div class="col-6">

    <b>Syarat dan Ketentuan:</b><br>
    <?php echo $transaksi->ketentuan_desc; ?>
</div>
<!-- /.col -->
<div class="col-6">


    <div class="table-responsive">
        <table class="table">
            <tr>
                <th style="width:50%">Subtotal:</th>
                <td>Rp. <?php echo number_format($transaksi->total_price, 0, ",", "."); ?></td>
            </tr>
            <tr>
                <th>Diskon Point</th>
                <td>- <?php echo number_format($transaksi->diskon_point, 0, ",", "."); ?></td>
            </tr>
            <tr>
                <th>Diskon Promo</th>
                <td>- <?php echo number_format($transaksi->promo_amount, 0, ",", "."); ?></td>
            </tr>
            <tr>
                <th>Total:</th>
                <td>Rp. <?php echo number_format($transaksi->grand_total, 0, ",", "."); ?></td>
            </tr>
        </table>
    </div>
</div>