
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link  rel="stylesheet" href="{{url('public/bootstrap/css/bootstrap.css')}}">
  <style>
      h1{
          text-align: center;
      }
      #description{
          resize: none;
      }
      </style>

</head>
<body>
<div class="container">
<div class="row">
    <div class="col-md-12">
        @yield('content')
    </div>
</div>
</div>

</body>
</html>