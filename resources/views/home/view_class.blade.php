<!DOCTYPE html>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<html lang="en">
<style>
  button {
    border-radius: 15px;
    border-color: black;
  }

  .nav {
    color: black;
    float: right;
  }

  body {
    background-color: white;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
  }

  block {
    background-color: lightgrey;
    width: 300px;
    border: 15px solid green;
    padding: 50px;
    margin: 20px;
  }

  a {
    padding-left: 300px;
    text-decoration: none;
  }

  a:hover {
    text-decoration: underline;
    color: black;
  }

  .classes {
    display: inline-block;
    margin-right: 35px;
  }

  .temp {
    margin-top: 70px;
  }

  img {
    border-radius: 15px;
    width: 376px;
    height: 130px;
  }

  p {
    font-size: 18px;
    color: black;
  }

  body {
    margin: 0;
  }

  .topnav {
    overflow: hidden;
    background-color: #333;
    float: right;
    margin-right: 25px;
    margin-top: 25px;
  }

  .topnav a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 14px;
  }

  .topnav a:hover {
    background-color: #ddd;
    color: black;
  }

  .topnav a.active {
    background-color: #4CAF50;
    color: white;
  }
</style>

<head></head>

<body>
  <div class="topnav">
    <a class="active" href="home">Home</a>
    <a href="/create_class">Create Class</a>
    <a href="/join_class">Join Class</a>
    <x-jet-dropdown-link href="{{ route('profile.show') }}">
      {{ __('Profile') }}
    </x-jet-dropdown-link>
    <a href="/logout">Log Out</a>
  </div>
  </br></br></br>
  <div class="temp">
    @if(isset($classes))
    @foreach ($classes as $cls)
    <div class="classes">
      <p style="border: 2px solid grey; border-radius:15px; height:200px;"><img src="{{ asset('bg3.jfif')}}"><br>
        Class Name:-<strong>{{$cls->class_name}}</strong></br>
        Class Code:-<strong>{{$cls->id }}</strong><br><a href="class_home/{{$cls->id}}">Open</a></p>
    </div>
    @endforeach
    @else
    <h1 style="margin-left: 600px; margin-top: 250px; color: grey">Create/Join Class</h1>
    @endif
  </div>
</body>

</html>