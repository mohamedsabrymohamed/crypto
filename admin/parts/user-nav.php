<?php

    $query          = $_SERVER['PHP_SELF'];
    $path           = pathinfo( $query );
    $current_path   = $path['basename'];

?>


<div class="account-nav">
   <ul class="clearfix">
        <li> <a href="holdings.php"  <?php echo ( $current_path === 'holdings.php'  )  ? 'class="active"' : '' ; ?>  > Show all addresses  </a> </li>
       <li> <a href="sessions.php"  <?php echo ( $current_path === 'sessions.php'  )  ? 'class="active"' : '' ; ?>  > Sessions            </a> </li>
   </ul>
</div>