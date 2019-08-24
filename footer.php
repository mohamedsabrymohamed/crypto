
        <footer id="footer">
            <p class="footer__copyright">Powerd by Bptacademy</p>
        </footer>


        <!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
        %%%%%%%%%%%%  ^^ ^^ ^^    Start  Javascript Links  !!! ^^ ^^ ^^    %%%%%%%%%%%%%%%%%%%%
        %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

    <!-- jquery libarary -->
    <script src="<?php echo $js;?>jquery-1.11.1.min.js"></script>
    <script src="<?php echo $js;?>bootstrap.min.js"></script>
    <script src="<?php echo $js;?>jquery.magnific-popup.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo $js;?>main.js"></script>
	<script src="<?php echo $js;?>parsley.js"></script>
    	<script>

function setSelectedTestPlan(){

 $.ajax({
  type: "POST",
  url: "../clear_notif.php",
  data: { uid: "<?php echo get_login_user_id();?>" }
})   

    };

	
	</script>
    
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%%%%%%%%%%%%  ^^ ^^ ^^    End  Javascript Links  !!! ^^ ^^ ^^    %%%%%%%%%%%%%%%%%%%%
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

</body>

</html>