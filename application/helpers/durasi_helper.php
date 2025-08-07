<?php
function durasi_jam($tanggal,$awal,$akhir)
{
$waktuawal = date('Y-m-d H:i:s',strtotime($tanggal." ".$awal));
$waktuakhir = date('Y-m-d H:i:s',strtotime($tanggal." ".$akhir));
$tanda = strtotime($waktuakhir) - strtotime($waktuawal);
$durasi = round(abs(strtotime($waktuakhir) - strtotime($waktuawal)) / 60,2)." mnt"; // DURASI HARI YANG SAMA
if ($tanda<0){
$waktuawal = date('Y-m-d H:i:s',strtotime($tanggal." ".$awal));
$waktuakhir = date('Y-m-d H:i:s',strtotime($tanggal.' + 1 days'." ".$akhir)); // Tambah sehari
$durasi = round(abs(strtotime($waktuakhir) - strtotime($waktuawal)) / 60,2)." mnt";} // DURASI DALAM HARI BERBEDA
if($durasi>=60){
@$durasi = round($durasi/60,2);
$durasi = $durasi." jam";
}
return $durasi;
}


function durasi_hari($tanggal_awal,$tanggal_akhir)
{
$durasi =(abs((strtotime($tanggal_akhir))-(strtotime($tanggal_awal)))/(60*60*24));
$durasi = round($durasi,0);
return $durasi;
}
?>