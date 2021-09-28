<!docktype html>
<html>
    <head><title>People</title>
    <style>
        .user{
            font-size: 30px;
            margin-bottom: 10px;
        }
    </style>
    </head>
    <body>
        <h1 style="color: green;">Teachers</h1>
        <p style="font-size: 30px;">{{$author->name}}</p>
        <hr style="color: green;">
        <h1 style="color: green;">Students</h1>
        @foreach ($users as $user)
        <div class="user">
            {{$user->name}}</br>
        </div>
        @endforeach
    </body>
</html>