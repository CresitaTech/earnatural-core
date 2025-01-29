
    <!--========== MAIN JS ==========-->


    <script src="<?=base_url('public/js/main.js')?>"></script>

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="<?=base_url('public/js/jquery-3.3.1.slim.min.js')?>"></script>
    <!-- Popper.JS -->

    <script src="<?=base_url('public/js/popper.min.js')?>"></script>
    <!-- Bootstrap JS -->
    <script src="<?=base_url('public/js/bootstrap.min.js')?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<!--========== data table ==========-->

<script>
$(function() 
{
 $( "#start_date" ).datepicker({
 dateFormat : 'yy-mm-dd'
 }); 
 $( "#expire_date" ).datepicker({
 dateFormat : 'yy-mm-dd'
 }); 
 $( "#edit_start_date" ).datepicker({
 dateFormat : 'yy-mm-dd'
 }); 
 $( "#edit_expire_date" ).datepicker({
 dateFormat : 'yy-mm-dd'
 }); 
});
</script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
		
			axios.get('/api/product/').then((response) => {
			console.log(response.data);
			for(var i=0; i < response.data.length; i++){
				var $option = $('<option></option>').html(response.data[i].name).attr('value', response.data[i].id).prop('selected', true);
				$('.product_name').append($option); // Adds the new option as last option
			}
			$(".product_price").val(response.data[0].unitPrice);
			
			}, (error) => {
				console.log(error);
			});
        });

    function calculateUnitPrice(perType){
		console.log('---------: ' + perType)
		var product_price = $(".product_price").val();
		var promocode_discount = $("#edit_promocode_discount").val();
		if(perType=='Percentage'){
			console.log(promocode_discount);
			$('#edit_unit_price').val((product_price - Math.round(parseFloat(product_price * (promocode_discount / 100)))).toFixed(2));
		}else{
			console.log(promocode_discount); 
			$('#edit_unit_price').val((product_price - promocode_discount).toFixed(2));
		}
	}

    function edit_promocode(id){
        console.log(id)
        
        axios.get('/api/promocodes/'+id)
        .then(function (response) {
            var res = JSON.parse(JSON.stringify(response.data.data));
            console.log("=======: "+ JSON.stringify(res))

            console.log("=======: "+res.promocode_title)
            $("#id").val(res.id);

            $("#edit_promocode_title").val(res.promocode_title);
            $("#edit_promocode_discount").val(res.promocode_discount);
            $("#edit_promocode_type").val(res.promocode_type);
            $("#edit_promocode").val(res.promocode);
            $("#edit_status").val(res.status);
            $("#edit_start_date").val(res.start_date);
            $("#edit_expire_date").val(res.expire_date);
            $("#edit_remark").val(res.remark);
			$("#edit_unit_price").val(res.unit_price);
            //$('#promocodeModel').modal("show");

        })
        .catch(function (error) {
            if (error.response) { // get response with a status code not in range 2xx
                console.log(error.response.status);
            } else if (error.request) { // no response
                console.log(error.request);
            } else { // Something wrong in setting up the request
                console.log('Error', error.message);
            }
            console.log(error.config);
        });

    }

    $(function () {

$('#editPromo').on('click', function (e) {

  e.preventDefault();

  $.ajax({
    type: 'post',
    url: 'post.php',
    data: $('#editPromocode').serialize(),
    success: function () {
      alert('form was submitted');
    }
  });

});



});
        </script>
     
  <script src="<?=base_url('public/datatable/jquery.dataTables.min.js')?>"></script> 
       <script src="<?=base_url('public/datatable/dataTables.bootstrap4.min.js')?>"></script> 

       <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
        </script>
</body>

</html>