
	$(document).ready(function(){
		doValidation();
	});

	function doValidation(){

		// mask some fields with desired input mask
		// use "modifyFieldWithClass" to set a css class on the fields you need to mask (e.g. phone, zip)
		$("input.phone").mask("(999) 999-9999");
		$("input.zip").mask("99999");

		//put a date picker on a field (comment this out if you do not use calendars)
		$( ".datepicker" ).datepicker({
			dateFormat: 'yy-mm-dd',
			showOn: "button",
				buttonImage: "calendar.gif",
				buttonImageOnly: true,
			onClose: function(){
				this.focus();
				//$(this).submit();
			}
		});
	}

