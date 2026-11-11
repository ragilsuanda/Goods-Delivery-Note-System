@extends('admin.layout.app')
@section('content')
<div class="container">
  <div class="page-inner">
    <h4 class="mb-4">Pengaturan Akun</h4>

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('account.update') }}" method="POST">
      @csrf

      <!-- Password Saat Ini -->
      <div class="mb-3">
        <label for="current_password">Password Saat Ini</label>
        <div class="input-group">
          <input type="password" name="current_password" class="form-control" id="current_password" required>
          <span class="input-group-text" onclick="togglePassword('current_password', this)" style="cursor: pointer;">
            <i class="fas fa-eye-slash"></i>
          </span>
        </div>
      </div>

      <!-- Password Baru -->
      <div class="mb-3">
        <label for="new_password">Password Baru</label>
        <div class="input-group">
          <input type="password" name="new_password" class="form-control" id="new_password" required>
          <span class="input-group-text" onclick="togglePassword('new_password', this)" style="cursor: pointer;">
            <i class="fas fa-eye-slash"></i>
          </span>
        </div>
      </div>

      <!-- Konfirmasi Password Baru -->
      <div class="mb-3">
        <label for="new_password_confirmation">Konfirmasi Password Baru</label>
        <div class="input-group">
          <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" required>
          <span class="input-group-text" onclick="togglePassword('new_password_confirmation', this)" style="cursor: pointer;">
            <i class="fas fa-eye-slash"></i>
          </span>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
  </div>
</div>

<!-- Toggle password visibility -->
<script>
  function togglePassword(inputId, el) {
    const input = document.getElementById(inputId);
    const icon = el.querySelector('i');
    if (input.type === "password") {
      input.type = "text";
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    } else {
      input.type = "password";
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    }
  }
</script>
@endsection
