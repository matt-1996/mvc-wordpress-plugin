<?php 

class Route {

    static $path;
    public function __construct(){

        Self::$path = parse_url($_SERVER['REQUEST_URI'])['path'] ;
        // add_action( 'init', [$this, 'get']);
        // var_dump($this->$path);
    }

    public static function get($path, $function){
        // var_dump(Self::$path);
         
        if(Self::$path === $path){
            $file = DASHPATH . 'Controllers/' . $function[0] . '.php';
           
            // var_dump(Self::isFileValid($file));
            // die();
             if(Self::isFileValid($file)){
                 add_filter( 'template_include', function($template) use($path){
                    
                     if ( is_page( $path )  ) {
                        $new_template =  DASHPATH . '/views/user/dashboard/dashboard-view.php';
                         return $new_template;
                     }
                return;
                }, 99 );
                 require_once(DASHPATH . 'Controllers/' . $function[0] . '.php');
                 $className = $function[0] ;
                 $functionName = $function[1];
                 $Class = new $className();
                 $a = $Class->$functionName();
             }else{

                 new WP_Error('Base not found', 'Path or Directory Not Found');
             }

            
            
        }
        
        
    }
    static function post(){}
    static function put(){}
    static function patch(){}
    static function delete(){}

    static function isFileValid($filePath){
        return file_exists($filePath) && is_readable($filePath);
    }

    // function dashboard_template( $page_template ){
    // // if ( is_page( 'dashboardForMe' ) ) {
    // //     $page_template = dirname( __FILE__ ) . '/views/user/dashboard-view.php';
    // // }
    // // return $page_template;

    // var_dump('done by filter');
    // }
}

new Route;