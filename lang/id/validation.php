<?php

return [

    /*
    |------------------------------------------------- -------------------------
    | Baris Bahasa Validasi
    |------------------------------------------------- -------------------------
    |
    | Baris bahasa berikut berisi pesan kesalahan default yang digunakan oleh
    | kelas validator. Beberapa aturan ini memiliki beberapa versi
    | sebagai aturan ukuran. Jangan ragu untuk mengubah setiap pesan ini di sini.
    |
    */

    'accepted' => 'Isian :attribute harus diterima.',
    'accepted_if' => 'Isian :attribute harus diterima jika :other adalah :value.',
    'active_url' => 'Isian :attribute harus berupa URL yang valid.',
    'after' => 'Isian :attribute harus berupa tanggal setelah :date.',
    'after_or_equal' => 'Isian :attribute harus berupa tanggal setelah atau sama dengan :date.',
    'alpha' => 'Isian :attribute hanya boleh berisi huruf.',
    'alpha_dash' => 'Isian :attribute hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
    'alpha_num' => 'Isian :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'Isian :attribute harus berupa array.',
    'ascii' => 'Isian :attribute hanya boleh berisi karakter dan simbol alfanumerik byte tunggal.',
    'before' => 'Isian :attribute harus berisi tanggal sebelum :date.',
    'before_or_equal' => 'Isian :attribute harus berisi tanggal sebelum atau sama dengan :date.',
    'between' => [
        'array' => 'Isian :attribute harus berisi antara item :min dan :max.',
        'file' => 'Isian :attribute harus antara :min dan :max kilobyte.',
        'numeric' => 'Isian :attribute harus berada di antara :min dan :max.',
        'string' => 'Isian :attribute harus berada di antara karakter :min dan :max.',
    ],
    'boolean' => 'Isian :attribute harus benar atau salah.',
    'can' => 'Isian :attribute berisi nilai yang tidak sah.',
    'confirmed' => 'Konfirmasi kolom :attribute tidak cocok.',
    'current_password' => 'Kata sandi salah.',
    'date' => 'Isian :attribute harus berupa tanggal yang valid.',
    'date_equals' => 'Isian :attribute harus berisi tanggal yang sama dengan :date.',
    'date_format' => 'Isian :attribute harus cocok dengan format :format.',
    'decimal' => 'Isian :attribute harus memiliki :desimal desimal.',
    'declined' => 'Isian :attribute harus ditolak.',
    'declined_if' => 'Isian :attribute harus ditolak bila :other adalah :value.',
    'different' => 'Isian :attribute dan :other harus berbeda.',
    'digits' => 'Isian :attribute harus berupa :digits digit.',
    'digits_between' => 'Isian :attribute harus berada di antara angka :min dan :max.',
    'dimensions' => 'Bagian :attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => 'Isian :attribute mempunyai nilai duplikat.',
    'doesnt_end_with' => 'Isian :attribute tidak boleh diakhiri dengan salah satu dari berikut ini: :values.',
    'doesnt_start_with' => 'Isian :attribute tidak boleh diawali dengan salah satu dari berikut ini: :values.',
    'email' => 'Isian :attribute harus berupa alamat email yang valid.',
    'ends_with' => 'Isian :attribute harus diakhiri dengan salah satu dari yang berikut: :values.',
    'enum' => ' :attribute yang dipilih tidak valid.',
    'exists' => ' :attribute yang dipilih tidak valid.',
    'file' => 'Isian :attribute harus berupa file.',
    'filled' => 'Isian :attribute harus mempunyai nilai.',
    'gt' => [
        'array' => 'Isian :attribute harus berisi lebih dari :value item.',
        'file' => 'Isian :attribute harus lebih besar dari :value kilobytes.',
        'numeric' => 'Isian :attribute harus lebih besar dari :value.',
        'string' => 'Isian :attribute harus lebih besar dari karakter :value.',
    ],
    'gte' => [
        'array' => 'Isian :attribute harus berisi item :value atau lebih.',
        'file' => 'Isian :attribute harus lebih besar atau sama dengan :value kilobyte.',
        'numeric' => 'Isian :attribute harus lebih besar atau sama dengan :value.',
        'string' => 'Isian :attribute harus lebih besar atau sama dengan karakter :value.',
    ],
    'image' => 'Isian :attribute harus berupa gambar.',
    'in' => ' :attribute yang dipilih tidak valid.',
    'in_array' => 'Isian :attribute harus ada di :other.',
    'integer' => 'Isian :attribute harus berupa bilangan bulat.',
    'ip' => 'Isian :attribute harus berupa alamat IP yang valid.',
    'ipv4' => 'Isian :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => 'Isian :attribute harus berupa alamat IPv6 yang valid.',
    'json' => 'Isian :attribute harus berupa string JSON yang valid.',
    'lowercase' => 'Isian :attribute harus menggunakan huruf kecil.',
    'lt' => [
        'array' => 'Isian :attribute harus berisi kurang dari :value item.',
        'file' => 'Isian :attribute harus kurang dari :value kilobytes.',
        'numeric' => 'Isian :attribute harus kurang dari :value.',
        'string' => 'Isian :attribute harus kurang dari :value karakter.',
    ],
    'lte' => [
        'array' => 'Isian :attribute tidak boleh berisi lebih dari :value item.',
        'file' => 'Isian :attribute harus kurang dari atau sama dengan :value kilobyte.',
        'numeric' => 'Isian :attribute harus lebih kecil atau sama dengan :value.',
        'string' => 'Isian :attribute harus kurang dari atau sama dengan karakter :value.',
    ],
    'mac_address' => 'Isian :attribute harus berupa alamat MAC yang valid.',
    'max' => [
        'array' => 'Isian :attribute tidak boleh berisi lebih dari :max item.',
        'file' => 'Isian :attribute tidak boleh lebih besar dari :max kilobyte.',
        'numeric' => 'Isian :attribute tidak boleh lebih besar dari :max.',
        'string' => 'Isian :attribute tidak boleh lebih besar dari :max karakter.',
    ],
    'max_digits' => 'Isian :attribute tidak boleh lebih dari :max digit.',
    'mimes' => 'Isian :attribute harus berupa file dengan tipe: :values.',
    'mimetypes' => 'Isian :attribute harus berupa file dengan tipe: :values.',
    'min' => [
        'array' => 'Isian :attribute harus memiliki setidaknya :min item.',
        'file' => 'Isian :attribute minimal harus :min kilobyte.',
        'numeric' => 'Isian :attribute minimal harus :min.',
        'string' => 'Isian :attribute minimal harus berisi :min karakter.',
    ],
    'min_digits' => 'Isian :attribute harus berisi setidaknya :min digit.',
    'missing' => 'Isian :attribute harus hilang.',
    'missing_if' => 'Isian :attribute harus hilang jika :other adalah :value.',
    'missing_unless' => 'Isian :attribute harus hilang kecuali :other adalah :value.',
    'missing_with' => 'Isian :attribute harus hilang jika :values ada.',
    'missing_with_all' => 'Isian :attribute harus hilang jika :values ada.',
    'multiple_of' => 'Isian :attribute harus kelipatan :value.',
    'not_in' => 'Atribut yang dipilih tidak valid.',
    'not_regex' => 'Format kolom :attribute tidak valid.',
    'numeric' => 'Isian :attribute harus berupa angka.',
    'password' => [
        'letters' => 'Isian :attribute harus berisi setidaknya satu huruf.',
        'mixed' => 'Isian :attribute harus berisi setidaknya satu huruf besar dan satu huruf kecil.',
        'numbers' => 'Isian :attribute harus berisi setidaknya satu angka.',
        'symbols' => 'Isian :attribute harus berisi setidaknya satu simbol.',
        'uncompromised' => ' :Attribute yang diberikan telah muncul dalam kebocoran data. Silakan pilih :atribut yang lain.',
    ],
    'present' => 'Isian :attribute harus ada.',
    'prohibited' => 'Isian :attribute dilarang.',
    'prohibited_if' => 'Isian :attribute dilarang jika :other adalah :value.',
    'prohibited_unless' => 'Isian :attribute dilarang kecuali :other ada di :values.',
    'prohibits' => 'Isian :attribute melarang :other untuk hadir.',
    'regex' => 'Format kolom :attribute tidak valid.',
    'required' => 'Isian :attribute wajib diisi.',
    'required_array_keys' => 'Isian :attribute harus berisi entri untuk: :values.',
    'required_if' => 'Isian :attribute wajib diisi bila :other adalah :value.',
    'required_if_accepted' => 'Isian :attribute wajib diisi jika :other diterima.',
    'required_unless' => 'Isian :attribute wajib diisi kecuali :other ada di :values.',
    'required_with' => 'Isian :attribute wajib diisi bila :values ada.',
    'required_with_all' => 'Isian :attribute diperlukan jika :values ada.',
    'required_without' => 'Isian :attribute diperlukan bila :values tidak ada.',
    'required_without_all' => 'Isian :attribute wajib diisi jika :values tidak ada.',
    'same' => 'Isian :attribute harus cocok dengan :other.',
    'size' => [
        'array' => 'Isian :attribute harus berisi item :size.',
        'file' => 'Isian :attribute harus :ukuran kilobyte.',
        'numeric' => 'Isian :attribute harus :ukuran.',
        'string' => 'Isian :attribute harus berisi :karakter ukuran.',
    ],
    'starts_with' => 'Isian :attribute harus diawali dengan salah satu dari yang berikut: :values.',
    'string' => 'Isian :attribute harus berupa string.',
    'timezone' => 'Isian :attribute harus berupa zona waktu yang valid.',
    'unique' => ' :attribute sudah dipakai.',
    'uploaded' => ' :Attribute gagal diunggah.',
    'uppercase' => 'Isian :attribute harus menggunakan huruf besar.',
    'url' => 'Isian :attribute harus berupa URL yang valid.',
    'ulid' => 'Isian :attribute harus berupa ULID yang valid.',
    'uuid' => 'Isian :attribute harus berupa UUID yang valid.',

    /*
    |------------------------------------------------- -------------------------
    | Baris Bahasa Validasi Kustom
    |------------------------------------------------- -------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi khusus untuk atribut menggunakan
    | konvensi "atribut.rule" untuk memberi nama baris. Ini membuatnya cepat
    | tentukan baris bahasa khusus tertentu untuk aturan atribut tertentu.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'pesan-khusus',
        ],
    ],

    /*
    |------------------------------------------------- -------------------------
    | Atribut Validasi Kustom
    |------------------------------------------------- -------------------------
    |
    | Baris bahasa berikut digunakan untuk menukar placeholder atribut kami
    | dengan sesuatu yang lebih ramah pembaca seperti "Alamat Email".
    | dari "email". Ini hanya membantu kami membuat pesan kami lebih ekspresif.
    |
    */

    'attributes' => [],

];
