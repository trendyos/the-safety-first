<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$data['title']}}</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
        <table width="100%" border="0" style="font-size: 14px;font-family: 'Poppins', sans-serif;color:#000;" style="border-collapse: collapse;">
              <tr>
                 <td>
                    <center><img class="logo-pic-one" src="https://www.thesafetyfirst.in/wp-content/uploads/2022/07/safety-first-web.png" alt="" height="80px" width="170px"></center> 
                 </td>
             </tr>
             <tr>
                <td colspan="3">
                    <h4 style="margin:25px 0 0 0;padding:6px;text-align:justify;">
                      Welcome to Safety First Plateform
                    </h4>
                </td>
            </tr>
            <tr>
                <td>
                   Hi, {{ucfirst($data['name'])}}
                </td>
            </tr>
            <br/>
            <tr>
                <td>
                   Please use this one time verification  code to reset your password.
                </td>
            </tr>
             <br/>
            <tr>
                <td align="center" font-size="24px" background-color="#20c997" font-weight="bold">
                  {{ ucfirst($data['otp'])}}
                </td>
            </tr>
             <br/>
          
             <br/>
           
            <tr>
                <td>
                    <h3>Regards</h3>
                    
                </td>
                
            </tr>
            <tr>
                <td>
                   The Safety First
                </td>
            </tr>
          
    </table>
</body>
</html>