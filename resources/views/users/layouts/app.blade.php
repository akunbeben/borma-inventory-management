<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'Laravel') }} - User</title>

  <link rel="stylesheet" href={{ asset('css/app.css') }}>
  <link rel="stylesheet" href={{ asset('css/template.css') }}>
</head>
<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <x-users.navbar />
      <x-users.sidebar />
      @yield('body')
      <x-footer />
    </div>
  </div>

  @yield('modal')

  <script src={{ asset('js/app.js') }}></script>
  <script src={{ asset('js/template.js') }}></script>
  @include('sweetalert::alert')
  @yield('js-section')
  <script>
    function signOutConfirmation() {
      swal.fire({
        title: 'Are you sure want to sign out?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sign out!'
        }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
      })
    }

    function disableButton(button) {
      button.form.submit(); 
      button.disabled=true; 
      button.innerText='Mengirim...';
    }
  </script>
</body>
</html>