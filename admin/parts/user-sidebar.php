<?php

    $query          = $_SERVER['PHP_SELF'];
    $path           = pathinfo( $query );
    $current_path   = $path['basename'];

?>

<sidebar class="user-page-sidebar">
    <ul>
		 <li> <a href="wallet.php"            <?php echo ( $current_path === 'wallet.php'       )  ? 'class="active"' : ''  ; ?>  >  <i class="ion-android-folder-open">              </i> <span>My Wallet     </span> </a> </li>
	   <li> <a href="pending-requests.php"  <?php echo ( $current_path === 'pending-requests.php'       )  ? 'class="active"' : ''  ; ?>  >  <i class="ion-android-folder-open">    </i> <span>Pending Requests  </span> </a> </li>
        <li> <a href="approved-requests.php"  <?php echo ( $current_path === 'approved-requests.php'       )  ? 'class="active"' : ''  ; ?>  >  <i class="ion-android-folder-open">    </i> <span>Approved Requests  </span> </a> </li>
        <li> <a href="rejected-requests.php"  <?php echo ( $current_path === 'rejected-requests.php'       )  ? 'class="active"' : ''  ; ?>  >  <i class="ion-android-folder-open">    </i> <span>Rejected Requests  </span> </a> </li>
        <li> <a href="users.php"  <?php echo ( $current_path === 'users.php'       )  ? 'class="active"' : ''  ; ?>  >  <i class="ion-android-folder-open">    </i> <span>Users </span> </a> </li>
       
    </ul>
</sidebar>