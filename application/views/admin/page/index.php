<div class="card">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <?php echo $title; ?>
        <a href="<?php echo base_url('admin/page/create'); ?>" class="btn btn-success btn-sm text-white">Buat halaman</a>
    </div>
    <?php
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
    }
    ?>
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th width="5%">No</th>
                    <th>Judul Halaman</th>
                    <th>Tanggal Update</th>
                    <th width="23%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($page as $data) : ?>
                    <tr>
                        <td class="text-info"><?php echo $no; ?></td>
                        <td><?php echo $data->page_title; ?></td>
                        <td>
                            <a href="<?php echo base_url('page/detail/' . $data->page_slug); ?>" class="btn btn-sm btn-primary text-white"><i class="ti-eye"></i> Lihat</a>
                            <a href="<?php echo base_url('admin/page/update/' . $data->id); ?>" class="btn btn-sm btn-success text-white"><i class="ti-edit"></i> Edit</a>
                            <?php include "delete.php"; ?>
                        </td>
                    </tr>
                <?php $no++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer"></div>
</div>