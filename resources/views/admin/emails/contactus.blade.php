<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Hello, <p style="font-size: x-small;"> {{$first_name.' '.$last_name}}</p></h1>

    <P>
      Dear,<br>
      {{$first_name.' '.$last_name}}
    </P>
    
    
   <p>{!!$messageList->messages!!}</p>


</body>
</html>