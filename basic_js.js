$(document).ready(function() {

    $("#delete_button").click(function() {

        var thoseChecked = [];

        $(".tcheck").each(function() {
            console.log($(this).value);
            thoseChecked.push($(this).value); 
        });        

        $.ajax({
            type: "POST",
            url: "./cancel_appointment.php",
            data: {thoseChecked},
            dataType: "text",

            success : function(result) {

                window.location.reload();

            },

            error : function(jqXHR, textStatus, errorThrown) {
                        console.log( errorThrown );
                        console.log("error jqXHR: " + jqXHR);
                        console.log("error textStatus: " + textStatus);
                    }   


        });


    });


});
