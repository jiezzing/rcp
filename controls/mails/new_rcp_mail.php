<?php  
  $from = "system.administrator<(noreply@innogroup.com.ph)>"; 
      $rcp_no = $_POST['rcp_no'];
      $requestor_name = $_POST['rqstr_name'];
      $rush = $_POST['rush'];
      $to = $_POST['email'];
      

      if($rush == "No"){
        $subject = "RCP Request for Approval";
        $message = "<html>
                      <head>
                      </head>
                          <body style='margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri'>
                              <div style='background-color: orange; padding: 5px; color: white'>
                                  <h3 style='padding: 0; margin: 0;'>Notice: </h3>
                              </div>
                              <div style='border: 1px solid #e1e1e1; padding: 5px'>    
                                  Hi, <br><br> You have a new pending RCP request for approval with an RCP No. of <strong>".$rcp_no."</strong> from ".$requestor_name.".<br><br>
                                  Thank you. <br><br> Best Regards, <br>System Administrator
                              </div>
                              <br/>
                              <br/>
                      </body>
                  </html>";
      }
      else{
        $due_date = $_POST['due_date'];
        $justification = $_POST['justification'];
        $subject = "RUSH RCP Request for Approval";
        $message = "<html>
                      <head>
                      </head>
                          <body style='margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri'>
                              <div style='background-color: orange; padding: 5px; color: white'>
                                  <h3 style='padding: 0; margin: 0;'>Notice: Rush RCP Request for Approval</h3>
                              </div>
                              <div style='border: 1px solid #e1e1e1; padding: 5px'>    
                                  Hi, <br><br> You have a new pending RCP request for approval with an RCP No. of <strong>".$rcp_no."</strong> from ".$requestor_name.".<br><br>
                                  Date Needed: ".$due_date."<br>
                                  Justification: ".$justification."<br><br>
                                  Thank you. <br><br> Best Regards, <br>System Administrator
                              </div>
                              <br/>
                              <br/>
                      </body>
                  </html>";
      }

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
      