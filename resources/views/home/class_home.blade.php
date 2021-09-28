<?php
if (Session::get('msg')) {
  echo '<script>alert("' . Session::get('msg') . '")</script>';
  Session::forget('msg');
}
?>
<!DOCTYPE html>
<html>
<title>Class Page</title>

<head>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <style>
    .ass-link {
      text-decoration: none;
    }

    img {
      width: 700px;
      margin-top: 50px;
      height: 200px;
      margin-left: auto;
      margin-right: auto;
      display: block;
      border-radius: 15px;
    }

    .container {
      position: relative;
      text-align: center;
    }

    .top-left {
      position: absolute;
      top: 12px;
      left: 450px;
      font-size: 25px;
    }

    .assignments {
      margin-top: 30px;
      border: 1px solid;
      border-radius: 5px;
      margin-right: 500px;
      padding: 12px;
    }

    .temp {
      margin-top: 5px;
      margin-left: 520px;
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

    .people {
      text-decoration: none;
      box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
      padding: 15px;
      border-radius: 5px;
      color: green;
    }
  </style>
</head>

<body>
  <div class="topnav">
    <a class="active" href="/home">Home</a>
    @if ($author->id == auth()->user()->id)
    <a href="/create_assignment/{{$class->id}}">Create Assignment</a>
    @endif
    <a href="/unenroll/{{$class->id}}">Unenroll</a>
    <a href="/logout">Log Out</a>
  </div>
  </br></br></br>
  </br>
  <a href="/people/{{$class->id}}" style="margin-left: 730px;" class="people">People</a>
  <div class="container">
    <img src="{{ asset('bg3.jfif')}}">
    <div class="top-left"><strong>{{$class->class_name}}</strong></div>
  </div>
  @if ($author->id == auth()->user()->id)
  <form action="/invite/{{$class->id}}" method='post'>
    @csrf
    <input type="text" name="invite_email" placeholder="Enter User's Email address..." style="margin-top:15px; margin-left:415px; width: 620px;">
    <input type="submit" class="fa fa user-plus" value="Invite" align="center">
  </form>
  @endif
  <div class="temp">
    @if (!$ass->isEmpty())
    @foreach($ass as $a)
    <div class="assignments">
      <strong>
        <p style="font-size: 15px;"><i class="fas fa-star" style="margin-right: 15px;"></i>{{$author->name}} has posted new Announcement: <a href='/assignment/{{$a->id}}' class="ass-link">{{$a->assignment_title}}</a>
      </strong></br></p>
      <p style="padding-left: 15px;">
      <p>
    </div>
    @endforeach
    @else
    <p style="margin-left: 180px; margin-top: 20px;"><strong>No assignment yet!!</strong></p>
    @endif
  </div>
</body>

</html>