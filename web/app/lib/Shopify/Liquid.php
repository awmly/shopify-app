<?php

namespace Shopify;

class Liquid{

  public function header() {

    header("Content-Type: application/liquid");

  }

  public function parseVar($var) {

    $var = str_replace("-", "_", $var);

    return $var;

  }

  public function comment ($val) {

    echo "{% comment %}" . $val . "{% endcomment %}\n";

  }

  public function integer($var, $val) {

    echo '{% assign ' . $this->parseVar($var) . ' = ' . $val . ' %}'."\n";

  }

  public function assign($var, $val) {

    echo '{% assign ' . $this->parseVar($var) . ' = "' . $val . '" %}'."\n";

  }

  public function capture($var, $val) {

    echo "{% capture " . $this->parseVar($var) . " %}" . $val . "{% endcapture %}\n";

  }

  public function array($var, $val) {

    echo "{% capture tmp %}" . implode("<cxl>", $val) ."{% endcapture %}\n";

    echo "{% assign " . $this->parseVar($var) . " = tmp | split: '<cxl>' %}\n";

  }

  public function image($image) {



  }

  public function include($file, $isVariable = false) {

    if (!$file) return;

    if ($isVariable) {
      echo "{% include " . $file . " %}\n";
    } else {
      echo "{% include '" . $file . "' %}\n";
    }

  }

  public function layout($file) {

    if (!$file) return;

    if ($file == 'none') {
      echo "{% layout " . $file . " %}\n";
    } else {
      echo "{% layout 'theme." . $file . "' %}\n";
    }

  }

}
