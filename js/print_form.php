<script type="text/javascript">
$(document).ready(function(){

    $('#reprintpolicy').hide(400);

    $('#plastictype').change(
        function () {
            var current_plastic = JSON.parse($('#plastictype option:selected').val());
            var plastictype = current_plastic.type;
            if (plastictype == "Resin") {
                $('#amountlabel').text("Amount of plastic (mL):");
            }else{
                $('#amountlabel').text("Amount of plastic (g):");
            }
        });
    // If the amount of plastic is outside of the required amount then we must hide the reprint
    // policy as it does not apply.
    $('#plasticamount').change(
        function () {
            var amount = $('#plasticamount').val();
            var current_plastic = JSON.parse($('#plastictype option:selected').val());
            var plastictype = current_plastic.type;
            document.getElementById("printprice").innerHTML = "<strong>$" + (current_plastic.price * amount).toFixed(2) + "</strong>";
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
        console.log('change');
        if (document.getElementById('usersfilament').checked){
          $("#printprice").html("<strong>$0.00</strong>");
        }else{
          var amount = $('#plasticamount').val();
          var current_plastic = JSON.parse($('#plastictype option:selected').val());
          $("#printprice").html("<strong>$" + (current_plastic.price * amount).toFixed(2) + "</strong>");
        }
      });

    // Since it defaults to a 3D scanner first we trigger a change event so that the form rests in a state that we expect.


    $('#machine').change (
        function () {
            var type = $('#machine option:selected').val();
            var nonPlasticMachines = <?php echo json_encode(generateNonPlasticMachines());?>;
            // These are machines that don't handle plastic, so plastic info doesn't make sense
            if(jQuery.inArray(type,nonPlasticMachines) != -1){
                $('#plasticinfo').attr("hidden",true);
                $('#reprintpolicy').attr("hidden",true);
                $('#sectiondivider2').attr("hidden",true);
                $('#initialslabel').attr("hidden",true);
                $('#initialssmall').attr("hidden",true);
                $('#initials').attr("hidden",true);
                $('#sectiondivider1').attr("hidden",true);
            }else{
                $('#plasticinfo').removeAttr("hidden");
                $('#reprintpolicy').removeAttr("hidden");
                $('#sectiondivider2').removeAttr("hidden");
                $('#initialslabel').removeAttr("hidden");
                $('#initialssmall').removeAttr("hidden");
                $('#initials').removeAttr("hidden");
                $('#sectiondivider1').removeAttr("hidden");
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
        $("#machine").trigger("change");
 });
</script>
