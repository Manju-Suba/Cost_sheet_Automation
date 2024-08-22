<!DOCTYPE html>
<html>

<body>
<p>Dear "{{$user_name}}"</p>

<p>You have been assigned to "{{$product_name}}" cost sheet, initiated by "{{$initiater_name}}".<br>
 Please log on to the Cost Sheet Automation portal to work on the same :</p>

<p>Cost Sheet :<b>{{$product_name}}</b><br>
Start Date  :<b>{{$date}}</b><br>
Due Date :<b>{{$duedate}}</b><br>
Portal Link: <a href="https://testing_demo.cavinkare.in/cost_sheet_automation/public/index.php">https://testing_demo.cavinkare.in/cost_sheet_automation/public/index.php</a></p>
<p><b>Thanks & Regards ,</b><br>
<b>{{$initiater_name}}</b></p>
