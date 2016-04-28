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
                data: { data1: username, data2: password},
                dataType: "text",

                success: function(result){
                    console.log(result);

                    if( result == "false"){
                        $("#password_input").val("");
                        $("#bad_auth").show();
                    }
                    else{
                        window.location = "./home.php";
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
