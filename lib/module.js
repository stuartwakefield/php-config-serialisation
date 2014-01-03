(function() {

	var module = {
		handle: function(el, config) {
			$.getJSON('ajax.php', {
				'config': config
			}).done(function(data) {
				$(el).trigger({
					type: 'module-data',
					html: data.html
				});
			});
		}
	};

	$(function() {

		$('.module').each(function(i, el) {
			var config = $(el).data('config');

			$('<strong/>')
				.text(config.siteId + '/' + config.forumId)
				.appendTo(el)
				.after(' ');
			$('<span/>')
				.text(config.ratings === false ?
					'Comments are disabled' :
					'Comments are enabled')
				.appendTo(el)
				.after(' ');
			$('<span/>')
				.text(config.preset)
				.appendTo(el);
			
			$(el).on('click', '.module-trigger', function(e) {
				module.handle(el, config);
				e.stopPropagation();
				e.preventDefault();
				return false;
			});

			$(el).on('submit', 'form', function(e) {
				$.post('post.php', $(e.target).serialize());
				e.stopPropagation();
				e.preventDefault();
				return false;
			});

			$(el).on('module-data', function(e) {
				console.log('e:module-data', e.html);
				$(el).append(e.html);	
			});
			
		});
	});
})();
