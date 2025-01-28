@extends('layouts.app')

@section('title', 'Manage Tasks')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg p-4" style="background-color: #F1FAEE; border-radius: 12px;">
            <div class="card-header text-white text-center fw-bold p-3"
                style="background-color: #1E1E2F; color: white; font-size: 26px; border-radius: 12px 12px 0 0;">
                Manage Tasks
            </div>

            <length>
                <div class="card-body p-4" style="border-radius: 0 0 12px 12px;">

                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <a href="{{ route('tasks.create') }}" class="btn btn-primary"
                            style="background-color: #457B9D; border: none; padding: 10px 20px; font-size: 20px;">
                            + Add New Task
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered bg-white shadow-sm">
                            <thead style="background-color: #E63946; color: white;">
                                <tr>
                                    <th class="p-3 text-center" style="width: 5%;">#</th>
                                    <th class="p-3 text-start" style="width: 15%;">Title</th>
                                    <th class="p-3 text-start" style="width: 30%;">Description</th>
                                    <th class="p-3 text-center" style="width: 13%;">Due Date</th>
                                    <th class="p-3 text-center" style="width: 12%;">Status</th>
                                    <th class="p-3 text-center" style="width: 15%;">Assigned Employee</th>
                                    <th class="p-3 text-center" style="width: 25%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tasks as $index => $task)
                                    <tr>
                                        <td class="p-3 text-center">{{ $index + 1 }}</td>
                                        <td class="p-3 fw-bold text-start">{{ $task->title }}</td>
                                        <td class="p-3 text-start text-truncate" style="max-width: 300px;"
                                            title="{{ $task->description }}">
                                            {{ $task->description }}
                                        </td>
                                        <td class="p-3 text-center">{{ $task->due_date }}</td>
                                        <td class="p-3 text-center">
                                            <span
                                                class="badge px-3 py-2 
                                            {{ $task->status === 'completed' ? 'bg-success' : ($task->status === 'pending' ? 'bg-warning' : 'bg-secondary') }}">
                                                {{ ucfirst($task->status) }}
                                            </span>
                                        </td>
                                        <td class="p-3 text-center">{{ $task->employee->name ?? 'Unassigned' }}</td>
                                        <td class="text-center p-3">
                                            <a href="{{ route('tasks.edit', $task->id) }}"
                                                class="btn btn-sm btn-warning px-3 py-2"
                                                style="background-color: #ffa201; color: white; border: none;">Edit</a>
                                            <button class="btn btn-sm btn-danger delete-btn px-3 py-2"
                                                data-id="{{ $task->id }}"
                                                style="background-color: #1E1E2F;color: white; border: none;">
                                                Delete
                                            </button>

                                            <form id="delete-form-{{ $task->id }}"
                                                action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center p-4" style="font-style: italic;">No tasks
                                            found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
        </div>
    </div>

    <!-- Bootstrap & jQuery Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".delete-btn").click(function() {
                let taskId = $(this).data('id');
                if (confirm("Are you sure you want to delete this task?")) {
                    $("#delete-form-" + taskId).submit();
                }
            });
        });
    </script>
@endsection
