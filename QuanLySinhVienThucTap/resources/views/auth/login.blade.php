@extends('sinhvien.layouts.app')

@section('content')
<h1>HỆ THỐNG QUẢN LÝ SINH VIÊN THỰC TẬP</h1>
<div class="container">

  <div class="login-box">

    <div class="login-header">
      <h1>Đăng Nhập</h1>
    </div>

    <form action="{{ route('login') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus required>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
      </div>

      <div class="form-group">
        <label for="password">Mật Khẩu:</label>
        <div class="password-input">
          <input type="password" id="password" name="password"  required>
          <span class="toggle-password" onclick="togglePasswordVisibility()"><i class="fas fa-eye-slash"></i></span>
        </div>
      </div>

      {{-- <div class="remember-section">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="remember" id="remember">
          <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
        </div>
      </div> --}}

      <button type="submit">Đăng Nhập</button>

      {{-- <p>
        <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
      </p> --}}
    </form>
  </div>
</div>

<style>
    
 h1 {
  text-align: center;
  font-size: 36px;
  font-weight: bold;
  text-transform: uppercase;
  color: #007bff;
}

.container {
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  height: 80vh;
}

.login-box {
  background: #fff;
  width: 500px;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

.login-header {
  text-align: center;
  margin-bottom: 30px;
}

label {
  font-weight: bold;
}

input {
  display: block;
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button {
  background: #007bff;
  color: #fff;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

a {
  color: #007bff;
}

.password-input {
  position: relative;
}

.toggle-password {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  width: 16px;
  height: 16px;
  cursor: pointer;
}

.toggle-password i {
  font-size: 16px;
  color: #999;
}

.hide-password i {
  color: #007bff;
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
function togglePasswordVisibility() {
  var passwordInput = document.getElementById("password");
  var togglePasswordIcon = document.querySelector(".toggle-password");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    togglePasswordIcon.innerHTML = '<i class="fas fa-eye"></i>';
  } else {
    passwordInput.type = "password";
    togglePasswordIcon.innerHTML = '<i class="fas fa-eye-slash"></i>';
  }
}
</script>
@endsection