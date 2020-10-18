<?php 
function statusstoreorder($translate){

    $arraytranslate = [
        'L_PROCESS'         => 'Proses',
        'L_FAILED'          => 'Ditolak',
        'L_SUCCESS'         => 'Diterima',
        'L_APPROVE_PAYMENT' => 'Pembayaran Diterima'
    ];

    return $arraytranslate[$translate];
}
?>