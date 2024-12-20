<form method="post" action="{{ route('add-newsletter-email') }}">
    @csrf
    <input type="email" name="email" value="{{ old("email") }}"/>
    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <button type="submit">Registrati</button>
</form>