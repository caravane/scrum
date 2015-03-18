
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
			var quickViewUrl = ui.item.find('a.quick_view').attr('href');
		    quick_view(quickViewUrl);
		});
	});



	$('.card').mousedown(function() {
		$(this).find('a.quick_view').click();
	});
	$(".card a.quick_view").click(function(e) {
		e.stopPropagation();
		e.preventDefault();
		var quickViewUrl=$(this).attr('href');
		quick_view(quickViewUrl);
	});

	$('a.create_issue').click(function(e) {
		e.preventDefault();
		modalIssue($(this).attr('href'));
	});

});


function quick_view(url) {
	$.ajax({
		'url': url,
		'method': 'GET'
	}).done(function(data) {
		$('#quick_view').html(data);
		$('#quick_view a.issue_edit').click(function(e) {
			e.preventDefault();
			modalIssue($(this).attr('href'));
		});
	});
}


function modalIssue(url) {
	$.ajax({
		'url': url,
		'method': 'GET'
	}).done(function(data) {
		$('#issueModal .modal-body').html(data);
		$('#issueModal').modal()
	});
	
}	

	