$(function () {
	let createNewTableLine = function (data) {
		let template = '<tr data-id="' + data.id + '" class="js-line-container js-id-' + data.id + '">';
		template += '<td class="js-title">' + data.title + '</td>';
		template += '<td class="js-description">' + data.description + '</td>';
		template += '<td class="js-assigned_to">' + data.assigned_to + '</td>';
		template += '<td class="js-assigned_by">' + data.assigned_by + '</td>';
		template += '<td class="js-when"">' + data.when + '</td>';
		template += '<td class="js-duration">' + data.duration + '</td>';
		template += '<td class="js-done">' + (!data.done ? 'No' : 'Yes') + '</td>';
		template += '<td><button class="btn btn-success btn-sm js-edit">Edit</button>';
		template += '<button class="btn btn-danger btn-sm js-delete">Delete</button></td>';
		template += '</tr>';
		$('tbody').append(template);
		$('tbody')
			.find('.js-no-items')
			.remove();
	}
	let updateTableLine = function (data) {
		$('.js-id-' + data.id)
			.find('.js-title')
				.text(data.title)
				.end()
			.find('.js-description')
				.text(data.description)
				.end()
			.find('.js-assigned_to')
				.text(data.assigned_to)
				.end()
			.find('.js-assigned_by')
				.text(data.assigned_by)
				.end()
			.find('.js-when')
				.text(data.when)
				.end()
			.find('.js-duration')
				.text(data.duration)
				.end()
			.find('.js-done')
				.text(!data.done ? "No" : "Yes")
				.end();
	}
	let removeTableLine = function (taskId) {
		$('.js-id-' + taskId).remove();
	}
	$('.js-create').on('click', function (event) {
		event.preventDefault();
		$('.js-form-modal')
			.data('action', 'create')
			.modal('show');
		$('.js-form-modal .js-done-group')
			.hide()
			.find('#done')
				.prop('disabled', true);
		$('.js-modal-title').text('Create new task');
		$('.js-form-modal .js-form-task')[0].reset();
	});
	$('tbody').on('click', '.js-edit', function (ev) {
		let container = $(this).parents('tr');
		ev.preventDefault();
		$('.js-form-modal')
			.data('action', 'edit')
			.data('taskId', container.data('id'))
			.modal('show');
		$('.js-form-modal .js-done-group')
			.show()
			.find('#done')
				.prop('disabled', false);
		$('.js-modal-title').text('Edit task');
		$('.js-form-modal .js-form-task')
			.find('input[name="title"]')
				.val(container.find('.js-title').text())
				.end()
			.find('textarea[name="description"]')
				.val(container.find('.js-description').text())
				.end()
			.find('input[name="assigned_by"]')
				.val(container.find('.js-assigned_by').text())
				.end()
			.find('input[name="assigned_to"]')
				.val(container.find('.js-assigned_to').text())
				.end();
	});
	$('tbody').on('click', '.js-delete', function (event) {
		let container = $(this).parents('tr'),
			id = container.data('id');
		event.preventDefault();
		$.ajax({
			url: baseUrl + '/api/task/' + id,
			method: 'DELETE'
		})
		.done(function (response) {
			removeTableLine(id);
			alert('Task successfully deleted.');
		})
		.fail(function (response) {
			alert('There was an error with the task removal.');
		});
	});
	$('.js-form-modal .js-send-form').on('click', function () {
		let formData = $('.js-form-modal .js-form-task').serialize(),
			action = $('.js-form-modal').data('action'),
			sendButton = $(this);
		sendButton.addClass('disabled');
		if (action === 'create') {
			$.post(baseUrl + '/api/task', formData)
				.done(function (response) {
					createNewTableLine(response);
					alert('Task successfully created.');
					$('.js-form-modal').modal('hide');
				})
				.fail(function (response) {
					alert('There was an error with the task creation: ' + response.message);
				})
				.always(function () {
					sendButton.removeClass('disabled');
				});
		} else if (action === 'edit') {
			let id = $('.js-form-modal').data('taskId')
			$.ajax({
				url: baseUrl + '/api/task/' + id,
				data: formData,
				method: 'PUT'
			})
			.done(function (response) {
				updateTableLine(response);
				alert('Task successfully edited.');
				$('.js-form-modal').modal('hide');
			})
			.fail(function (response) {
				alert('There was an error with the task update');
			})
			.always(function () {
				sendButton.removeClass('disabled');
			});
		}
	});
});