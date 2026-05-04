<form method="POST" action="/admin/login">
    @csrf
    <h2>Admin Login</h2>

    <input type="email" name="email" placeholder="Admin Email" required>
    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">Login</button>

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif
</form>