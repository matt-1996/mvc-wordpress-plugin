<?php 

require_once DASHPATH . '/Models/User.php';

class testController {
    public function __construct(){
        //var_dump('test Controller Done Construct');
    }
    public function index(){
     //var_dump('dump from test function');
        $user = new DashUser;
        $currerntUser = $user->getUser();
        // var_dump($currerntUser);
     return view('user/dashboard/dashboard',['CurrerntUser' => $currerntUser]);
        
    }

    public function login(){

        return view('user/login/login');
    }
}
