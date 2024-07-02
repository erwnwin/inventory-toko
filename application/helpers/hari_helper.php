<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function nama_hariku($tgl = '')
{
    $hari = date('D', strtotime($tgl));

    $nama_hari = array(
        'Sun' => "Minggu",
        'Mon' => "Senin",
        'Tue' => "Selasa",
        'Wed' => "Rabu",
        'Thu' => "Kamis",
        'Fri' => "Jum`at",
        'Sat' => "Sabtu",
    );

    if (empty($nama_hari[$hari])) {
        return 'Nama hari tidak valid';
    }
    return $nama_hari[$hari];
}

// $tgl = date('Y-m-d');
// $hari = nama_hariku($tgl);

// echo "$hari";
