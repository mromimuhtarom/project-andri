<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute harus di terima.',
    'active_url' => ':attribute bukan URL yang valid.',
    'after' => ':attribute harus tanggal setelah :date.',
    'after_or_equal' => ':attribute harus tanggal setelah atau sama dengan :date.',
    'alpha' => ':attribute hanya boleh berisi huruf.',
    'alpha_dash' => ':attribute hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
    'alpha_num' => ':attribute hanya boleh berisi huruf dan angka.',
    'array' => ':attribute harus berupa larik(array).',
    'before' => ':attribute harus tanggal sebelum :date.',
    'before_or_equal' => ':attribute harus tanggal sebelum atau sama dengan :date.',
    'between' => [
        'numeric' => ':attribute harus di antara :min dan :max.',
        'file' => ':attribute harus di antara :min dan :max kilobytes.',
        'string' => ':attribute harus di antara :min dan :max karakter.',
        'array' => ':attribute harus di antara :min dan :max item.',
    ],
    'boolean' => ':attribute harus true or false.',
    'confirmed' => ':attribute konfirmasi tidak cocok.',
    'date' => ':attribute bukan tanggal yang valid.',
    'date_equals' => ':attribute harusa sama dengan :date.',
    'date_format' => ':attribute tidak cocok dengan format :format.',
    'different' => ':attribute dan :other harus berbeda.',
    'digits' => ':attribute harus :digits digit.',
    'digits_between' => ':attribute harus di antara :min dan :max digit.',
    'dimensions' => ':attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => ':attribute memiliki nilai duplikat.',
    'email' => ':attribute harus alamat email yang valid.',
    'ends_with' => ':attribute harus berakhiran dengan: :values.',
    'exists' => ':attribute yang dipilih tidak valid.',
    'file' => ':attribute harus berupa file.',
    'filled' => ':attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => ':attribute harus lebih dari :value.',
        'file' => ':attribute harus lebih dari :value kilobytes.',
        'string' => ':attribute harus lebih dari :value karakter.',
        'array' => ':attribute harus lebih dari :value item.',
    ],
    'gte' => [
        'numeric' => ':attribute harus lebih atau sama dengan :value.',
        'file' => ':attribute harus lebih atau sama dengan :value kilobytes.',
        'string' => ':attribute harus lebih atau sama dengan :value karakter.',
        'array' => ':attribute harus memiliki :value item atau lebih.',
    ],
    'image' => ':attribute harus gambar.',
    'in' => ':attribute yang di pilih tidak valid.',
    'in_array' => ':attribute tidak ada di :other.',
    'integer' => ':attribute harus berupa bilangan bulat.',
    'ip' => ':attribute harus berupa alamat IP yang valid.',
    'ipv4' => ':attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => ':attribute harus berupa alamat IPv6 yang valid.',
    'json' => ':attribute harus berupa string JSON yang valid.',
    'lt' => [
        'numeric' => ':attribute harus kurang dari :value.',
        'file' => ':attribute harus kurang dari :value kilobytes.',
        'string' => ':attribute harus kurang dari :value karakter.',
        'array' => ':attribute harus kurang dari :value item.',
    ],
    'lte' => [
        'numeric' => ':attribute harus kurang atau sama dengan :value.',
        'file' => ':attribute harus kurang atau sama dengan :value kilobytes.',
        'string' => ':attribute harus kurang atau sama dengan :value karakter.',
        'array' => ':attribute harus kurang atau sama dengan :value item.',
    ],
    'max' => [
        'numeric' => ':attribute tidak lebih dari :max.',
        'file' => ':attribute tidak lebih dari :max kilobytes.',
        'string' => ':attribute tidak lebih dari :max karakter.',
        'array' => ':attribute tidak lebih dari :max item.',
    ],
    'mimes' => ':attribute harus berupa file yang berjenis: :values.',
    'mimetypes' => ':attribute harus berupa file yang berjenis: :values.',
    'min' => [
        'numeric' => ':attribute minimal harus :min.',
        'file' => ':attribute minimal harus :min kilobytes.',
        'string' => ':attribute minimal harus :min karakter.',
        'array' => ':attribute minimal harus :min item.',
    ],
    'not_in' => ':attribute yang di pilih tidak valid.',
    'not_regex' => ':attribute format tidak valid.',
    'numeric' => ':attribute harus angka.',
    'password' => 'Kata sandi tidak benar.',
    'present' => ':attribute harus ada.',
    'regex' => ':attribute format tidak valid.',
    'required' => ':attribute Harus di isi.',
    'required_if' => ':attribute harus diisi jika :other adalah :value.',
    'required_unless' => ':attribute harus di isi kecuali :other ada di :values.',
    'required_with' => ':attribute harus di isi jika :values ada.',
    'required_with_all' => ':attribute harus di isi jika :values ada.',
    'required_without' => ':attribute harus di isi jika :values tidak ada.',
    'required_without_all' => ':attribute harus diisi jika tidak ada :values ada.',
    'same' => ':attribute dan :other harus cocok.',
    'size' => [
        'numeric' => ':attribute harus :size.',
        'file' => ':attribute harus :size kilobytes.',
        'string' => ':attribute harus :size karakter.',
        'array' => ':attribute harus mengandung :size item.',
    ],
    'starts_with' => ':attribute harus dimulai dengan: :values',
    'string' => ':attribute harus berupa stirng.',
    'timezone' => ':attribute harus berupa zona waktu yang valid.',
    'unique' => ':attribute sudah di pakai.',
    'uploaded' => ':attribute gagal untuk di unggah.',
    'url' => ':attribute format tidak valid.',
    'uuid' => ':attribute harus merupakan UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
