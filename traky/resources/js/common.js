$(document).ready(function(){
		
	//setting of corporation status
	$('input.is_corp').click(function(){
		$('.stock_status').css('display','block');
	});
	$('input.is_single').click(function(){
		$('.stock_status').css('display','none');
	});
	
	
		
	//Initialize Select2 Elements
        $( "#tax_select_multiple" ).select2({
            placeholder: 'Add a tax type',
            allowClear: true
        });
        
        $('.js-programmatic-enable').on('click', function(){
            $( "#tax_select_multiple" ).prop('disabled', false);
        });
        $('.js-programmatic-disable').on('click', function(){
            $( "#tax_select_multiple" ).prop('disabled', true);
        });
        $.fn.select2.defaults.set("theme", "classic");
	
	$('button#backtolist').click(function(){
		window.location.replace("http://192.168.254.5/traky/index.php");
	});
	
	        
        //client table list
        $("#example1").DataTable();
        $("#taxtype-datatable").DataTable();
        
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
        
        //Date range picker
        $('#taxes-due-date').datepicker( {
            format: "MM yyyy",
            startView: "months", 
            minViewMode: "months",
            autoclose: true
        });
        $('#taxPaymentPeriod').datepicker( {
            format: "MM yyyy",
            startView: "months", 
            minViewMode: "months",
            autoclose: true
        });
        $('#client-started').datepicker( {
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('#tax-paid').datepicker( {
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('#taxPaymentDateFiled').datepicker( {
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('#end-date').datepicker( {
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('#start-date').datepicker( {
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        
        $('#taxes-filing-date').datepicker( {
            format: "MM yyyy",
            startView: "months", 
            minViewMode: "months",
            autoclose: true
        });
        $('#taxPaymentDateFiled').datepicker( {
            format: "MM yyyy",
            startView: "months", 
            minViewMode: "months",
            autoclose: true
        });
        
        $("#start-time").timepicker({
                template: 'dropdown',
                maxHours: 24,
                showMeridian: false,
                showSeconds: true,
                defaultTime: false
            });
        $("#end-time").timepicker({
                template: 'dropdown',
                maxHours: 24,
                showMeridian: false,
                showSeconds: true,
                defaultTime: false
            });
        
        //select multiple for searching of tax
        $( "#tax_to_view" ).select2();
        
        $("#all-day").click(function(){
            
                $(".not-all-day").toggle();
           
        });
       
       
       $(".tax-to-pay").click(function(){
           var tax_id = $(this).attr('id');
           
//           $("#form-pay-tax #taxPaymentID").val(tax_id);
            $("#form-pay-tax").children().eq(2).children().eq(1).val(tax_id);
           
            $("#form-pay-tax input[name=amount]").val('').attr('disabled', false);
            $("#form-pay-tax input[name=date_filed]").val('').attr('disabled', false);
            $("#form-pay-tax input[name=period]").val('').attr('disabled', false);
            $("#form-pay-tax input[name=bank]").val('').attr('disabled', false);        
           
           if($(this).hasClass('btn-success')){
               $("#tax-modal").removeClass('modal-danger');
               $("#tax-modal").addClass('modal-success');
               
               $("#tax-modal .modal-dialog").removeClass('modal-sm');
               $("#tax-modal .modal-dialog").addClass('modal-lg');
               
               //get info about these
               var info = $(this).next().val();
               var result = info.split("/");
               
               $("#form-pay-tax #taxPaymentID").val(result[0]);
               $("#form-pay-tax input[name=amount]").val(result[1]).attr('disabled', true);
               $("#form-pay-tax input[name=date_filed]").val(result[2]).attr('disabled', true);
               $("#form-pay-tax input[name=period]").val(result[4]).attr('disabled', true);
               $("#form-pay-tax input[name=bank]").val(result[3]).attr('disabled', true);
               if(result[5] == 'on-hand'){
                   $("#form-pay-tax").children().eq(7).children().eq(1).children().eq(0).addClass("active").children().eq(0).attr('readonly', true);
//                   $("#form-pay-tax input[value='on-hand']").parent().attr('readonly', true);
//                   $("#form-pay-tax input[value='client']").parent().addClass('hide');
                   $("#form-pay-tax").children().eq(7).children().eq(1).children().eq(1).addClass('hide');
                   
               }else if(result[5] == 'client'){
//                   $("#form-pay-tax input[value='on-hand']").parent().addClass('hide');
//                   $("#form-pay-tax input[value='client']").parent().attr('readonly', true);
                    $("#form-pay-tax").children().eq(7).children().eq(1).children().eq(0).addClass('hide');
                    $("#form-pay-tax").children().eq(7).children().eq(1).children().eq(1).addClass("active").children().eq(0).attr('readonly', true);
               }
               
               $(".modal-footer button.btn-primary").hide();
               
           } else if($(this).hasClass('btn-warning')){
               $("#tax-modal").removeClass('modal-danger');
               $("#tax-modal").addClass('modal-warning');
               
               $("#tax-modal .modal-dialog").removeClass('modal-sm');
               $("#tax-modal .modal-dialog").addClass('modal-lg');
               
               //get info about these
               var info = $(this).next().val();
               var result = info.split("/");
               
               $("#form-pay-tax #taxPaymentID").val(result[0]);
               $("#form-pay-tax input[name=amount]").val(result[1]).attr('disabled', true);
               $("#form-pay-tax input[name=date_filed]").val(result[2]).attr('disabled', true);
               $("#form-pay-tax input[name=period]").val(result[4]).attr('disabled', true);
               $("#form-pay-tax input[name=bank]").val(result[3]).attr('disabled', true);
               if(result[5] == 'on-hand'){
                   $("#form-pay-tax").children().eq(7).children().eq(1).children().eq(0).addClass("active").children().eq(0).attr('readonly', true);
//                   $("#form-pay-tax input[value='on-hand']").parent().attr('readonly', true);
//                   $("#form-pay-tax input[value='client']").parent().addClass('hide');
                   $("#form-pay-tax").children().eq(7).children().eq(1).children().eq(1).addClass('hide');
                   
               }else if(result[5] == 'client'){
//                   $("#form-pay-tax input[value='on-hand']").parent().addClass('hide');
//                   $("#form-pay-tax input[value='client']").parent().attr('readonly', true);
                    $("#form-pay-tax").children().eq(7).children().eq(1).children().eq(0).addClass('hide');
                    $("#form-pay-tax").children().eq(7).children().eq(1).children().eq(1).addClass("active").children().eq(0).attr('readonly', true);
               }
               
               $(".modal-footer button.btn-primary").hide();
               
           } else {
               $("#tax-modal").removeClass('modal-success');
               $("#tax-modal").removeClass('modal-warning');
               $("#tax-modal").addClass('modal-danger');
               
               $("#tax-modal .modal-dialog").removeClass('modal-lg');
               $("#tax-modal .modal-dialog").addClass('modal-sm');
               
               $("#form-pay-tax input[name=amount]").val('').attr('disabled', false);
               $("#form-pay-tax input[name=date_filed]").val('').attr('disabled', false);
               $("#form-pay-tax input[name=period]").val('').attr('disabled', false);
               $("#form-pay-tax input[name=bank]").val('').attr('disabled', false);
               
               $("#form-pay-tax").children().eq(7).children().eq(1).children().eq(0).removeClass('hide');
               $("#form-pay-tax").children().eq(7).children().eq(1).children().eq(1).removeClass('hide');
               
               $(".modal-footer button.btn-primary").show();
           }
       });
       
       $(".delete-client").click(function(){
           var url = $(this).attr('id'),
                client = $(this).parent().next().next().text();
            
            $("div#del_client_modal form#del_client").attr('action', url);
            $("div#del_client_modal h3#del_client").text(client+'?');
       });
       
       $("button.close").click(function(){
           $("div.example-modal").hide();
       });
});

	function printDiv(divName) {
		 var printContents = document.getElementById(divName).innerHTML;
		 var originalContents = document.body.innerHTML;

		 document.body.innerHTML = printContents;

		 window.print();

		 document.body.innerHTML = originalContents;
	}