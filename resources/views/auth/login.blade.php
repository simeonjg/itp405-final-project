@extends('layout')

@section('title', 'Login')

@section('main')
  <h1>Login</h1>

  <!-- Form section -->
  <form method="POST" action="{{ route('auth.login') }}">
    @csrf

    <!-- Email -->
    <div class="mb-3">
      <label class="form-label" for="username">Username</label>
      <input type="username" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
      @error('username')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- Password -->
    <div class="mb-3">
      <label class="form-label" for="password">Password</label>
      <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
      @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    
    <input type="submit" value="Login" class="btn btn-primary">
  </form>
@endsection