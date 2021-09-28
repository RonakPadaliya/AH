<!DOCTYPE html>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

.container {
  padding: 16px;
  background-color: white;
  width:650px;
  margin: auto;
}
input[type=text], input[type=password], textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
.registerbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

a {
  color: dodgerblue;
}

.signin {
  background-color: #f1f1f1;
  text-align: center;
}
.cancle{
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  margin-left: 450px;
  border: none;
  cursor: pointer;
  opacity: 0.9;
  width: 620px;
}
</style>
</head>
<body>

<form action="/join_class" method="POST">
@csrf
  <div class="container">
    <h1>Join Class</h1>
    <hr>
    <label>@if($errors->any())
      <p style="color: red;">{{$errors->first()}}</p>
          @endif
    </label>
    <label for="class_code"><b>Class Code</b></label>
    <input type="text" placeholder="Enter Class Code"  name="class_code"  required>

    <button type="submit" class="registerbtn">Join</button></br>

  </div>

</form>
<button onclick="location.href='/home'" class="cancle"><i class="fa fa-cancle" >Cancle</i></button>
</body>
</html>