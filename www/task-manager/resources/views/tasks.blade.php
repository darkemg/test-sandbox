<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task Manager</title>
        <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}" />
    </head>
	<body>
		<div class="container">
        	<h1>Task Manager</h1>
        	<table class="table table-striped">
        		<thead>
        			<tr>
        				<th>Title</th>
        				<th>Description</th>
        				<th>Assigned To</th>
        				<th>Assigned By</th>
        				<th>When</th>
        				<th>Duration (min.)</th>
        				<th>Done?</th>
        				<th>Actions</th>
        			</tr>
        		</thead>
        		<tbody>
        			@forelse ($tasks as $task)
        			<tr data-id="{{ $task->id}}" class="js-line-container js-id-{{ $task->id }}">
        				<td class="js-title">{{ $task->title }}</td>
        				<td class="js-description">{{ $task->description }}</td>
        				<td class="js-assigned_to">{{ $task->assigned_to }}</td>
        				<td class="js-assigned_by">{{ $task->assigned_by }}</td>
        				<td class="js-when">{{ $task->when }}</td>
        				<td class="js-duration">{{ $task->duration }}</td>
        				<td class="js-done">
        					@if ($task->done === 0)
        						No
        					@else
        						Yes
        					@endif
    					</td>
        				<td>
        					<button class="btn btn-success btn-sm js-edit">Edit</button>
        					<button class="btn btn-danger btn-sm js-delete">Delete</button>
        				</td>
    				</tr>
    				@empty
    				<tr class="js-no-items">
    					<td colspan="8">No tasks</td>
    				</tr>
    				@endforelse
        		</tbody>
        		<tfoot>
        			<tr>
        				<td colspan="8"><button class="btn btn-primary js-create">Create new task</button></td>
    				</tr>
        		</tfoot>
        	</table>
    	</div>
    	<div class="modal js-form-modal" tabindex="-1" role="dialog">
  			<div class="modal-dialog" role="document">
    			<div class="modal-content">
      				<div class="modal-header">
        				<h5 class="modal-title js-modal-title"></h5>
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          					<span aria-hidden="true">&times;</span>
        				</button>
      				</div>
      				<div class="modal-body">
        				<form class="js-form-task">
                        	<div class="form-group">
                            	<label for="title" id="titleLabel">Title</label>
                            	<input type="text" class="form-control" id="title"name="title" aria-describedby="titleLabel">
                          	</div>
                          	<div class="form-group">
                            	<label for="description" id="descriptionLabel">Description</label>
                            	<textarea class="form-control" id="description" name="description" aria-describedby="descriptionLabel" rows="3"></textarea>
                      		</div>
                      		<div class="form-group">
                            	<label for="assignedTo" id="assignedToLabel">Assigned To</label>
                            	<input type="text" class="form-control" id="assignedTo" name="assigned_to" aria-describedby="assignedToLabel">
                          	</div>
                          	<div class="form-group">
                            	<label for="assignedBy" id="assignedToLabel">Assigned By</label>
                            	<input type="text" class="form-control" id="assignedBy" name="assigned_by" aria-describedby="assignedByLabel">
                          	</div>
                          	<div class="form-group">
                            	<label for="assignedTo" id="whenLabel">When</label>
                            	<input type="text" class="form-control" id="when" name="when" aria-describedby="whenLabel">
                          	</div>
                          	<div class="form-group">
                            	<label for="duration" id="durationLabel">Duration</label>
                            	<input type="text" class="form-control" id="duration" name="duration"  aria-describedby="durationLabel">
                          	</div>
                          	<div class="form-group form-check js-done-group">
                            	<input type="checkbox" class="form-check-input" id="done" name="done">
                            	<label class="form-check-label" for="done">Done?</label>
                          	</div>
                        </form>
      				</div>
      				<div class="modal-footer">
        				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        				<button type="button" class="btn btn-primary js-send-form">Save changes</button>
      				</div>
				</div>
			</div>
		</div>
		<script src="{{ URL::asset('assets/js/jquery-3.5.0.min.js') }}"></script>
    	<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    	<script src="{{ URL::asset('assets/js/moment.min.js') }}"></script>
    	<script>
    		let baseUrl = '{{ url('/') }}' ;
    	</script>
    	<script src="{{ URL::asset('assets/js/index.js') }}"></script>
	</body>
</html>