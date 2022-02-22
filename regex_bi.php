<?php
$bi="005354CC040";
//$padrao="/^[0-9]+[a-z]+[0-9]+$/i";
$padrao="/^[0-9]+[a-z]{2,3}+[0-9]{3}+$/i";
if(preg_match($padrao,$bi)):
  echo "O padrão correspondente:$bi";
  else:
    echo "Nao corresponde";
    endif;
$d="$bi";
echo $d;