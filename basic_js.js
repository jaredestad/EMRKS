$(document).ready(function() {




    $("#patient_s").change(function(val) {
        console.log(val);
        $("#code").hide();
    });

    $("#doctor_s, #nurse_s, #recep_s").change(function() {
        $("#code").show();

    });





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

