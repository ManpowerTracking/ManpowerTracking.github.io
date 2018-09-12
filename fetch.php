<?php
//fetch.php;

if(isset($_POST["view"]))
{
    $connection = mysqli_connect("localhost","root","","newmanpower");
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE notification SET status=1 WHERE status=0";
  mysqli_query($connection, $update_query);
 }
 $query = "SELECT * FROM notification ORDER BY notificationID DESC LIMIT 5";
 $result = mysqli_query($connection, $query);
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   <li>
    <a href="#">
     <strong>'.$row["notificationID"].'</strong><br />
     <small><em>'.$row["userType"].'</em></small>
     <small><em>'.$row["notification"].'</em></small>
    </a>
   </li>
   <li class="divider"></li>
   ';
  }
 }
 else
 {
  $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
 }
 
 $query_1 = "SELECT * FROM notification WHERE status=0";
 $result_1 = mysqli_query($connection, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>
