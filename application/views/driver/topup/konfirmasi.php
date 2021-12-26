<div class="col-md-8 mx-auto">
    <?php if ($topup->status_bayar == 'Success') : ?>
        <div class="card alert alert-success">
            <div class="card-body text-center">
                Order Anda sudah di konfirmasi<br>
                <a href="<?php echo base_url('topup'); ?>" class="btn btn-info btn-block my-3">Kembali</a>
            </div>
        </div>
    <?php elseif ($topup->status_bayar == 'Process') : ?>
        <div class="card alert alert-success">
            <div class="card-body text-center">
                Order Anda sudah di konfirmasi<br>
                <a href="<?php echo base_url('topup'); ?>" class="btn btn-info btn-block my-3">Kembali</a>
            </div>
        </div>
    <?php else : ?>
        <div class="card">
            <div class="card-header">
                Detail Pembayaran
            </div>
            <div class="card-body">

                Jumlah yang harus di Transfer
                <div class="display-4 font-weight-bold"> Rp. <?php echo number_format($topup->nominal, 0, ",",  "."); ?></div>
                Silahkan Transfer Pembayaran ke Rekening
                <div class="alert alert-success">




                    <table class="table table-borderless">
                        <thead>
                            <tr>

                                <th scope="col">Bank</th>
                                <th scope="col">Nomor Rek</th>
                                <th scope="col">Atas Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bank as $bank) : ?>
                                <tr>

                                    <td> <?php echo $bank->bank_name; ?></td>
                                    <td><?php echo $bank->bank_number; ?></td>
                                    <td><?php echo $bank->bank_account; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>



                </div>
                Upload Bukti Struk Pembayaran : <br>

                <?php echo form_open_multipart('driver/topup/konfirmasi/' . $topup->id); ?>
                <div class="form-group row mt-3">
                    <div class="col-12">
                        <div class="custom-file">
                            <input type='file' class="custom-file-input" id="customFile" name="foto_struk">
                            <label class="custom-file-label" for="customFile">Ambil Foto</label>
                        </div>
                        <br>
                        <img class="img-fluid mt-4" id="gambar" src="#" alt="Ambil Foto" OnError=" $(this).hide();" />

                    </div>
                </div>
                <input type="hidden" value="Process" name="transaction_status">
                <button type="submit" class="btn btn-success btn-block text-white">Konfirmasi Pembayaran</button>
                <?php echo form_close(); ?>


            </div>
        </div>

    <?php endif; ?>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#gambar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#customFile").change(function() {
        $('#gambar').show();
        readURL(this);
    });
</script>