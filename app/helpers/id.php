<?php 
function statusstoreorder($translate){

    $arraytranslate = [
        'L_PROCESS'         => 'Proses',
        'L_FAILED'          => 'Ditolak',
        'L_SUCCESS'         => 'Diterima',
        'L_APPROVE_PAYMENT' => 'Menunggu Diterima Pembayaran'
    ];

    return $arraytranslate[$translate];
}

function endis($translate){
    $arraytranslate = [
        'L_DISABLED'         => 'Tidak Aktif',
        'L_ENABLED'          => 'Aktif',
    ];

    return $arraytranslate[$translate];
}
?>