<?php

    $query          = $_SERVER['PHP_SELF'];
    $path           = pathinfo( $query );
    $current_path   = $path['basename'];

?>

<sidebar class="user-page-sidebar">
    <ul>
        <li> <a href="wallet.php"          <?php echo ( $current_path === 'wallet.php'       )  ? 'class="active"' : ''  ; ?>  >  <i class="ion-android-folder-open">              </i> <span>My Wallet     </span> </a> </li>
        <li> <a href="buy_bitcoin.php"     <?php echo ( $current_path === 'buy_bitcoin.php'  )  ? 'class="active"' : ''  ; ?>  >  <i class="ion-android-cart">                     </i> <span>Buy Bitcoin   </span> </a> </li>
        <li> <a href="sell_bitcoin.php"    <?php echo ( $current_path === 'sell_bitcoin.php' )  ? 'class="active"' : ''  ; ?>  >  <i class="ion-cash">                             </i> <span>Sell Bitcoin  </span> </a> </li>
        <li> <a href="send.php"            <?php echo ( $current_path === 'send.php'         )  ? 'class="active"' : ''  ; ?>  >  <i class="ion-android-send">                     </i> <span>Send          </span> </a> </li>
        <li> <a href="receive.php"         <?php echo ( $current_path === 'receive.php'      )  ? 'class="active"' : ''  ; ?>  >  <i class="ion-android-arrow-dropdown-circle">    </i> <span>Receive       </span> </a> </li>
    </ul>
</sidebar>