jQuery(document).ready(function($){

	$("table tbody tr #deleteForm").on('click', '#btn_del', function(event){
		event.preventDefault();
		var button = $(this);
		var data = $('table tbody tr #deleteForm').serializeArray();
		$.ajax({
			url: $('table tbody tr #deleteForm').attr('action'),
			data: data,
			type: "POST",
			datatype: "JSON",
			headers: { "X-CSRF-TOKEN" : $("meta[name='csrf-token']").attr('content')},
			success: function(html){
				button.parents("tr").remove();
			},
			error: function(html){
				alert("ошибки");
			},
		});
	});

});