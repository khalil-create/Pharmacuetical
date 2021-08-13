@if (session('status'))
    <input value="{{ session('status') }}" id="success" hidden>
    <script>
      var msg = document.getElementById('success').value;
      console.log(msg);
      swal(msg, {
          icon: "success",
          button: "حسناً!",
          timer: 2000,
      })
    </script>
  @endif
  @if (session('error'))
    <input value="{{ session('error') }}" id="error" hidden>
    <script>
      var msg = document.getElementById('error').value;
      console.log(msg);
      swal(msg, {
          icon: "error",
          button: "حسناً!",
      })
    </script>
  @endif