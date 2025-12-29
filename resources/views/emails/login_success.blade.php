<h2>Hello {{ $user->name }}</h2>

<p>You have successfully logged in.</p>

@if($user->role === 'admin')
    <p>You are logged in as <b>Admin</b>.</p>
@else
    <p>You are logged in as <b>User</b>.</p>
@endif

<p>Login Time: {{ now() }}</p>

<p>Thanks,<br>{{ config('app.name') }}</p>
