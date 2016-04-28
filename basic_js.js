$(document).ready(function() {

    $("#setinsurance_button").click(function() {
        if(validateForm() == false){
            alert("Please complete all fields");
        }
        else{
            var id = $("#id_getter")[0].value;

            var card = $("#cardno")[0].value;
            var company = $("#conam")[0].value;
            var phone = $("#cono")[0].value;
            

            $.ajax({
                type: "POST",
                url: "./add_insurance.php",
                traditional: true,
                data: {data1: card, data2: company, data3: phone, data4: id},
                dataType: "text",

            success : function(result) {
                if(result == "true"){
                    alert("Information succesfully updated");
                    window.location = "./home.php";
                }
                else{
                    alert("Could not update information");
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
    $("#add_allergy").click(function() {
        var id = $("#id_getter")[0].value;
        var allergy = $("#allergy_input")[0].value;

        $.ajax({
            type: "POST",
            url: "./add_allergy.php",
            data: {data1: id, data2:allergy},
            dataType: "text",

            success : function(result) {
                if(result == "true"){
                    window.location.reload();

                }
                else{
                    alert("Could not update entry");
                }


            },

            error : function(jqXHR, textStatus, errorThrown) {
                        console.log( errorThrown );
                        console.log("error jqXHR: " + jqXHR);
                        console.log("error textStatus: " + textStatus);
                    }   


        });
    });
    $(".confirm_ledit").click(function() {
        var id = $(this).attr("id");
        var $trparent = $(this).closest("tr");

        $trparent.find(".hidder").show();
        $trparent.find(".shower").hide();
        
        var results = $trparent.find("#cresults")[0].value;
        


        if(checkVis() == true)
        document.getElementById("maindiv").style.width = "300px";

        $.ajax({
            type: "POST",
            url: "./labtest_updater.php",
            data: {data1: id, data2: results},
            dataType: "text",

            success : function(result) {
                if(result == "true"){
        $trparent.find("#oresults")[0].innerHTML = results;

                }
                else{
                    alert("Could not update entry");
                }


            },

            error : function(jqXHR, textStatus, errorThrown) {
                        console.log( errorThrown );
                        console.log("error jqXHR: " + jqXHR);
                        console.log("error textStatus: " + textStatus);
                    }   


        });
    });
    $(".cancel_ledit").click(function() {
        var id = $(this).attr("id");
        var $trparent = $(this).closest("tr");

        $trparent.find(".hidder").show();
        $trparent.find(".shower").hide();
        if(checkVis() == true)
            document.getElementById("maindiv").style.width = "300px";
        var results = $trparent.find("#oresults")[0].innerHTML;

        $trparent.find("#cresults")[0].value = results;

    });
    $(".edit_hist").click(function() {
        var id = $(this).attr("id");
        var $trparent = $(this).closest("tr");
        $trparent.find(".hidder").hide();
        $trparent.find(".shower").show();
        document.getElementById("maindiv").style.width = "800px";


    });
    $(".confirm_medit").click(function() {
        var id = $(this).attr("id");
        var $trparent = $(this).closest("tr");

        $trparent.find(".hidder").show();
        $trparent.find(".shower").hide();
        
        var symp = $trparent.find("#csymptom")[0].value;
        var treat = $trparent.find("#ctreatment")[0].value;
        


        if(checkVis() == true)
        document.getElementById("maindiv").style.width = "300px";

        $.ajax({
            type: "POST",
            url: "./med_updater.php",
            data: {data1: id, data2: symp, data3: treat},
            dataType: "text",

            success : function(result) {
                if(result == "true"){
        $trparent.find("#osymptom")[0].innerHTML = symp;
        $trparent.find("#otreatment")[0].innerHTML = treat;

                }
                else{
                    alert("Could not update entry");
                }


            },

            error : function(jqXHR, textStatus, errorThrown) {
                        console.log( errorThrown );
                        console.log("error jqXHR: " + jqXHR);
                        console.log("error textStatus: " + textStatus);
                    }   


        });
    });
    $(".cancel_medit").click(function() {
        var id = $(this).attr("id");
        var $trparent = $(this).closest("tr");

        $trparent.find(".hidder").show();
        $trparent.find(".shower").hide();
        if(checkVis() == true)
            document.getElementById("maindiv").style.width = "300px";
        var symp = $trparent.find("#osymptom")[0].innerHTML;
        var treat = $trparent.find("#otreatment")[0].innerHTML;

        $trparent.find("#csymptom")[0].value = symp;
        $trparent.find("#ctreatment")[0].value = treat;

    });

    $(".cancel_edit").click(function() {
        var id = $(this).attr("id");
        var $trparent = $(this).closest("tr");

        $trparent.find(".hidder").show();
        $trparent.find(".shower").hide();
        if(checkVis() == true)
            document.getElementById("maindiv").style.width = "300px";
        var height = $trparent.find("#oheight")[0].innerHTML;
        var weight = $trparent.find("#oweight")[0].innerHTML;
        var blood = $trparent.find("#oblood")[0].innerHTML;
        $trparent.find("#cheight")[0].value = height;
        $trparent.find("#cweight")[0].value = weight;
        $trparent.find("#cblood")[0].value = blood;

    });
    $(".confirm_pedit").click(function() {
        var id = $(this).attr("id");
        var $trparent = $(this).closest("tr");

        $trparent.find(".hidder").show();
        $trparent.find(".shower").hide();
        
        var height = $trparent.find("#cheight")[0].value;
        var weight = $trparent.find("#cweight")[0].value;
        var blood = $trparent.find("#cblood")[0].value;



        if(checkVis() == true)
        document.getElementById("maindiv").style.width = "300px";

        $.ajax({
            type: "POST",
            url: "./phy_updater.php",
            data: {data1: id, data2: height, data3: weight, data4: blood},
            dataType: "text",

            success : function(result) {
                if(result == "true"){
        $trparent.find("#oheight")[0].innerHTML = height;
        $trparent.find("#oweight")[0].innerHTML = weight;
        $trparent.find("#oblood")[0].innerHTML = blood;

                }
                else{
                    alert("Could not update entry");
                }


            },

            error : function(jqXHR, textStatus, errorThrown) {
                        console.log( errorThrown );
                        console.log("error jqXHR: " + jqXHR);
                        console.log("error textStatus: " + textStatus);
                    }   


        });

    });
    $(".remove_regapp").click(function() {
        var appID = $(this).attr('id');    
        var type = $("#hidden_type").val();

        $.ajax({
            type: "POST",
            url: "./cancel_appointment.php",
            data: {data1: appID, data2: type},
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
    
    $("#confirm_labtestbutton").click(function() {
        console.log("working");

        var lookatid = $("#id_getter").val();
        var results = $("#result").val();

        $.ajax({
            type: "POST",
            url: "./labresult_maker.php",
            data: {data1: lookatid, data2: results},
            dataType: "text",

            success : function(result) {

                if(result == "true"){
                    window.location.reload();
                }
                else{
                    alert("Entry was not created");
                    window.location.reload();

                }

            },

            error : function(jqXHR, textStatus, errorThrown) {
                        console.log( errorThrown );
                        console.log("error jqXHR: " + jqXHR);
                        console.log("error textStatus: " + textStatus);
                    }   
            });

    });
    $("#confirm_physhistbutton").click(function() {
        console.log("working");

        var lookatid = $("#id_getter").val();
        var height = $("#height").val();
        var weight = $("#weight").val();
        var blood_type = $("#blood_type").val();

        $.ajax({
            type: "POST",
            url: "./phyrec_maker.php",
            data: {data1: lookatid, data2: height, data3: weight, data4: blood_type},
            dataType: "text",

            success : function(result) {

                if(result == "true"){
                    alert("Entry created");
                    window.location.reload();
                }
                else{
                    alert("Entry was not created");
                    window.location.reload();

                }

            },

            error : function(jqXHR, textStatus, errorThrown) {
                        console.log( errorThrown );
                        console.log("error jqXHR: " + jqXHR);
                        console.log("error textStatus: " + textStatus);
                    }   
            });

    });
    $("#confirm_medhistbutton").click(function() {
        console.log("working");

        var lookatid = $("#id_getter").val();
        var symptom = $("#symptom").val();
        var treatment = $("#treatment").val();

        $.ajax({
            type: "POST",
            url: "./medrec_maker.php",
            data: {data1: lookatid, data2: treatment, data3: symptom},
            dataType: "text",

            success : function(result) {

                if(result == "true"){
                    alert("Entry created");
                    window.location.reload();
                }
                else{
                    alert("Entry was not created");
                    window.location.reload();

                }

            },

            error : function(jqXHR, textStatus, errorThrown) {
                        console.log( errorThrown );
                        console.log("error jqXHR: " + jqXHR);
                        console.log("error textStatus: " + textStatus);
                    }   
            });

    });
    $("#confirm_prescriptionbutton").click(function() {
        console.log("working");

        var lookatid = $("#id_getter").val();
        var tradename = $("#tradename").val();
        var quantity = $("#quantity").val();

        $.ajax({
            type: "POST",
            url: "./presc_maker.php",
            data: {data1: lookatid, data2: tradename, data3: quantity},
            dataType: "text",

            success : function(result) {

                if(result == "true"){
                    alert("Prescription created");
                    window.location.reload();
                }
                else{
                    alert("Prescription was not created");
                    window.location.reload();

                }

            },

            error : function(jqXHR, textStatus, errorThrown) {
                        console.log( errorThrown );
                        console.log("error jqXHR: " + jqXHR);
                        console.log("error textStatus: " + textStatus);
                    }   
            });

    });

    $(".pat_link").click(function() {
        var uID = $(this).attr('id');    


        $.ajax({
            type: "POST",
            url: "./view_personal_information.php",
            data: {data1: uID},
            dataType: "text",

            success : function(result) {
                window.location = "./view_personal_information.php";

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

    $("#makelabtestapp_button").click(function() {
        console.log( $("#app_select").val());
        if(validateForm() == false || $("#app_select").val() == ""){
            alert("Please complete all fields");
        }
        else{
            var testerID = $("#app_select").val(); 
            var time = $("#time_input").val();
            var date = $("#date_input").val();
            var patID = $("#get_patID").val();
            console.log(testerID + " " +time +" "+date+" " +patID);

            $.ajax({
                type: "POST",
                url: "./labapp_maker.php",
                traditional: true,
                data: { data1: testerID, data2: time, data3: date, data4: patID},
                dataType: "text",

                success : function(result) {
                    if(result == "true"){
                    alert("Appointment successfully booked");
                    window.location = "./home.php";
                    }
                    else{
                       alert("An error occurred. Please use the correct date/time formats.");
                       window.location.reload();
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
    function checkVis() {
        var answer = true;
        $(".shower").each(function() {
            if($(this).is(":visible"))
                    answer = false;
        });
        return answer;
    }



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
