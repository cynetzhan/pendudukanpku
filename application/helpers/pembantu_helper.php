<?php

function hitungBobot($persen, $krit){
 $ret = 0;
 switch($krit){
  case 1:
   if($persen > 70){
     $ret = 50;
    } else if($persen >= 50) {
     $ret = 30;
    } else if($persen > 0){
     $ret = 20;
   }
  break;
  
  case 2:
   if($persen > 50){
     $ret = 50;
    } else if($persen >= 25) {
     $ret = 30;
    } else if($persen > 0){
     $ret = 20;
   }
  break;
  
  case 3:
   if($persen > 60){
     $ret = 20;
    } else if($persen >= 30) {
     $ret = 30;
    } else if($persen > 0){
     $ret = 50;
   }
  break;
  
  case 4:
   if($persen > 60){
     $ret = 20;
    } else if($persen >= 30) {
     $ret = 30;
    } else if($persen > 0){
     $ret = 50;
   }
  break;
  
  case 5:
   if($persen > 70){
     $ret = 20;
    } else if($persen >= 50) {
     $ret = 30;
    } else if($persen > 0){
     $ret = 50;
   }
  break;
 }
 return $ret;
}

function hitungHasil($bobot) { // bobot dalam bentuk array
 $krit = count($bobot);
 $bobot_pasti=array(0.33,0.26,0.2,0.13,0.06);
 $arr=array();
 for($i=0;$i<$krit;$i++){
  $arr[$i] = $bobot[$i] * $bobot_pasti[$i];
 }
 $arr['hasil'] = array_sum($arr);
 return $arr;
}

function ketHasil($hasil){
 $ret = "";
 if($hasil > 30){
  $ret = "<span style='background-color:#00ff00'><strong>TINGGI</strong></span>";
 } else if($hasil>20){
  $ret = "<span style='background-color:#ffff00'><strong>SEDANG</strong></span>";
 } else if($hasil > 0){
  $ret = "<span style='background-color:#ff0000'><strong>RENDAH</strong></span>";
 } else {
  $ret = "<span style='background-color:#444444'><strong>N/A</strong></span>";
 }
 return $ret;
}

function tanggal($dt,$with_timestamp=false){
 //format harus yyyy-mm-dd
 $bulan=array(
  "01" => "Januari",
  "02" => "Februari",
  "12" => "Desember",
  "03" => "Maret",
  "04" => "April",
  "05" => "Mei",
  "06" => "Juni",
  "07" => "Juli",
  "08" => "Agustus",
  "09" => "September",
  "10" => "Oktober",
  "11" => "November"
 );
 $date=explode("-",$dt);
 $tahun=substr($date[2],0,2); //fix date with timestamp format
 $tanggal=$tahun." ".$bulan[$date[1]]." ".$date[0];
 if($with_timestamp){
  $tanggal .= " ".substr($date[2],3);
 }
 return $tanggal;
}