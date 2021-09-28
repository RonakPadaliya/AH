<!DOCTYPE html>
<?php use Carbon\Carbon;?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<html lang="en">
<head>
    <style>
        a{
            text-decoration: none;
            color: black;
        }
        .classes{
            float: left;
        }
        h2{
            float: left;
        }
        i{
            margin-left: 20px;
            margin-top: 25px;
        }
        .submit-block{
            float: right;
			margin-right:300px;
            border: 1px;
            border-radius: 5px;
            box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
            margin-top: -50px;
            padding: 20px;
        }
        .button {
             border: none;
             box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
             color: orangered;
             padding: 8px 15px;
             text-align: center;
             text-decoration: none;
             display: inline-block;
             font-size: 12px;
             margin: 4px 2px;
             cursor: pointer;
        }
.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}
.custom-file-input::before {
  content: 'Add File';
  display: inline-block;
  background: linear-gradient(top, #f9f9f9, #e3e3e3);
  border: 1px solid #999;
  border-radius: 3px;
  padding: 5px 8px;
  outline: none;
  white-space: nowrap;
  -webkit-user-select: none;
  cursor: pointer;
  font-weight: 700;
  font-size: 10pt;
  color: orangered;
}
.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}
table{
    border-collapse: collapse;
    border: 1px;
    box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
}
th,td{
    width: 200px;
    text-align: center;
}
    </style>
</head>
<body >
    <h1 style="color:peru;">{{$assignment->assignment_title}}</h1><p> Due: {{date('d-m-Y',strtotime($assignment->due_Date))}}</p>
    <p style="margin-left: 25px; font-size: 25px;">-{{$assignment->assignment_description}}</p>
    <hr style="width: 350px; margin-left:0px;">
    <div class="classes">
        @if(isset($assignment->assignment_file))
             <h2>{{$assignment->assignment_file}}</h2>
            <?php 
            $file_name='upload_files/'.$assignment->assignment_file ?>
            <a href="{{asset($file_name)}}" download>
                <i class="fa fa-download" aria-hidden="true"></i>
            </a>
        @endif
    </div>
    <form action="/submit_assignment/{{$assignment->id}}" method="POST"  enctype="multipart/form-data">
        @csrf
		
        @if(isset($submissions))
        @php ($cnt=0)
		@if(sizeof($submissions))
        @foreach($sub_date as $sub)
			<div class="submit-block">
			<table>
			<tr><th>Name</th><th>Submitted At</th><th>Status</th><th>File</th></tr>
			<div class="submissions">
				<tr><td>{{$submissions[$cnt]->name}}</td><td>{{$sub->created_at->timezone('Asia/Kolkata')}}</td><td>{{$status[$cnt]}}</td>
                    <td><?php 
                        $file_name='upload_files/'.$sub->assignment_file ?>
                        <a href="{{asset($file_name)}}" download style="color:red;">{{$sub->assignment_file}}
                        </a>
                    </td>
                </tr>
			</div>
			@php($cnt++)
        @endforeach
		@endif
		</div>
        </table>
        @else
         @if (!isset($submission->assignment_file))
			<div class="submit-block">
        <label for="file"></label><label for="due">@php($current = Carbon::now('Asia/Kolkata'))
            {{-- {{$current}} --}}
        @if($current->gt(date($assignment->due_Date)))<p style="color: red">Missing</p>@endif</label>
        <input type="file" name="up_file" class="custom-file-input"><br><br>
        <label for="button"></label> 
        <button type="submit" value="Submit" class="button">Submit</button><div>
         @else
			<div class="submit-block">
          <label for="msg"><p>You have already submitted!!!</p></label></div>
        @endif
       @endif
 
    </form>
    </body>
</html>