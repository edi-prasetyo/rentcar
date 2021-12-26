<?php $meta = $this->meta_model->get_meta(); ?>
<!-- Main content -->
<div class="card">
    <div class="card-header">
        <img src="<?php echo base_url('assets/img/logo/' . $meta->logo); ?>"><br>
        Kode Top Up : <strong><?php echo $withdraw->code_withdraw; ?></strong>
    </div>
    <div class="card-body">
        <!-- title row -->




        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-6 invoice-col">
                Info Main Agen <br>
                <b>Nama Main Agen :</b> <?php echo $withdraw->name; ?><br>
                <b>Region :</b> <?php echo $withdraw->kota_name; ?><br>
                <b>ID Main Agen :</b> <?php echo $withdraw->user_code; ?><br>
                <b>Telp Main Agen :</b> <?php echo $withdraw->user_phone; ?><br>
            </div>
            <!-- /.col -->
            <div class="col-sm-6 invoice-col">
                Info Top Up <br>
                <b>Kode Withdraw :</b> <?php echo $withdraw->code_withdraw; ?><br>
                <b>Status Transfer :</b>
                <?php if ($withdraw->status_withdraw == "Pending") : ?>
                    <span class="badge badge-warning badge-pill">Pending</span>
                <?php elseif ($withdraw->status_withdraw == "Process") : ?>
                    <span class="badge badge-info badge-pill">Proses</span>
                <?php elseif ($withdraw->status_withdraw == "Cancel") : ?>
                    <span class="badge badge-danger badge-pill">Batal</span>
                <?php else : ?>
                    <span class="badge badge-success badge-pill">Selesai</span>
                <?php endif; ?>
                <br>
                <b>Tanggal Withdraw :</b> <?php echo tanggal_indonesia_lengkap(date('Y-m-d', strtotime($withdraw->date_created))); ?> <?php echo date('H:i:s', strtotime($withdraw->date_created)); ?><br>

            </div>
            <!-- /.col -->
        </div>
        <hr>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6">
                <span class="text-muted" style="font-size: 80px;font-weight:bold;"> Rp. <?php echo number_format($withdraw->nominal_withdraw, 0, ",", "."); ?></span><br>

                <ul class="list-group list-group-unbordered mb-3">

                    <li class="list-group-item">
                        <b>Nama Bank</b> <span class="float-right"><?php echo $withdraw->bank_name; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Atas Nama</b> <span class="float-right"><?php echo $withdraw->bank_account; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Nomor Rekening</b> <span class="float-right"><?php echo $withdraw->bank_number; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Cabang</b> <span class="float-right"><?php echo $withdraw->bank_branch; ?></span>
                    </li>
                </ul>

            </div>
            <div class="col-md-4 p-5">

                <?php if ($withdraw->status_withdraw == 'Pending') : ?>

                    <?php echo form_open_multipart('admin/withdraw/detail/' . $withdraw->id); ?>
                    <div class="form-group">
                        <label>Upload Foto Struk Transfer</label>

                    </div>

                    <input type="hidden" name="status_withdraw" value="Success">

                    <div class="custom-file">
                        <input type='file' class="custom-file-input" id="customFile" name="foto_struk" required>
                        <label class="custom-file-label" for="customFile">Ambil Foto</label>
                    </div>
                    <br>
                    <img class="img-fluid mt-4" id="gambar" src="#" alt="Ambil Foto" OnError=" $(this).hide();" />

                    <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">Aprove</button>

                    <?php echo form_close(); ?>

                <?php else : ?>

                    <img src="<?php echo base_url('assets/img/struk/' . $withdraw->foto_struk); ?>">

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url('assets/template/admin/plugins/jquery-2.1.1/jquery.min.js'); ?>"></script>
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