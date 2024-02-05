<?php 

class DashUser {

    function getUser(){
        if(is_user_logged_in()){

            return wp_get_current_user();
        }

        WP_Error('Not Logged in', 'User not Logged in');
    }

   
}
// new User;