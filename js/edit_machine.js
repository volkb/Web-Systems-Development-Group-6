$('#get_info').submit(function(e){
    e.preventDefault();
    $.ajax({
        data: $('#get_info').serialize(),
        url: 'controllers/edit_machine_fillin.php',
        method: 'POST',
        success: function(data) {
            if(data==="Did not select a machine"){
                alert("Did not select a machine");
            }
            else{
                var parsed = data.split(";");
                console.log(parsed);

                //set hidden field's value to the machine name
                document.getElementById('machineName').value = document.getElementById('machine').value;

                //update status field
                if(parsed[0] === 1){
                    document.getElementById('defaultStatus').selected = false;
                    document.getElementById('inService').selected = true;
                }else{
                    document.getElementById('defaultStatus').selected = false;
                    document.getElementById('OOS').selected = true;
                }

                //checks if the machine uses plastic
                if(parsed[1] === '1'){ //if it does, unhide materials fields
                    $('#materialsWrapper').toggleClass("d-none");
                    document.getElementById('mult_ext').selected = false; //display mult extrusion status
                    if(parsed[2] === '1'){//if you can handle multiple extrusions, show how many
                        document.getElementById('mult_ext_true').selected = true;
                        $('#num_ext').removeClass("d-none");
                        document.getElementById('num_ext_val').value=parsed[3];
                    }else{//else make sure that field is hidden and default it's value to 0
                        $('#num_ext').addClass("d-none");
                        document.getElementById('num_ext_val').value = 0;
                        document.getElementById('mult_ext_false').selected = true;
                    }
                }else{
                    $('#materialsWrapper').addClass("d-none");
                }
            }

        }
    });
});
document.getElementById('Materials').onchange = function() {
    if(document.getElementById('Materials').value === '0'){
        $('#num_ext').addClass("d-none");
    }else if(document.getElementById('Materials').value === '1'){
        $('#num_ext').removeClass("d-none");
    }
};

document.getElementById('addMaterials').onchange = function() {
    if(document.getElementById('addMaterials').value === '0'){
        $('#add_num_ext').addClass("d-none");
    }else if(document.getElementById('addMaterials').value === '1'){
        $('#add_num_ext').removeClass("d-none");
    }
};

document.getElementById("addMachineBtn").addEventListener("click", displayAddForm);
document.getElementById("addMachineBtn").addEventListener("mouseover", function () {
    document.getElementById("addMachineBtn").style.backgroundColor = "#563299";
});
document.getElementById("addMachineBtn").addEventListener("mouseout", function () {
    document.getElementById("addMachineBtn").style.backgroundColor = "#6f42c1";
});

document.getElementById('usesPlastic').onchange = function() {
    if(document.getElementById('usesPlastic').value === '0'){
        $('#AddMachineMaterialsWrapper').addClass("d-none");
    }else if(document.getElementById('usesPlastic').value === '1'){
        $('#AddMachineMaterialsWrapper').removeClass("d-none");
    }
};

function displayAddForm() {
    $("#addMachineFrm").toggleClass("d-none");
}