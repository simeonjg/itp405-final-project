@extends('layout')

@section('title', 'Login')

@section('main')
  <h1>Log In to Your MovieBuff Account</h1>

  <!-- Form section -->
   <div>
    <form method="POST" action="{{ route('auth.login') }}">
      @csrf

      <!-- Username -->
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
      <span class="mx-3">Or <a href="{{ route('registration.index') }}" class="mx-1"> Sign Up</a> </span>
    </form>
   </div>
  


@endsection