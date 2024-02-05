<?php 


    add_action( 'wp_ajax_nopriv_userlogin', 'ajaxHandler' );
    

    function ajaxHandler(){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = wp_authenticate_email_password( null, $email, $password );
        if(is_wp_error( $user )){
           wp_send_json([
            'success' => false,
            'message' => 'user not found or wrong password'
           ],
            403  );
       }else{
        $loginResult = wp_signon( 
            ['user_login' => $user->user_login,
              'user_password' => $password,
              'remember' => false]);

              if(is_wp_error( $loginResult )){
                wp_send_json([
                    'success' => false,
                    'message' => 'Bad Request, please try later'
                   ],
                    400  );
              }

              wp_send_json([
                'success' => true,
                'message' => 'Login Success'
               ],
                200  );

       }
        // var_dump($validated);
    }
