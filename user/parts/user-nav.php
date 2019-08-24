<?php

    $query          = $_SERVER['PHP_SELF'];
    $path           = pathinfo( $query );
    $current_path   = $path['basename'];

?>


<div class="account-nav">
   <ul class="clearfix">
       <li> <a href="account.php"   <?php echo ( $current_path === 'account.php'   )  ? 'class="active"' : '' ; ?>  > General             </a> </li>
       <li> <a href="bank.php"      <?php echo ( $current_path === 'bank.php'      )  ? 'class="active"' : '' ; ?>  > Bank                </a> </li>
       <li> <a href="holdings.php"  <?php echo ( $current_path === 'holdings.php'  )  ? 'class="active"' : '' ; ?>  > Show all addresses  </a> </li>
       <li> <a href="passwords.php" <?php echo ( $current_path === 'passwords.php' )  ? 'class="active"' : '' ; ?>  > Password            </a> </li>
       <li> <a href="sessions.php"  <?php echo ( $current_path === 'sessions.php'  )  ? 'class="active"' : '' ; ?>  > Sessions            </a> </li>
       <li> <a href="authentication.php"  <?php echo ( $current_path === 'authentication.php'  )  ? 'class="active"' : '' ; ?>  > 2FA authentication </a> </li>
   </ul>
</div>