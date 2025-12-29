<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-5">

            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center mb-4">Register</h3>

                    <form action="{{route('store')}} " method="post">
                        @csrf
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text"  name="name" class="form-control" placeholder="Enter your name">
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email">
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password">
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password|confirm " class="form-control" placeholder="Confirm password">
                        </div>

                        <div class="mb-3">
    <label class="form-label">Age</label>
    <input type="number" name="age" class="form-control" placeholder="Enter age">
</div>


                            <div class="mb-3">
    <label class="form-label">Role</label>
    <select name="role" class="form-control" required>
        <option value="">-- Select Role --</option>
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>
</div>

                        <!-- Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Register</button>
                        </div>

                        <!-- Login Link -->
                        <p class="text-center mt-3">
                            Already have an account?
                            <a href={{ '/login' }}>Login</a>
                        </p>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
