<?php
//Proteksi Halaman Driver
if ($this->session->userdata('id')) {
    is_login();
    //Gabungan Semua layout
    require_once('header.php');
    require_once('menu.php');
    require_once('content.php');
    require_once('footer.php');
} else {
    redirect('login');
}
