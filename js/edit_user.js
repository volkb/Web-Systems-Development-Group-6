$('#get_info').submit(function(e){
    e.preventDefault();
    $.ajax({
        data: $('#get_info').serialize(),
        url: 'controllers/edit_controller_fillin.php',
        method: 'POST',
        success: function(data) {
            if(data =="RIN doesn't exist"){
                alert("RIN doesn't exist")
            }
            else if(data=="Did not fill in a RIN"){
                alert("Did not fill in a RIN");
            }
            else{
                var parsed = data.split(" ");
                console.log(data);
                document.getElementById('rcsID').value=parsed[0];
                document.getElementById('first').value=parsed[1];
                document.getElementById('last').value=parsed[2];
                document.getElementById('email').value=parsed[3];
                document.getElementById('rin').value=$('#lookup').val();
                document.getElementById('inlineFormCustomSelect').value=parsed[4];
            }

        }
    });
});
