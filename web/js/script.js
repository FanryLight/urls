function sendURLs() {
	var data = $('#area').val();
	if (!data) {
		$('#error').html('Error: No data given');
		$('#error').show();
		return;
	}
	$('#error').hide();
	$("#result tbody").empty();
	$.ajax({
		url : 'sender/send',
		type : 'POST',
		data : {'data' : JSON.stringify(data)},
		dataType : "json",
		success : function(data, textStatus){
			if (data.error) {
				$('#error').html('Error: Wrong data given');
				$('#error').show();
				return;
			}
			$.each(data, function (index, item){
				$("#result").find('tbody')
					.append($('<tr>')
						.append($('<td>')
							.text(item.path)
						)
						.append($('<td>')
							.attr('id', 'code' + item.id)
							.append($('<img>')
								.attr('src', 'web/images/loading.gif')
								.text('Loading')
						))
						.append($('<td>')
							.attr('id', 'title' + item.id)
							.append($('<img>')
								.attr('src', 'web/images/loading.gif')
								.text('Loading')
							)
						)
					);
				check(item.id);
			})
		},
		error : function(data, textStatus){
			$('#error').html('Error: Something went wrong');
			$('#error').show();
		},
	})
}

function check(id) {
	$.ajax({
		url : 'sender/check/?id=' + id,
		dataType : 'json',
		type : 'GET',
		success : function (data, textStatus) {
			if (data.error) {
				$('#error').html('Error: Something went wrong');
				$('#error').show();
				return;
			}
			if (data.code) {
				$('#code' + id).html(data.code);
				console.log($('code' + id));
				$('#title' + id).html(data.title);
			} else {
				setTimeout(function() {
					check(id);
				}, 2000)
			}
		}
	});
}