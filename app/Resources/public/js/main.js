
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



	$(".col div.status a.quick_view").click(function(e) {
		e.preventDefault();
		var url=$(this).attr('href');
		$.ajax({
			'url': url,
			'method': 'GET'
		}).done(function(data) {
			$('#quick_view').html(data);
		});
	});

});