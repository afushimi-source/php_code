<?php
function en($dna){
  $err=rand(0,9);
  if($dna==$err){
    return $dna;
  }
}
$organism=0;
while(TRUE){
  $dna=rand(0,9);
  $organism.=en($dna);
  echo "$organism\t";
}