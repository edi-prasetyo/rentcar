<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tarif Tujuan <?php echo $destinasi->kota_asal; ?> - <?php echo $destinasi->kota_tujuan; ?> </h3>
    </div>
    <div class="card-body">
        <div class="row">

            <!-- Data Pengirim dan Penerima -->

            <div class="col-md-6">
                <fieldset class="fieldset-title">
                    <legend class="fieldset-title"> Express : </legend>

                    <div class="form-group">
                        <label>Harga Awal</label>
                        <input type="text" class="form-control" name="harga_awal" value="<?php echo $tarif->harga_awal; ?>">
                        <div class="invalid-feedback">Silahkan Masukan Nama Pengirim.</div>
                    </div>
                    <div class="form-group">
                        <label>Harga / kg</label>
                        <input type="text" class="form-control" name="harga" placeholder="Harga / Kg" required>
                        <div class="invalid-feedback">Silahkan Masukan Nama Pengirim.</div>
                    </div>

                </fieldset>
            </div>

            <div class="col-md-6">
                <fieldset class="fieldset-title">
                    <legend class="fieldset-title"> Cargo :</legend>

                    <div class="form-group">
                        <label>Harga Awal</label>
                        <input type="text" class="form-control" name="harga_awal_2" placeholder="Harga Awal" required>
                        <div class="invalid-feedback">Silahkan Masukan Nama Pengirim.</div>
                    </div>
                    <div class="form-group">
                        <label>Harga / Kg Berikutnya </label>
                        <input type="text" class="form-control" name="harga_2" placeholder="Harga / Kg" required>
                        <div class="invalid-feedback">Silahkan Masukan Nama Pengirim.</div>
                    </div>
                </fieldset>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
        </div>
    </div>
</div>