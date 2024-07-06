<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('encrypt_id')) {
    function encrypt_id($id)
    {
        $CI = &get_instance();
        $CI->load->library('encryption');

        // Encrypt the ID
        $encrypted_id = $CI->encryption->encrypt($id);

        // Convert encrypted data to a URL-safe base64 format
        return strtr(base64_encode($encrypted_id), '+/=', '-_,');
    }
}

if (!function_exists('decrypt_id')) {
    function decrypt_id($encrypted_id)
    {
        $CI = &get_instance();
        $CI->load->library('encryption');

        // Convert back from URL-safe base64 to regular base64
        $encrypted_id = base64_decode(strtr($encrypted_id, '-_,', '+/='));

        // Decrypt the ID
        return $CI->encryption->decrypt($encrypted_id);
    }
}
