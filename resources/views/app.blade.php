<!DOCTYPE html>
    <head>
    	<meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel='stylesheet' href="{{ elixir('css/all.css') }}">
    </head>
    <body>
        <div class="container">
            @include('partials.flash')

            @yield('content')
        </div>

       <script src="http://code.jquery.com/jquery.js"></script>
       <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js">
       </script>
       <script>
           $('div.alert').not('.alert-important').delay(3000).slideUp(300);
       </script>

       @yield('footer')
    </body>
</html>