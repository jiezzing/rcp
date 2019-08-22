<?php  
  $from = "system.administrator<(noreply@innogroup.com.ph)>"; 
      $to = $_POST['email'];
      $approver_name = $_POST['approver_name'];
      $rcp_no = $_POST['rcp_no'];

      $subject = "RCP Changes";
      $message = "<html>
                    <head>
                    </head>
                        <body style='margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri'>
                            <div style='background-color: #FF8C00; padding: 5px; color: white'>
                                <h3 style='padding: 0; margin: 0;'>Notice: Changes in RCP upon approval</h3>
                            </div>
                            <div style='border: 1px solid #e1e1e1; padding: 5px'>    
                                Hi, <br><br> Your RCP request for approval with a no. of <strong>".$rcp_no."</strong> has been updated by ".$approver_name.". <br><i>You can download a PDF file format of your previous RCP data in Approved Dashboard.</i><br><br>
                                Thank you. <br><br> Best Regards, <br>System Administrator
                            </div>
                            <br/>
                            <br/>
                    </body>
                </html>";

      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
      $headers .= "From: ".$from."" . "\r\n" ;

      if(mail($to,$subject,$message,$headers))
      {
        echo 1;
      }
      else
      {
          echo 0;
      }
?>
      