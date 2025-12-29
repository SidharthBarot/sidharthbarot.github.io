<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 12px;
        }
        .user-icon {
            font-size: 50px;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="card shadow-sm p-4" style="width: 100%; max-width: 420px;">
        
        <!-- Header -->
        <div class="text-center mb-4">
            <div class="user-icon">👤</div>
            <h3 class="mt-2">User Dashboard</h3>
            <p class="text-muted mb-0">Welcome back!</p>
        </div>

        <!-- User Info -->
      @php
    use App\Models\User;
    $user = User::find(session('user_id'));
@endphp

<ul class="list-group list-group-flush mb-4">
    <li class="list-group-item">
        <strong>User ID:</strong> {{ session('user_id') }}
    </li>
    <li class="list-group-item">
        <strong>Email:</strong> {{ $user->email ?? 'Not logged in' }}
    </li>
</ul>

        <!-- Actions -->
        <div class="d-grid gap-2">
            {{-- <a href="{{ route('pay') }}" class="btn btn-success">
                💳 Pay Now
            </a> --}}

            <form method="get" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-warning">
                    🚪 Logout
                </button>
            </form>
        </div>

    </div>

</div>

</body>
</html>
