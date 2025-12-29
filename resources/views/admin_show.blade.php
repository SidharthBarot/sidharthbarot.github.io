<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users List</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom UI Fixes -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .pagination {
            font-size: 14px;
        }
        .page-link {
            padding: 6px 12px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <!-- Greeting -->
    <h4 class="mb-4">
        Hello {{ $loggedInUser->name }} 👋
    </h4>

    <!-- Search Bar -->
    <form method="GET" class="mb-4 d-flex gap-2">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Search name or email"
               class="form-control w-25">

        <button type="submit" class="btn btn-primary btn-sm">
            Search
        </button>
    </form>

    <!-- Title -->
    <h3 class="text-center mb-4">Registered Users</h3>

    <!-- Users Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped table-bordered mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 10%">ID</th>
                        <th style="width: 30%">Name</th>
                        <th style="width: 35%">Email</th>
                        <th style="width: 25%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <!-- EDIT -->
                                <a href="{{ route('user.edit', $user->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('user.delete', $user->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                No users found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-4 d-flex gap-2">
        
        <a href="{{ route('logout') }}" class="btn btn-sm btn-warning">
            Logout
        </a>

        <a href="{{ route('admin.send.users.pdf') }}" class="btn btn-primary btn-sm">
            Send Users PDF to My Email
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>

</div>

</body>
</html>
