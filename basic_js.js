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

    $("#makeappointment_button").click(function() {
        if(validateForm() == false || $("#app_select").value == null){
            alert("Please complete all fields");
        }
        else{
            var docID = $("#app_select").value; 
            var time = $("#time_input").value;
            var date = $("#date_input").value;

            $.ajax({
                type: "POST",
                url: "./app_maker.php",
                data: {docID, time, date},
                dataType: "text",

                success : function(result) {
                    alert("Appointment successfully booked");
                    window.location = "./home.php";
                },

                error : function(jqXHR, textStatus, errorThrown) {
                            console.log( errorThrown );
                            console.log("error jqXHR: " + jqXHR);
                            console.log("error textStatus: " + textStatus);
                        }  
            });

        }


    });


    //http://stackoverflow.com/questions/18907198/jquery-make-sure-all-form-fields-are-filled
    //This bit is from the above link
    function validateForm() {
        var valid = true;
        $("#app_form input[type='text']").each(function() {
            console.log( $(this).val());
            if( $(this).val() == "") 
            valid = false;
        }); 

        return valid;
    }   


});
