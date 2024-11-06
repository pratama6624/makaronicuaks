<?php

function encrypt($data) {
    $encryption_key = '12345678901234567890123456789012'; // 32-byte key untuk AES-256
    $iv = '1234567890123456'; // 16-byte IV tetap
    $prefix = 'DATA:'; // Tanda unik untuk verifikasi saat dekripsi

    // Enkripsi data dengan AES-256-CBC
    $encrypted = openssl_encrypt($prefix . $data, 'aes-256-cbc', $encryption_key, 0, $iv);

    // Gabungkan hasil enkripsi dengan IV, lalu encode dengan base64
    return base64_encode($iv . $encrypted);
}

function decrypt($encrypted_data) {
    $encryption_key = '12345678901234567890123456789012';
    $iv = '1234567890123456'; // 16-byte IV tetap
    $prefix = 'DATA:'; // Tanda unik untuk verifikasi
    
    // Decode data yang di-encode dengan base64
    $data = base64_decode($encrypted_data);

    // Ambil IV dan data terenkripsi
    $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    $iv_extracted = substr($data, 0, $iv_length);
    $encrypted = substr($data, $iv_length);

    // Dekripsi data terenkripsi
    $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $encryption_key, 0, $iv);

    // Verifikasi tanda unik, jika ada kesalahan kembalikan nilai default
    if ($decrypted !== false && strpos($decrypted, $prefix) === 0) {
        // Hapus tanda unik sebelum mengembalikan data
        return substr($decrypted, strlen($prefix));
    } else {
        // Nilai default jika dekripsi gagal
        return "Decryption failed or data corrupted.";
    }
}
