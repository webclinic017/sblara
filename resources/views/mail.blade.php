
<div class="container">
  Dear {{$course_participant->p_name}} registration,<br>
  Thank you for registering for Exclusive Training Program on {{ $course_participant->batch->course->course_name }}<p>

  Here is your registration details:<p>

  Name: {{$course_participant->p_name}}n<br>
  Email: {{ $course_participant->p_email}}<br>
  Address: {{ $course_participant->p_address}}<br>
  Contact No: {{ $course_participant->p_phone }}<br>
  Course Name: {{ $course_participant->batch->course->course_name }}<p>

  Only a limited number of seats are available for the training program and will be allocated on a first-come-first-serve basis.<p>

  Please confirm your seat by paying your fees( {{$batch->course_fees}} Tk) through Cash, Online Bank Deposit or A/C pay cheque in favour of StockBangladesh Ltd.<p>
<p>Meanwhile you can visit our <a href="https://stockbangladesh.com/courses/technical-analysis">Technical Analysis (TA) course dashboard</a> </p>

  You can visit our office at<p>

  StockBangladesh.com<br>
  Dhaka Trade Center(14th Floor),<br>
  99, Kazi Nazrul Islam Avenue<br>
  Kawranbazar,Dhaka<p>

  Let us know if you have any queries.<p>

  -Thanks<br>
  StockBangladesh Limited<br>
  01929912878,<br>
  Thank you for your interest.<br>
</div>
