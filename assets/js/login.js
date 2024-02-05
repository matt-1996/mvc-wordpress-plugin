jQuery(document).ready(function($){

    $('#loginForm').on('submit', function(event){

        event.preventDefault();
        let email = $('#email').val()
        let password = $('#password').val()
        $.ajax({
            url: window.location.origin + '/wp-admin/admin-ajax.php',
            type: 'POST',
            method:'POST',
            dataType: 'json',
            data:{
                action: 'userlogin',
                email: email,
                password: password
            },
            success: function(response){
                if (response.success){

                    window.location.href = '/'
                }
            },
            error: function(error){
                if(error){

                    let messsage = error.responseJSON.message 
                    console.log(messsage)
                }
            }
        })
    })
})