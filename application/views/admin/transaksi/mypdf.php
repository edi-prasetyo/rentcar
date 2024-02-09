<?php $meta = $this->meta_model->get_meta(); ?>

<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        /* background-color: #f2f2f2; */
    }

    #customers tr:hover {
        /* background-color: #ddd; */
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
</style>


<h2><?php echo $meta->title; ?></h2>


<table>
    <tbody>
        <tr>
            <td>
                From
                <address>
                    <strong><?php echo $meta->title; ?></strong><br>
                    <?php echo $meta->alamat; ?><br>
                    Phone: <?php echo $meta->telepon; ?><br>
                    Email: <?php echo $meta->email; ?>
                </address>
            </td>
            <td style="float:right;text-align:right">
                To
                <address>
                    <strong><?php echo $transaksi->passenger_name; ?></strong><br>
                    Alamat Jemput : <?php echo $transaksi->alamat_jemput; ?><br>
                    Kota : <?php echo $transaksi->kota_name; ?><br>
                    Phone: <?php echo $transaksi->passenger_phone; ?><br>
                    Email: <?php echo $transaksi->passenger_email; ?>
                </address>
            </td>
        </tr>
    </tbody>
</table>

<div style="margin-top:15px;">



    <table id="customers">
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

            <!-- Additional Charge -->
            <?php if ($transaksi->order_device == 3) : ?>
                <?php if ($transaksi->fuel_money == 0) : ?>
                <?php else : ?>
                    <tr>

                        <td>BBM </td>
                        <td></td>
                        <td></td>
                        <td>Rp. <?php echo number_format($transaksi->fuel_money, 0, ",", "."); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($transaksi->order_device == 3) : ?>
                <?php if ($transaksi->meal_allowance == 0) : ?>
                <?php else : ?>
                    <tr>

                        <td>Uang Makan </td>
                        <td></td>
                        <td></td>
                        <td>Rp. <?php echo number_format($transaksi->meal_allowance, 0, ",", "."); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($transaksi->order_device == 3) : ?>
                <?php if ($transaksi->accommodation_fee == 0) : ?>
                <?php else : ?>
                    <tr>

                        <td>Uang Inap </td>
                        <td></td>
                        <td></td>
                        <td>Rp. <?php echo number_format($transaksi->accommodation_fee, 0, ",", "."); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>


            <!-- End Additional Charge -->

            <tr>
                <td colspan="2" style="border-bottom: hidden; border-left:hidden"></td>
                <td>Subtotal:</td>
                <td>Rp. <?php echo number_format($transaksi->total_price, 0, ",", "."); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="border-bottom: hidden; border-top: hidden; border-left:hidden"></td>
                <td>Diskon Point</td>
                <td>- <?php echo number_format($transaksi->diskon_point, 0, ",", "."); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="border-bottom: hidden; border-top: hidden; border-left:hidden"></td>
                <td>Diskon Promo</td>
                <td>- <?php echo number_format($transaksi->promo_amount, 0, ",", "."); ?></td>
            </tr>

            <!-- Down Payment -->
            <?php if ($transaksi->order_device == 3) : ?>
                <?php if ($transaksi->down_payment == 0) : ?>
                <?php else : ?>
                    <tr>
                        <td colspan="2" style="border-bottom: hidden; border-top: hidden; border-left:hidden"></td>
                        <td>Uang Muka :</td>
                        <td>Rp. <?php echo number_format($transaksi->down_payment, 0, ",", "."); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>

            <!-- End Down Payment -->
            <tr>
                <td colspan="2" style="border-bottom: hidden; border-top: hidden; border-left:hidden"></td>
                <td>Grand Total:</td>
                <td>Rp. <?php echo number_format($transaksi->grand_total, 0, ",", "."); ?></td>
            </tr>

        </tbody>
    </table>
</div>
<br>
<br>
<div style="margin-top:10px;"></div>
<b>Order ID:</b> <?php echo $transaksi->order_id; ?><br>
<b>Tangga Jemput :</b> <?php echo $transaksi->tanggal_jemput; ?><br>
<b>Jam Jemput :</b> <?php echo $transaksi->jam_jemput; ?><br>
<b>Pembayaran :</b> <?php echo $transaksi->pembayaran; ?><br>
<?php if ($transaksi->driver_id == 0) : ?>
<?php else : ?>
    <b>Driver :</b> <?php echo $transaksi->driver_name; ?><br>
<?php endif; ?>
<b>Status Pembayaran :</b> <?php echo $transaksi->status_pembayaran; ?>
<br>
<br>

<b>Syarat dan Ketentuan:</b><br>
<small>
    <?php echo $transaksi->ketentuan_desc; ?></small>