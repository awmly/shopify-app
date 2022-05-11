<?php

// Register shutdown function
function __shutdown() {

  $error = error_get_last();

  if ($error['type'] == 1) {

    ob_end_clean();

    if (DEBUG_MODE) {
      echo $error['message'] . '<br/>Line ' . $error['line'] . ' in ' . $error['file'];
    } else {
      echo "App error";
    }

  }

}
register_shutdown_function('__shutdown');
