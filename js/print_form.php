<script type="text/javascript">

function getLaserTime(hours,minutes){
  var hours_cost = hours * 1;
  var minutes_cost = minutes * .017;
  var cost = (hours_cost + minutes_cost).toFixed(2);
  return cost;
}

$(document).ready(function(){

    $('#plastictype').change(
        function () {
            var current_plastic = JSON.parse($('#plastictype option:selected').val());
            var plastictype = current_plastic.type;
            $('#usersfilament').trigger("change");
            if (plastictype == "Resin") {
                $('#amountlabel').text("Amount of plastic (mL)");
            }else{
                $('#amountlabel').text("Amount of plastic (g)");
            }
        });
    // If the amount of plastic is outside of the required amount then we must hide the reprint
    // policy as it does not apply.
    $('#plasticamount').change(
        function () {
            var amount = $('#plasticamount').val();
            var current_plastic = JSON.parse($('#plastictype option:selected').val());
            var plastictype = current_plastic.type;
            $('#usersfilament').trigger("change");
            if(plastictype == "Resin" && amount < 7){
                $('#reprintpolicy').show(400);
                $('#sectiondivider2').show(400);
            }else if(plastictype != "Resin" && amount < 50){
                $('#reprintpolicy').show(400);
                $('#sectiondivider2').show(400);
            }else{
                $('#reprintpolicy').hide(400);
                $('#sectiondivider2').hide(400);
            }
        });

    $('#usersfilament').change (
      function() {
        if (document.getElementById('usersfilament').checked){
          $("#cost").val("$0.00");
        }else{
          var type = $('#machine option:selected').val();
          var nonPlasticMachines = <?php echo json_encode(generateNonPlasticMachines());?>;
          if(jQuery.inArray(type,nonPlasticMachines) != -1){
            if(type=="Laser Cutter"){
              $("#cost").val("$" + getLaserTime($("#hours").val(),$("#minutes").val()));
            }else{
              $("#cost").val("$0.00");
            }
          }else{
            var amount = $('#plasticamount').val();
            var current_plastic = JSON.parse($('#plastictype option:selected').val());
            $("#cost").val("$" + (current_plastic.price * amount).toFixed(2));
          }
        }
      });

    // Since it defaults to a 3D scanner first we trigger a change event so that the form rests in a state that we expect.


    $('#machine').change (
      function () {
          var type = $('#machine option:selected').val();
          var nonPlasticMachines = <?php echo json_encode(generateNonPlasticMachines());?>;
          $('#usersfilament').trigger("change");
          // These are machines that don't handle plastic, so plastic info doesn't make sense
          if(jQuery.inArray(type,nonPlasticMachines) != -1){
              $('#plasticinfo').attr("hidden",true);
              $('#reprintpolicy').attr("hidden",true);
              $('#sectiondivider2').attr("hidden",true);
          }else{
              $('#plasticinfo').removeAttr("hidden");
              $('#reprintpolicy').removeAttr("hidden");
              $('#sectiondivider2').removeAttr("hidden");
          }
          $('.required').each(function() {
            var hidden = $(this).attr("hidden");
            if ($(this).is(":hidden")){
              $(this).removeAttr("required");
            }else {
              $(this).prop("required", "true");
            }
          });
        });

      $('#hours').change(function(){
        $('#usersfilament').trigger("change");
      });
      $('#minutes').change(function(){
        $('#usersfilament').trigger("change");
      });

      $("#machine").trigger("change");
      $('#plastictype').trigger("change");
      $('#plasticamount').trigger("change");
 });
</script>
