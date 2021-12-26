<?php
//Proteksi Halaman Counter Agen
if ($this->session->userdata('role_id') == 4) {
    is_login();
    //Gabungan Semua layout
    require_once('header.php');
    require_once('content.php');
    require_once('footer.php');
} else {
    redirect('auth');
}
