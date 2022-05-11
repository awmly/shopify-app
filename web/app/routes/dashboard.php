<?php if (\Shopify\Helpers::validateHMAC($_GET)) { ?>

  <?php
  $get     = \App\Requests::get();
  $shop    = $get->shop;
  $shopify = new \App\Shopify($shop);
  $shopify->init();
  ?>

  <html>
  <head>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:100,300,400,600,700">
  </head>
  <body>

    <div class='holder'>

      <h1>App installed</h1>

    </div>

  </body>
  </html

<?php } ?>