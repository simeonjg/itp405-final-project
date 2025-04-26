@extends('layout')

@section('title', 'Login')

@section('main')
  <h1>Login</h1>

  <!-- Form section -->
  <form method="POST" action="{{ route('auth.login') }}">
    @csrf

    <!-- Email -->
    <div class="mb-3">
      <label class="form-label" for="email">Email</label>
      <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
      @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- Password -->
    <div class="mb-3">
      <label class="form-label" for="password">Password</label>
      <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
      @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    
    <input type="submit" value="Login" class="btn btn-primary">
  </form>
@endsection