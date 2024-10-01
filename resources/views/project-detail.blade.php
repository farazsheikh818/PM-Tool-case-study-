@extends('layouts.app')

@section('title', 'Project Detail')

@section('content')
    <h1 id="project-name"></h1>
    <div id="tasks-list"></div>
    <button id="create-task-btn">Add Task</button>

    <!-- Create Task Modal -->
     <form class="submit-task-form" action="POST">
    <div id="create-task-modal" style="display: none;">
        <h2>Create Task</h2>
        <input type="text" id="task-name" placeholder="Task Name" required>
        <input type="hidden" id="task-id" value="">
        <textarea id="task-description" placeholder="Task Description" required></textarea>
        <select id="task-status">
            <option value="todo">Todo</option>
            <option value="in-progress">In Progress</option>
            <option value="done">Done</option>
        </select>
        <button id="submit-task-btn">Submit</button>
        <button id="close-task-modal-btn">Close</button>
    </div>
    </form>
 

    <script>
        const projectId = {{ $project->id }};
        let TaskArray = [];

        $(document).ready(function() {
            fetchProjectDetails();
            fetchTasks();

            $('#create-task-btn').click(function() {
                $('#create-task-modal').show();
            });

            $('#close-task-modal-btn').click(function() {
                reset()
                $('#create-task-modal').hide();
            });

            $('.submit-task-form').submit(function(e) {
                e.preventDefault();
                $('#task-id').val() === "" ? createTask() : updateTask();
                
            });

      
        });

        function fetchProjectDetails() {
            $.ajax({
                url: window.location.origin + `/api/project/${projectId}`,
                method: 'GET',
                success: function(data) {
                    $('#project-name').text(data.name);
                }
            });
        }

        function fetchTasks() {
            $('#submit-task-btn').text("Submit");
            $('#create-task-modal').hide();
            $.ajax({
                url: window.location.origin + `/api/projects/${projectId}/tasks`,
                method: 'GET',
                success: function(data) {
                    TaskArray = [];
                    const tasksList = $('#tasks-list');
                    tasksList.empty();
                    $.each(data.data, function(index, task) {
                        TaskArray.push(task);
                        tasksList.append(`
                            <div>
                                <h3>${task.name} (${task.status})</h3>
                                <button onclick="editTask(${index})">Edit</button>
                                <button onclick="deleteTask(${task.id})">Delete</button>
                            </div>
                        `);
                    });
                }
            });
        }

        function createTask() {
           
            const taskName = $('#task-name').val();
            const taskDescription = $('#task-description').val();
            const taskStatus = $('#task-status').val();

            $.ajax({
                url: window.location.origin + '/api/create/task',
                method: 'POST',
                data: {
                    project_id: projectId,
                    name: taskName,
                    description: taskDescription,
                    status: taskStatus,
                  
                },
                success: function() {
                    fetchTasks();
                    $('#create-task-modal').hide();
                }
            });
        }

        function editTask(index) {
            
            $('#submit-task-btn').text("Update")
            const task = TaskArray[index];
            $('#task-id').val(task.id);
            $('#task-id').val(task.id);
            $('#task-name').val(task.name);
            $('#task-description').val(task.description);
            $('#task-status').val(task.status);
            $('#create-task-modal').show(); 
        }

        function updateTask() {
            const taskId = $('#task-id').val();
            const taskName = $('#task-name').val();
            const taskDescription = $('#task-description').val();
            const taskStatus = $('#task-status').val();

            $.ajax({
                url: window.location.origin + `/api/projects/tasks/${taskId}`,
                method: 'PUT',
                data: {
                    name: taskName,
                    description: taskDescription,
                    status: taskStatus,
                   
                },
                success: function() {
                    reset();
                    fetchTasks();
                    
                }
            });
        }
        function reset(){
                    $('#task-id').val("");
                    $('#task-name').val("");
                    $('#task-description').val("");
                    $('#task-status').val("");
                    $('#submit-task-btn').text("Submit");
        }
        function deleteTask(taskId) {
            $.ajax({
                url: window.location.origin + `/api/projects/tasks/${taskId}`,
                method: 'DELETE',
                data: {
                  
                },
                success: function() {
                    fetchTasks();
                }
            });
        }
    </script>
@endsection
