<?php

function is_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        $ci->session->set_flashdata('message', '<div class="alert alert-danger">Anda Belum Login</div>');
        redirect('auth');
    }
}
