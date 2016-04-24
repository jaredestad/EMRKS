$(document).ready(function() {

    $("#register_button").click(function() {

        var type = document.getElementById("account_type").value;
        var code = document.getElementById("code").value;

        if(type != "patient"){

            if(type == "doctor" && code == "dcode"){
                registerUser(type);
            }
            else if(type == "nurse" && code == "ncode"){
                registerUser(type);
            }
            else if(type == "receptionist" && code == "rcode"){
                registerUser(type);
            }
            else if(type == "admin" && code =="acode"){
                registerUser(type);
            }
            else if(type == "labtester" && code == "lcode"){
                registerUser(type);   
            } 
            else{
                alert("Code not valid");
                $("#code").val("");
            }
        }
        else{
            registerUser(type);
        }


    });

    function registerUser(account_type) {
        if(validateForm() == false){
            alert("Please complete all fields");
        }
        else{

            var user_info = $("#registration_form").serialize();
            console.log(user_info);

            $.ajax({
                type: "POST",
                url: "./register_user.php",
                data: {user_info, account_type},
                type: "text",


                succes: function(result) {
                    console.log(result);

                        if(result == "bad_username"){
                            alert("Username already registered");
                        }
                        else{
                            alert("ERROR: Could not create account");
                        }


                },

                error : function(jqXHR, textStatus, errorThrown) {
                            console.log( errorThrown );
                            console.log("error jqXHR: " + jqXHR);
                            console.log("error textStatus: " + textStatus);
                        }   



            });
        }
    }

    //http://stackoverflow.com/questions/18907198/jquery-make-sure-all-form-fields-are-filled
    //This bit is from the above link
    function validateForm() {
        var valid = true;
        $("#registration_form input[type='text']").each(function() {
            console.log( $(this).val());
            if( $(this).val() == "")
            valid = false;
        });

        return valid;
    }



});

function getData(value) {

    if(value.value == "patient")
    {    
        $("#code").hide();
    }   
    else
    {   
        $("#code").show();
    }   


}
