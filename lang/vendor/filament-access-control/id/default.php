<?php

return [
    'fields' => [
        'first_name' => 'Nama Depan',
        'last_name' => 'Nama Belakang',
        'email' => 'Email',
        'role' => 'Peran',
        'permissions' => 'Izin',
        'name' => 'Nama',
        'full_name' => 'Nama Lengkap',
        'description' => 'Deskripsi',
        'id' => 'ID',
        'created_at' => 'Dibuat Pada',
        'password' => 'Kata Sandi',
        'password_confirm' => 'Konfirmasi kata sandi',
        'active' => 'Aktif',
        'expires_at' => 'Tanggal Kadaluarsa',
        'code' => 'Kode Verifikasi',
    ],
    'resources' => [
        'admin_user' => 'Pengguna Admin',
        'admin_users' => 'Pengguna Admin',
        'role' => 'Peran',
        'roles' => 'Peran',
        'permission' => 'Izin',
        'permissions' => 'Izin',
        'group' => 'Administrasi',
    ],
    'sections' => [
        'permissions' => 'Izin',
        'user_details' => 'Detail Pengguna',
    ],
    'messages' => [
        'permissions_create' => 'Pengguna mungkin memiliki izin lain dari peran mereka. Izin aktual tercantum pada halaman tampilan.',
        'permissions_view' => 'Izin langsung serta izin melalui peran mereka.',
        'account_expired' => 'Akun ini telah kedaluwarsa. Silakan hubungi administrator.',
        'accounts_extended' => 'Akun yang dipilih telah diperpanjang.',
        'invalid_user' => 'Pengguna tidak valid, silakan coba lagi.',
        'code_expired' => 'Kode verifikasi ini telah kedaluwarsa. Silakan gunakan kode baru yang baru saja kami kirimkan kepada Anda.',
        'invalid_code' => 'Kode verifikasi tidak valid.',
        'enter_code' => 'Untuk mengonfirmasi login Anda, silakan masukkan kode verifikasi yang dikirimkan ke alamat email Anda.',
    ],
    'pages' => [
        'reset_password' => 'Atur Ulang Kata Sandi',
        'account_expired' => 'Akun Telah Kedaluwarsa',
        'two_factor' => 'Verifikasi Login',
    ],
    'notifications' => [
        'salutation' => 'Salam',
        'password_reset' => [
            'title' => 'Kata sandi Anda untuk admin :host',
            'message' => 'Anda menerima email ini karena kami menerima permintaan pengaturan ulang kata sandi untuk akun Anda.',
            'button' => 'Atur Ulang Kata Sandi',
            'expiry' => 'Tautan pengaturan ulang kata sandi ini akan kedaluwarsa dalam :count menit. Jika Anda tidak meminta pengaturan ulang kata sandi, tidak perlu tindakan lebih lanjut.',
        ],
        'password_set' => [
            'title' => 'Akun Anda untuk admin :host',
            'message' => 'Anda menerima email ini karena akun admin baru baru-baru ini dibuat untuk Anda untuk admin :host. Silakan klik tautan berikut untuk mengatur kata sandi Anda:',
            'button' => 'Atur Kata Sandi',
            'expiry' => 'Tautan pengaturan kata sandi ini akan kedaluwarsa dalam :count menit. Jika tautan telah kedaluwarsa, Anda dapat mencoba [atur ulang kata sandi Anda secara manual](:url).',
        ],
        'two_factor' => [
            'title' => 'Kode verifikasi Anda untuk admin :host',
            'message' => 'Untuk mengonfirmasi login Anda, silakan gunakan kode verifikasi berikut. Kode ini berlaku selama 5 menit.',
        ],
    ],
    'buttons' => [
        'back_to_login' => 'Kembali ke login',
        'forgot_password' => 'Lupa kata sandi?',
        'submit' => 'Kirim',
    ],
    'filters' => [
        'expired' => 'Kedaluwarsa',
    ],
    'actions' => [
        'extend' => 'Perpanjang tanggal kedaluwarsa',
    ],
];
