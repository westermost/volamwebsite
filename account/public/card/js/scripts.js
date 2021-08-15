$(function() {
	"use strict";
	
	$("#submit").on("click", function(e) {
		
		e.preventDefault();
		
		$(this).attr('disabled', true);
		
		var type = $("#selectType").val();
		var serial = $("#inputSerial").val();
		var code = $("#inputCode").val();
		var amount = $("#selectAmount").val();
		
		$("#selectType").removeClass('is-invalid');
		$("#inputSerial").removeClass('is-invalid');
		$("#inputCode").removeClass('is-invalid');
		$("#selectAmount").removeClass('is-invalid');
		
		$("#type").text();
		$("#serial").text();
		$("#code").text();
		$("#amount").text();
		
		$(".alert").removeClass("alert-danger");
		$(".alert").removeClass("alert-success");
		$(".alert").text();			
		
		$.ajax({
			method: "POST",
			url: 'card.php',
			data: {
				type: type,
				serial: serial,
				code: code,
				amount: amount
			}
		})
		.done(function(data) {
			
			var res = JSON.parse(data);
			
			if (res.success === 1) {
				$(".alert").addClass("alert-info");
				
				$(".alert").text('Gửi yêu cầu nạp thẻ thành công. Vui lòng chờ ít phút để hệ thống xác minh thẻ cào.');
				
				$("#selectType").val('');
				$("#inputSerial").val('');
				$("#inputCode").val('');
				$("#selectAmount").val('');
				
			} else {				
				$.each(res, function(key, value) {
					$("input[name=" + key).addClass('is-invalid');
					$("select[name=" + key).addClass('is-invalid');
					
					$("#" + key).text(value);
					
					if(key === 'merchant_id') {
						$(".alert").addClass("alert-danger");
						$(".alert").text(value);				
					}

					if(key === 'secret_key') {
						$(".alert").addClass("alert-danger");
						$(".alert").text(value);				
					}						
				});
							
			}
			
			$("#submit").attr('disabled', false);
			
		})
		.fail(function(res) {
			
			var data = jQuery.parseJSON(res.responseText);
			
			$(".alert").addClass("alert-danger");
			$(".alert").text(data);
			
			$("#submit").attr('disabled', false);	
		});
	});	
});