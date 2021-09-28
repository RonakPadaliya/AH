<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: white;
}

* {
  box-sizing: border-box;
}


.container {
  margin:auto;
  width:600px;
  background-color: white;
}


input[type=text], input[type=password],input[type=file],input[type=date],textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background:#f1f1f1;
}

input[type=text]:focus, input[type=password]:focus ,input[type=file]:focus,input[type=date]:focus{
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
.cancle{
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  margin-left: 460px;
  border: none;
  cursor: pointer;
  opacity: 0.9;
  width: 600px;
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
</style>
</head>
<body>

<form action="/create_assignment/{{$id}}" method="post" enctype="multipart/form-data">
    @csrf
  <div class="container">
    <h1 align="center">Create Assignment</h1>


    <label for="title"><b>Assignment Title</b></label>
    <input type="text" placeholder="Enter Assignment Title.." name="title" id="title" required>

    <label for="description"><b>Description</b></label>
    <textarea placeholder="Enter Assignment Description" name="description" ></textarea>
    <label for="file"><b>Assignment File</b></label>
    <input type="file" name="assignment_file" />
    <label for="date"><b>Set Due date</b></label>
    <input type="datetime-local" name="due_Date" />
    <button type="submit" class="registerbtn">Post</button>
  </div>

</form>
<button onclick="location.href='/home'"  class="cancle"><i class="fa fa-cancle" >Cancle</i></button>
</body>
</html>