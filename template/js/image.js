$('.carousel-element').click(function () {
	var src = $(this).children('img').attr('src');
	$('#big-img').attr('src', src);
});

$(document).click(function () {
	var checkboxes = $('input[type=checkbox]:checked');

	if (checkboxes.length) {
		$('#delete').removeClass('disabled');
	} else {
		$('#delete').addClass('disabled');
	}
});
