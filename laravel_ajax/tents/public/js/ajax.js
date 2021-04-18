$(document).ready(function() {


	$(".btn-danger").click(function(e){
		e.preventDefault();
		pk_tent = $(this).data("pktent");

		$.ajax({
			type: "DELETE",
			url: "/deletetent",
			headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
			data: { "PK_Tent" : pk_tent },
			success: function (data)
			{
				if(data.status == '1')
				{
					$("#tent_"+ pk_tent).html( '<div class="alert alert-success" role="alert">'+data.name+'</div>' );
				}
				else
				{
					alert("Не получилось удалить " + data.name);
				}
			},
			error: function (msg) {
				alert(msg.responseJSON.message);
			},

		});
	});

	$(".btn-preview").click(function(e){
		e.preventDefault();

		pk_car = $(this).data("pkcar");

		$.ajax({
			type: "GET",
			url: "/previewcar_" + pk_car,
			success: function (data)
			{
				//успешно найдена модель в базе
				if(data.status === '1')
				{
					$('#modelInfo').text(data.modelName);
					$('#superstructureInfo').text(data.superstructure);
					$('#categoryInfo').text(data.category);
					$('#priceInfo').text(data.price);
					$('#yearInfo').text(data.year);
					$('#descriptionInfo').text(data.description);

				}
				else
				{
					//модель не была найдена
					alert("Ошибка: " + data.message);
				}
			},
			error: function(msg) {
				alert(msg.responseJSON.message);
			},
		});
	});



})
