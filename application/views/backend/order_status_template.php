<!doctype html>
<html>
<head>
  <title>E-Shopper</title>
  <style type="text/css">
    *{margin:0px; padding:0; font-family:arial; color:#232323; font-size:14px;}
  </style>
</head>
<body>
  <table style="border:1px solid #f1f1f1; margin:auto; text-align:center;" width="800" align="center" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0">
    <thead>
      <tr>
        <td style="border-bottom: 5px solid #FE980F; padding: 15px 0; text-align: center;">
          <table width="800" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100%" valign="top" align="center"><a href="#" style="border:none; padding-left:15px;"><img src="<?php echo base_url(); ?>assets/themes/Eshopper/images/home/logo.png" alt="E-Shopper" style="border:none;" /></td>
            </tr>
          </table>
        </td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="padding:15px;" align="left">
          <p style="margin:15px;">Hello {name},</p>

          <p style="margin:15px;">E-shopper<br>
          <div>
                <p>Your order id is: <strong>{order_id}</strong></p>
                <p>Your order status is: <strong>{status}</strong></p>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th class="center">Price</th>
                    <th class="center">QTY</th>
                    <th class="center">Total</th>
                </tr>
                </thead>
                <tbody>{order_details_template}</tbody>
            </table>
            <div class="row clearfix">
                <div class="col-md-4 column">
                    <p><strong>Billing Information</strong></p>
                    <p>{billing_information}</p>
                </div>
                <div class="col-md-4 column">
                    <p><strong>Shipping Information</strong></p>
                    <p>{shipping_information}</p>
                </div>
                <div class="col-md-4 column"> </div>
                <div class="col-md-4 column">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><strong> Subtotal</strong></td>
                            <td><span>&#8377;{sub_total}</span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Shipping</strong></td>
                            <td><span>{shipping_charges}</span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Discount price</strong></td>
                            <td><span>&#8377;{discount}</span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Grand Total</strong></td>
                            <td><span>&#8377;{grand_total}</span>
                            </td>
                        </tr> 
                        </tbody>
                    </table>
                </div>
            </div>
          

          <p style="margin:15px;"><b>Note</b> :Please do not reply back to this mail. This is sent from an unattended mail box.</p>
          <p style="margin:15px;">This e-mail was sent from E-shopper <a href="http://localhost/demoproject/shop">(http://www.e-shopper.com)</a></a></p>
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td style="background:#f4f4f4; padding:15px 0; text-align:center; color:#777;">&copy; E-Shopper, 2017 · All Rights Reserved.<a href="http://localhost/demoproject/index.php/shop" style="color:#FE980F;" target="_blank">www.e-shopper.com</a></td>
      </tr>
    </tfoot>
  </table>
</body>
</html>
