@extends('layouts.app')

@section('title', 'Project Dashboard')

@section('content')
    <h1 id="dashboard-title">Project Dashboard</h1>
    <div id="projects-list"></div>
    <button id="create-project-btn">Create Project</button>

    <!-- Create/Update Project Modal -->
    <div id="project-modal" style="display: none;">
        <h2 id="modal-title">Create Project</h2>
        <input type="hidden" id="project-id" value="">
        <input type="text" id="project-name" placeholder="Project Name" required>
        <textarea id="project-description" placeholder="Project Description" required></textarea>
        <button id="submit-project-btn">Submit</button>
        <button id="close-project-modal-btn">Close</button>
    </div>

    <script>
        let ProjectArray = [];

        $(document).ready(function() {
            fetchProjects();

            $('#create-project-btn').click(function() {
                resetModal();
                $('#modal-title').text("Create Project");
                $('#project-modal').show();
            });

            $('#close-project-modal-btn').click(function() {
                $('#project-modal').hide();
            });

            $('#submit-project-btn').click(function() {
                const projectId = $('#project-id').val();
                if (projectId) {
                    updateProject();
                } else {
                    createProject();
                }
            });
        });

        function fetchProjects() {
            $.ajax({
                url: window.location.origin + '/api/projects',
                method: 'GET',
                success: function(data) {
                    ProjectArray = [];
                    const projectsList = $('#projects-list');
                    projectsList.empty();
                    $.each(data.data, function(index, project) {
                        ProjectArray.push(project);
                        projectsList.append(`
                            <div>
                                <h2>${project.name}</h2>
                                <button onclick="viewProject(${project.id})">View Tasks</button>
                                <button onclick="editProject(${index})">Edit</button>
                                <button onclick="deleteProject(${project.id})">Delete</button>
                            </div>
                        `);
                    });
                }
            });
        }

        function createProject() {
            const projectName = $('#project-name').val();
            const projectDescription = $('#project-description').val();

            $.ajax({
                url: window.location.origin + '/api/create/project',
                method: 'POST',
                data: {
                    name: projectName,
                    description: projectDescription,
                },
                success: function() {
                    fetchProjects(); // Refresh project list
                    $('#project-modal').hide();
                }
            });
        }

        function viewProject(projectId) {
            window.location.href = `/project/${projectId}`;
        }

        function editProject(index) {
            $('#submit-project-btn').text('Update Project')
            const project = ProjectArray[index];
            $('#project-id').val(project.id);
            $('#project-name').val(project.name);
            $('#project-description').val(project.description);
            $('#modal-title').text("Edit Project");
            $('#project-modal').show();
        }

        function updateProject() {
            const projectId = $('#project-id').val();
            const projectName = $('#project-name').val();
            const projectDescription = $('#project-description').val();

            $.ajax({
                url: window.location.origin + `/api/project/${projectId}`,
                method: 'PUT',
                data: {
                    name: projectName,
                    description: projectDescription,
                },
                success: function() {
                    fetchProjects(); // Refresh project list
                    $('#project-modal').hide();
                }
            });
        }

        function deleteProject(projectId) {
            if (confirm('Are you sure you want to delete this project?')) {
                $.ajax({
                    url: window.location.origin + `/api/project/${projectId}`,
                    method: 'DELETE',
                    success: function() {
                        fetchProjects(); // Refresh project list
                    }
                });
            }
        }

        function resetModal() {
            $('#submit-project-btn').text('Create Project');
            $('#project-id').val('');
            $('#project-name').val('');
            $('#project-description').val('');
        }
    </script>
@endsection
