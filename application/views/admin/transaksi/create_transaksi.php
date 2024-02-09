<?php
//Notifikasi
if ($this->session->flashdata('message')) {
    echo '<div class="alert alert-success">';
    echo $this->session->flashdata('message');
    echo '</div>';
}
echo validation_errors('<div class="alert alert-warning">', '</div>');

?>


<a href="<?php echo base_url('admin/admindaily'); ?>" class="btn btn-app">
    <i class="fas fa-car"></i> Daily
</a>


<a href="<?php echo base_url('admin/adminairport'); ?>" class="btn btn-app">
    <i class="fas fa-plane-departure"></i> Airport
</a>

<a href="<?php echo base_url('admin/admindropoff'); ?>" class="btn btn-app">
    <i class="fas fa-bus"></i> Drop Off
</a>