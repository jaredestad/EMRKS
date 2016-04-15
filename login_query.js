$(document).ready(function() {

    $("#bad_auth").hide();
    $("#no_auth").hide();

    $("#login_button").click(function() {
        var username = document.getElementById("username_input").value;
        var password = document.getElementById("password_input").value;


        if(username == "" || password == ""){
            $("#no_auth").show();
            $("#bad_auth").hide();
        }
        else{
            $("#no_auth").hide();

            $.ajax({
                type: "POST",
                url: "./auth_user.php",
                data: {username, password},
                type: "text",

                success: function(result){
                    console.log(result);

                    if(result == true){
                        window.location.replace("place link here");
                    } 
                    else{
                        $("#password_input").val("");
                        $("#bad_auth").show();
                    }


                },

                error : function(jqXHR, textStatus, errorThrown) {
                            console.log( errorThrown );
                            console.log("error jqXHR: " + jqXHR);
                            console.log("error textStatus: " + textStatus);
                        }

            });

        }


    });



});
