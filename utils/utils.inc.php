<?php

function redirect($url) {
    die('<script>top.location.href="' . $url . '";</script>');
}

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
