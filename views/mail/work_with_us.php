<!DOCTYPE html>
<html>
<head>
  <title>Work with us</title>
</head>
<style type="text/css">
  .p_tag {
    font-family:Verdana,sans-serif;box-sizing:border-box;color:#3d4852;font-size:16px;line-height:1.5em;margin-top:0;text-align:left
  }
</style>
<body>
<table role="presentation" style="font-family:Verdana,sans-serif;box-sizing:border-box;background-color:#f8fafc;margin:0;padding:0;width:100%" width="100%" cellspacing="0" cellpadding="0">
   <tbody>
      <tr>
         <td style="font-family:Verdana,sans-serif;box-sizing:border-box" align="center">
            <table role="presentation" style="font-family:Verdana,sans-serif;box-sizing:border-box;margin:0;padding:0;width:100%" width="100%" cellspacing="0" cellpadding="0">
               <tbody>
                 
                  <tr>
                     <td cellpadding="0" cellspacing="0" style="font-family:Verdana,sans-serif;box-sizing:border-box;background-color:#ffffff;border-bottom:1px solid #edeff2;border-top:1px solid #edeff2;margin:0;padding:0;width:100%" width="100%">
                        <table role="presentation" style="font-family:Verdana,sans-serif;box-sizing:border-box;background-color:#ffffff;margin:0 auto;padding:0;width:570px" width="570" cellspacing="0" cellpadding="0" align="center">
                           <tbody>
                              <tr>
                                 <td style="font-family:Verdana,sans-serif;box-sizing:border-box;padding:35px">
                                    <p class="p_tag">Hi Admin,</p>
                                    <p class="p_tag">First Name : <?= $this->input->post("first_name")?></p>
                                    <p class="p_tag">Last Name : <?=$this->input->post("last_name")?></p>
                                    <p class="p_tag">Company : <?= $this->input->post("company")?></p>
                                    <p class="p_tag">Email : <?= $this->input->post("email")?></p>
                                    <p class="p_tag">Phone : <?= $this->input->post("number")?></p>
                                    <p class="p_tag">Address : <?= $this->input->post("address")?></p>
                                    <p class="p_tag">Message : <?= $this->input->post("message")?></p>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td style="font-family:Verdana,sans-serif;box-sizing:border-box">
                        <table role="presentation" style="font-family:Verdana,sans-serif;box-sizing:border-box;margin:0 auto;padding:0;text-align:center;width:570px" width="570" cellspacing="0" cellpadding="0" align="center">
                           <tbody>
                              <tr>
                                 <td style="font-family:Verdana,sans-serif;box-sizing:border-box;padding:35px" align="center">
                                    <p style="font-family:Verdana,sans-serif;box-sizing:border-box;line-height:1.5em;margin-top:0;color:#aeaeae;font-size:12px;text-align:center">&copy; '.date('Y').' loftconversionlondon.com. All rights reserved.</p>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>

</body>
</html>>