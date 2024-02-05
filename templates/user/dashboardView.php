<?php 

if(!is_user_logged_in()){
    ?>

    <script>
         window.location.replace("<?php echo get_bloginfo('url') . '/learn-dash-login-page/' ?>");
    </script>
    <?php
}

include DASHPATH . '/templates/user/components/sidebar.php';