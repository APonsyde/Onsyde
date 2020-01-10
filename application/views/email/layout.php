<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo PROJECT_NAME; ?> Email</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<style>
    *{
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    html,body{
        background: #eeeeee;
        font-family: 'Open Sans', sans-serif, Helvetica, Arial;
    }
    img{
        max-width: 100%;
    }
    @media only screen and (max-width: 480px){
        table tr td{
            width: 100% !important;
            float: left;
        }
    }
</style>
</head>
    <body style="background: #eeeeee; padding: 10px; font-family: 'Open Sans', sans-serif, Helvetica, Arial;">
        <center>
            <p>&nbsp;</p>
            <table width="100%" cellpadding="0" cellspacing="0" bgcolor="FFFFFF" style="background: #ffffff; max-width: 600px !important; margin: 0 auto; background: #ffffff;">
                <tr>
                    <td style="padding: 20px; text-align: center; background: #53b64b;">
                        <h1 style="color: #ffffff; margin: 0;"><?php echo $title; ?></h1>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px;;">
            			<?php $this->load->view('email/' . $_view); ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px; background: #2B2E34;">
                        <table border="0" cellpadding="0" cellspacing="0" a>
                            <tr>
                                <td width="100%" style="width: 50%; padding: 10px; color: #ffffff; text-align: left;" valign="top">
                                    <h2 style="margin-top: 0;">Contact us</h2>
                                    <table border="0" style="font-size: 14px;">
                                        <tr><td><?php echo PROJECT_NAME; ?></td></tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <p style="text-align: center; color: #666666; font-size: 12px; margin: 10px 0;">
                Copyright © 2019. All&nbsp;rights&nbsp;reserved.<br />
            </p>
        </center>
    </body>
</html>