<!DOCTYPE html>
<html>

<body>
  <p>Dear {{$to_name}},</p>

  <p>You have been assigned to "{{$material_code}}" cost sheet, initiated by "{{$initiater_name}}". Please log on to the Cost Sheet Automation portal to work on the same:</p>

  <p>Material Code : <b>{{$material_code}}</b><br>
  Start Date : <b>{{$date}}</b><br>
  Due Date : <b>{{$duedate}}</b><br>
  <p>Portal Link : <a href="https://testing_demo.cavinkare.in/cost_sheet_automation/public/index.php">https://testing_demo.cavinkare.in/cost_sheet_automation/public/index.php</a></p>

  <p><b>Thanks & Regards,</b><br>
    <b>{{$initiater_name}}</b></p>

</body>

</html>
