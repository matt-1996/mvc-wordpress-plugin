<?php

class User{

    public function __construct(){
        add_shortcode( 'login_page', array($this,'login_page') );
        add_shortcode( 'dashboard_view', array($this,'dashboardView') );

        
        
    }

    function login_page(){

        if(! is_user_logged_in()){

            
            include DASHPATH . 'templates/user/login.php';
            
        }else{
            // Simulate an HTTP redirect:
            ?>
            <script>
        window.location.replace("<?php echo get_bloginfo('url') ?>");
        </script>
        <?php
        // echo get_bloginfo('url');
        }

        
    }

    function dashboardView(){
        include DASHPATH . 'templates/user/dashboardView.php';
    }

    
}