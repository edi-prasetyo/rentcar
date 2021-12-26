<div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-body">

            <?php
            //Error warning
            echo validation_errors('<div class="alert alert-warning">', '</div>');

            echo form_open('admin/topup/decline/' . $topup->id,  array('class' => 'needs-validation', 'novalidate' => 'novalidate'));

            ?>

            <div class="form-group">
                <label>Alasan Pembatalan</label>
                <textarea class="form-control" name="topup_reason" required></textarea>
                <div class="invalid-feedback">Silahkan Masukan Alasan Pembatalan</div>
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-danger" name="submit" value="Decline">
            </div>
            <?php
            //Form Close
            echo form_close();
            ?>
        </div>
    </div>
</div>