$('#get_info').submit(function(e){
    e.preventDefault();
    $.ajax({
        data: $('#get_info').serialize(),
        url: 'controllers/edit_machine_fillin.php',
        method: 'POST',
        success: function(data) {
            if(data =="Did not select a machine"){
                alert("Did not select a machine");
            }
            else if(data=="Machine doesn't exist"){
              alert("Did not select a machine");
            }
            else{
                var parsed = data.split(";");
                console.log(data);
                document.getElementById('name').value=$('#machine').val();
                document.getElementById('usage').value=parsed[0];
                document.getElementById('status').value=parsed[1];
                document.getElementById('plastic').value=parsed[2];
                document.getElementById('ext').value=parsed[3];
                document.getElementById('num_ext').value=parsed[4];
            }
        }
      });
});


$("#addMachineBtn").click(function(){
  $("#addMachineFrm").removeClass("d-none");
});
