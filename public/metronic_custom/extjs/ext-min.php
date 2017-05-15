<?php
header("Content-type: application/x-javascript; charset: UTF-8");
	ob_start("compress");
  function compress($buffer) {
    /* remove comments */
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    /* remove tabs, spaces, newlines, etc. */
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
  }

  /* your css files */
  //include('ext-all.js');
  echo readfile('ext-min.js');
ob_end_flush();
?>