$(document).ready(function() {

    $(".remove_regapp").click(function() {
        var appID = $(this).attr('id');    


        $.ajax({
            type: "POST",
            url: "./cancel_appointment.php",
            data: {data1: appID},
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
    $(".remove_testapp").click(function() {
        var appID = $(this).attr('id');    


        $.ajax({
            type: "POST",
            url: "./cancel_testappointment.php",
            data: {data1: appID},
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
        console.log( $("#app_select").val());
        if(validateForm() == false || $("#app_select").val() == ""){
            alert("Please complete all fields");
        }
        else{
            var docID = $("#app_select").val(); 
            var time = $("#time_input").val();
            var date = $("#date_input").val();
            console.log(docID + " " +time +" "+date);

            $.ajax({
                type: "POST",
                url: "./app_maker.php",
                traditional: true,
                data: { data1: docID, data2: time, data3: date},
                dataType: "text",

                success : function(result) {
                    if(result == "true"){
                    alert("Appointment successfully booked");
                    window.location = "./home.php";
                    }
                    else{
                       alert("An error occurred. Please use the correct date/time formats.");
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

    $("#save_info").click(function() {
        console.log("hello?");
        if(validateForm() == false){
            alert("Please complete all fields");
        }
        else{

            var edit_info = $("#edit_info").serialize();
            console.log(edit_info);

            $.ajax({
                type: "POST",
                url: "./save_edited_info.php",
                data: {data1: edit_info},
                dataType: "text",

                success : function(result) {
                    console.log(result);
                    alert("Information successfully updated");
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
        $("input[type='text']").each(function() {
            console.log( $(this).val());
            if( $(this).val() == "") 
            valid = false;
        }); 

        return valid;
    }   


});
