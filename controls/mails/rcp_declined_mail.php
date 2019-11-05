<?php  
  $from = "system.administrator<(noreply@innogroup.com.ph)>"; 
      $reason = $_POST['reason'];
      $approver_name = $_POST['approver_name'];
      $rcp_no = $_POST['rcp_no'];
      $to = $_POST['email'];
      $subject = "RCP Disapproval";
      $message = "<html>
                      <head>
                      </head>
                          <body style='margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri'>
                              <div style='background-color: #FF0000; padding: 5px; color: white'>
                                  <h3 style='padding: 0; margin: 0;'>Notice: </h3>
                              </div>
                              <div style='border: 1px solid #e1e1e1; padding: 5px'>    
                                  Hi, <br><br> Your Request for Check Payment Form with an RCP No. of <strong>".$rcp_no."</strong> has been declined by ".$approver_name.". <br><br>The following reason/s are the following:<br> - ".$reason."<br><br>
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

  echo 1;
?>
      