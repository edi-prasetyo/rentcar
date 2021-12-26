<div class="card shadow">
    <div class="card-header">
        <h3><?php echo $title; ?></h3>
        <hr>
        <?php include "create.php"; ?>
    </div>

    <?php
    //Notifikasi
    if ($this->session->flashdata('message')) {
        echo '<div class="alert alert-success">';
        echo $this->session->flashdata('message');
        echo '</div>';
    }
    echo validation_errors('<div class="alert alert-warning">', '</div>');

    ?>


    <div class="table-responsive">
        <table class="table table-striped">
            <thead class=" thead-light">
                <tr>

                    <th>Nominal Top Up</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($nilai_topup as $nilai_topup) { ?>
                    <tr>

                        <td><?php echo number_format($nilai_topup->nilai_topup, 0, ",", "."); ?></td>
                        <td>
                            <?php include "update.php"; ?>
                            <?php include "delete.php"; ?>
                        </td>
                    </tr>

                <?php }; ?>


            </tbody>
        </table>
    </div>

</div>