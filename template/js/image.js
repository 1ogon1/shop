$('.all-img').mouseenter(function () {
	var src = $(this).children('img').attr('src');
	$('#big-img').attr('src', src);
});

$('.adm-img').click(function () {
	var param = {
			id: $(this).data('text'),
			src: $(this).data('src')
		},
		id = $(this).data('id');
	// console.log($(this).data('id'));

	$.post('/admDelImg', param, function (data) {
		console.log(data);
		if (data) {
			$(location).attr('href', '/admin/product/update/' + id);
		}
	});
});