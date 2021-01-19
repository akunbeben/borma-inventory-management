<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'Laravel') }} - Administrator</title>

  <link rel="stylesheet" href={{ asset('css/app.css') }}>
  <link rel="stylesheet" href={{ asset('css/template.css') }}>
</head>
<body>
  <div id="app">
    @yield('content')
  </div>

  <script src={{ asset('js/app.js') }}></script>
  <script src={{ asset('js/template.js') }}></script>
  <script>
    function disableButton(button) {
      button.form.submit(); 
      button.disabled=true; 
      button.innerText='Signing in...';
    }
  </script>
</body>
</html>