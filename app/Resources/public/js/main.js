
$(document).ready(function() {
	$(".col .status").sortable({
	    connectWith: '.col .status',
	    forcePlaceholderSize: true 
	}).bind('sortupdate', function(e, ui) {
		$('.col span.count').each(function() {
			$(this).text($(this).closest('.col').find('div.status').children().length);
		});
		var status = ui.item.closest('.status').attr('data-status');
		var id = ui.item.attr('data-id');
		var updateUrl = Routing.generate('issue_reorder', { 'id': id, 'status': status  });
		
		$.ajax({
			'url': updateUrl,
			'method': 'POST'
		}).done(function( msg ) {
		    
		});
	})
});