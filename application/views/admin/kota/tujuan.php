<div class="card">

    <div class="card-body">
        <?php echo form_open(); ?>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label>Kota Asal</label>
                    <input type="text" class="form-control" name="kota_asal" value="<?php echo $kota->kota_name; ?>" required="required" readonly>

                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>Kota Tujuan</label>
                    <select class="form-control select2bs4" name="kota_tujuan">
                        <option value="">Pilih Kota Tujuan</option>
                        <?php foreach ($list_kota as $data) : ?>
                            <option value="<?php echo $data->kota_name; ?>"><?php echo $data->kota_name; ?> - <?php echo $data->provinsi_name; ?> </option>
                        <?php endforeach; ?>

                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label style="visibility: hidden;">Kota Tujuan</label>
                    <input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>

    </div>
</div>



<div class="card">
    <div class="card-header">

        <h3 class="card-title">Data Destinasi</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <?php
        //Notifikasi
        if ($this->session->flashdata('message')) {
            echo $this->session->flashdata('message');
            unset($_SESSION['message']);
        }
        echo validation_errors('<div class="alert alert-warning">', '</div>');

        ?>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Kota Asal</th>
                <th>Kota Tujuan</th>
                <th>Express</th>
                <th>Cargo</th>

                <th>Tarif</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($destinasi as $data) : ?>
                <tr>
                    <td><?php echo $data->kota_asal; ?></td>
                    <td><?php echo $data->kota_tujuan; ?></td>
                    <td>Rp. <?php echo number_format($data->express, 0, ",", "."); ?></td>
                    <td>Rp. <?php echo number_format($data->cargo, 0, ",", "."); ?></td>
                    <td>
                        <a href="<?php echo base_url('admin/kota/tarif/' . $data->id); ?>" class="btn btn-success btn-sm">Set Harga</a>
                    </td>
                </tr>
            <?php $no++;
            endforeach; ?>

        </tbody>
    </table>

    <div class="card-footer">
        <div class="pagination col-md-12 text-center p-0 m-0">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>
    </div>


</div>