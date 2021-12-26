<?php
//Proteksi Halaman Admin
if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2  || $this->session->userdata('role_id') == 3) {
    is_login();
    //Gabungan Semua layout
    require_once('header.php');
    require_once('topbar.php');
    require_once('sidebar.php');

    require_once('content.php');
    require_once('footer.php');
} else {
    redirect('auth');
}
