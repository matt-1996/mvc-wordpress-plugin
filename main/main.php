<?php

class Main {

    public function __construct(){
        include DASHPATH . 'includes/user/loginAjax.php';
        register_activation_hook( __FILE__ , array($this,'plugin_activated') );
        // add_action('init',$this , 'newPage');
        // // :TODO Change this block of code to the proper class
        $this->createPage('Learn Dash Login Page', '[login_page]');
        $this->createPage('Learn Dash Dashboard Page', '[dashboard_view]');
        // register_deactivation_hook( __FILE__, $this->plugin_deactivated );

        $this->init();
        add_action( 'wp_enqueue_scripts', array($this,'enqueueStyles') );
        $this->enqueueStyles();
    }

    function newPage(){
        // :TODO Change this block of code to the proper class
        $this->createPage('Learn Dash Login Page', '[login_page]');
        $this->createPage('Learn Dash Dashboard Page', '[dashboard_view]');
    }

    public static function init(){

        if(is_admin()){

            require_once(DASHPATH . 'includes/admin/admin.php');
            new Admin;
        }else{
            
            
            require_once(DASHPATH . 'includes/user/user.php');
            
            new User;
        }
        

    }

    function plugin_activated(){
    
      
        global $wpdb;
        $table_name = $wpdb->prefix . 'dashboard';
        $charset_collate = $wpdb->get_charset_collate();
    
        $sql = "CREATE TABLE $table_name (
            id int(9) NOT NULL AUTO_INCREMENT,
            type varchar(20) DEFAULT NULL,
            value float DEFAULT NULL,
            isActive Boolean DEFAULT 0,
            PRIMARY KEY  (id)
        ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    // echo('Activated');
        
    }

    function enqueueStyles(){
        if(! is_admin()){

            wp_enqueue_style( 'dashlogin', DASHPATH . 'assets/css/login.css' );
            wp_register_script( 'loginHandler', DASHURL . '/assets/js/login.js', ['jquery'], null, false );
            wp_enqueue_script('loginHandler');
        }
        
    }

    function createPage($title,$content){
        // require_once( ABSPATH . "wp-includes/pluggable.php" );
        // $check_page_exist = get_page_by_title($title, 'OBJECT', 'page');
        
        // if(empty($check_page_exist)) {

        //     $new_post =  array(
        //         'post_author'    => get_current_user_id(),
        //         'post_title'     => ucwords($title),
        //         'post_name'      => strtolower(str_replace(' ', '-', trim($title))),
        //         'post_status'    => 'publish',
        //         'post_content'   => $content,
        //         'post_type'      => 'page',
        //         'page_template'  => 'elementor_canvas'
        //     );
        //      wp_insert_post($new_post);

           
        // }

        global $wpdb;
$tablename = $wpdb->prefix . "posts";

$post_type		= "page";
$post_title		= $title;
$post_content	= $content;
$post_status	= "publish";
$post_author	= get_current_user_id();
$post_name		= strtolower(str_replace(' ', '-', trim($title)));

if (!get_page_by_path( $post_name, OBJECT, 'page')) { // Check If Page Not Exits
    $sql = $wpdb->prepare("INSERT INTO `$tablename` (`post_type`, `post_title`, `post_content`, `post_status`, `post_author`, `post_name`) values (%s, %s, %s, %s, %d, %s)", $post_type, $post_title, $post_content, $post_status, $post_author, $post_name);

    $wpdb->query($sql);	
}
    }

}