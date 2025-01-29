<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Simple Transactional Email</title>

    <style>
        table tr td:last-child {
            color: #5c5c5c;
        }

        .logo img{ max-width:60%;}
       
        @media screen and (max-width:525px) {
            table tr td {
                width: 98%;
                display: block;
            }
            
        }
    </style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="background-color: #f6f6f6;">
    <div style="width: 580px; margin: 0px auto; padding:10px 0px;">
        <table border="0"  cellpadding="0" cellspacing="0" width="580" style="font-family:Arial, sans-serif;">
            <tbody>
                <tr>
                    <td style="background-color: #fff; border:1px solid #eceaea; max-width:580px; margin:0px auto;">
                        <table border="0" width="100%" cellpadding="0" cellspacing="0"
                            style="background:#f6f6f6; border-bottom:1px solid #c8c7c7;">
                            <tbody>
                                <tr>
                                    <td style="padding:1%; background: #fff;" class="logo">
                                        <a href="<?=base_url();?>">
                                            <!-- <img src="<?php echo base_url("public/images/ear_natural_logo.png"); ?>" style="width:90%;" > -->
                                            <img src="<?php echo base_url("public/images/logo_email.png"); ?>">
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table border="0" width="100%" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td style="padding:10px;">
                                        <table border="0" cellpadding="0" cellspacing="0"
                                            style="width:100%;  padding:0px;">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family:Arial, sans-serif;">
                                                        Hi <strong>Admin,</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-top:10px; padding-bottom:10px; font-family:Arial, sans-serif;">
                                                        A new order has been received and below are the order details:
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                            <tbody>
                                                <tr style="background: #f6f6f6">
                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;"><strong>Order
                                                            Confirmation#:</strong></td>
                                                    <td style="padding:1%; font-family:Arial, sans-serif;">
                                                        <?=$orderData['postData']['customer_id'] ?>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;"><strong>Order Date:</strong>
                                                    </td>
                                                    <td style="padding:1%; font-family:Arial, sans-serif;"> <?=date('Y-m-d');?>

                                                    </td>
                                                </tr>
                                                <tr style="background: #f6f6f6">
                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;"><strong>Estd Shipping
                                                            Date:</strong></td>
                                                    <td style="padding:1%; font-family:Arial, sans-serif;">
                                                        <?=date('Y-m-d', strtotime('+3 days'))?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;"><strong>Customer Name:</strong>
                                                    </td>
                                                    <td style="padding:1%; font-family:Arial, sans-serif;">
                                                        <?=$orderData['postData']['card_holder_name'];?>
                                                    </td>
                                                </tr>
                                                <tr style="background: #f6f6f6">
                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;"><strong>Email:</strong></td>
                                                    <td style="padding:1%; font-family:Arial, sans-serif;">
                                                        <?=$orderData['postData']['email'];?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;"><strong>Billing
                                                            Address:</strong></td>
                                                    <td style="padding:1%; font-family:Arial, sans-serif;">
                                                        <?=$orderData['postData']['address_1'] . ', ' . $orderData['postData']['address_2'] . ', ' . $orderData['postData']['city'] . ', ' . $orderData['postData']['state'] . ', ' . $orderData['postData']['zip'] ;?>
                                                    </td>
                                                </tr>
                                                <tr style="background: #f6f6f6">
                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;"><strong>Shipping
                                                            Address:</strong></td>
                                                    <td style="padding:1%; font-family:Arial, sans-serif;">
                                                        <?=$orderData['postData']['shipping_address_1'] . ', ' . $orderData['postData']['shipping_address_2'] . ', ' . $orderData['postData']['shipping_city'] . ', ' . $orderData['postData']['shipping_state'] . ', ' . $orderData['postData']['shipping_zip'] ;?>
                                                    </td>
                                                </tr>

                                                
                                                <tr>
                                                    <td colspan="2">
                                                        <table border="0"  cellpadding="0"
                                                            cellspacing="0" width="100%" class="prodctItem">
                                                            <tbody>
                                                                <tr >
                                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;"><strong style="width:230px; display: block;">Product
                                                                            Description:</strong></td>
                                                                    <td style="padding:1%; font-family:Arial, sans-serif;">
                                                                        <?=$orderData['cartItem'][0]['name'];?>
                                                                    </td>
                                                                </tr>

                                                                <tr style="background: #f6f6f6">
                                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;">
                                                                        <strong style="width:230px; display: block;">Quantity:</strong></td>
                                                                    <td style="padding:1%; font-family:Arial, sans-serif;">
                                                                        <?=$orderData['cartItem'][0]['quantity'];?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;"><strong style="width:230px; display: block;">
                                                                            Product Price:</strong></td>
                                                                    <td style="padding:1%; font-family:Arial, sans-serif;">
                                                                        $<?=sprintf('%.2f', $orderData['cartItem'][0]['unitPrice']); ?>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>

                                                
                                                 <tr style="background: #f6f6f6">
                                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;">
                                                                        <strong>S/H Fee:</strong>
                                                                    </td>
                                                                    <td style="padding:1%; font-family:Arial, sans-serif;"> $<?=sprintf('%.2f', $orderData['cartItem'][0]['shipping_charge']); ?> </td>
                                                                </tr>
																<tr >
                                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;">
                                                                        <strong >Promo Code:</strong>
                                                                    </td>
                                                                    <td style="padding:1%; font-family:Arial, sans-serif;"> <?=$orderData['cartItem'][0]['promocode']; ?> </td>
                                                                </tr>
                                                                <tr style="background: #f6f6f6">
                                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;"><strong>Sales
                                                                            Tax:</strong></td>
                                                                    <td style="padding:1%; font-family:Arial, sans-serif;">$0.00</td>
                                                                </tr>
                                                                <tr >
                                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;"><strong>Grand
                                                                            Total:</strong></td>
                                                                    <td style="padding:1%; font-family:Arial, sans-serif;">$<?php $grand_total = $orderData['cartItem'][0]['subtotal'];
                                                                        echo sprintf('%.2f', number_format($grand_total, 2)); 
                                                                        ?>
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
        <table border="0" cellpadding="0" cellspacing="0" width="580" style="margin-top:10px; font-family:Arial, sans-serif;">
            <tbody>
                <tr>
                    <td style="text-align: center; color: #999999; font-size:12px; font-family:Arial, sans-serif;">
                        Copyright &#169; 2021 IPG Natural Health. All rights reserved.

                        <!-- <strong>Shipping/Receiving:</strong> 2390 Crenshaw Blvd Suite
                        #239, Torrance, CA
                        90501,

                        <strong>Warehouse:</strong> 2122 Middlebrook Road, Torrance, CA
                        90501; Tel.
                        310-787-1400 -->
                    </td>
                </tr>
                <!-- <tr>
                    <td style="text-align: center; color: #999999; font-size:12px; font-family:Arial, sans-serif;">
                        <a style="color:#e36c09;" href="<?=site_url(" shopping/privacy_policy ");?>">Privacy
                            Policy</a> |
                        <a style="color:#e36c09;" href="<?=site_url(" shopping/terms_of_service ");?>">Terms of
                            Service</a>
                    </td>
                </tr> -->
            </tbody>
        </table>
    </div>
</body>

</html>
