##Task Manager Application

This application consists of a front end (the "index" page) and several API endpoints, as follows:

- GET /api/task: Returns all registered tasks
- GET /api/task/{id}: Returns the task identified by the {id} parameter
- POST /api/task: Inserts and returns a new task
- PUT /api/task/{id}: Updates the task
- DELETE /api/task/{id}: Removes the task

The Index page provides a web interface for doing these CRUD operations through AJAX calls to the API endpoints.

### Running the Laravel app

After running the Docker environemt, it's necessary to execute the following commands:

- `cp .env.example .env` (then editing the `.env`  file with the Docker database credentials) 
- `chmod -R 0777 task-manager/storage` (to authorize writing on the Laravel file storage)
- `php artisan key:generate` (to generate the application key)
- `php artisan migrate` (to run the database migrate and create the `tasks` table)
