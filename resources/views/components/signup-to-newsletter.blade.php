<form action="{{ route('brevo.addNewsletterContact') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Indirizzo Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
    <button type="submit" class="btn btn-primary">Iscriviti</button>
</form>