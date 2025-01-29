<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Simple Order Email</title>

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

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="background-color: #f6f6f6; ">
<div style="width: 580px; margin: 0px auto; padding:10px 0px;">
        <table border="0" width="580" cellpadding="0" cellspacing="0" style="font-family:Arial, sans-serif;">
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
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td style="padding:10px">
                                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family:Arial, sans-serif;">Dear
                                                        <strong><?=$orderData['postData']['card_holder_name'];?>,</strong>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="padding-top:10px; padding-bottom:10px; font-family:Arial, sans-serif;">
                                                        Thank you for your order of the following items:
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0"
                                            style="width:100%;">
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
                                                        <?=date('Y-m-d', strtotime('+7 days'))?>
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
                                                        <?=$orderData['postData']['address_1']. ', ' . $orderData['postData']['address_2'] . ', ' . $orderData['postData']['city'] . ', ' . $orderData['postData']['state'] . ', ' . $orderData['postData']['zip']  ;?>
                                                    </td>
                                                </tr>
                                                <tr style="background: #f6f6f6">
                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;"><strong>Shipping
                                                            Address:</strong></td>
                                                    <td style="padding:1%; font-family:Arial, sans-serif;">
                                                        <?=$orderData['postData']['shipping_address_1'] . ', ' . $orderData['postData']['shipping_address_2'] . ', ' . $orderData['postData']['shipping_city'] . ', ' . $orderData['postData']['shipping_state'] . ', ' . $orderData['postData']['shipping_zip']  ;?>
                                                    </td>
                                                </tr>

                                                <?php $items_total = 0;
                                                foreach ($orderData['cartItem'] as $item){ 
                                                    $items_total = ($item['unitPrice'] * $item['quantity']);
                                                    ?>

                                                <tr>
                                                    <td colspan="2">
                                                        <table border="0"  cellpadding="0"
                                                            cellspacing="0" width="100%" class="prodctItem" ">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;"><strong style="width:230px; display: block;">Product
                                                                            Description:</strong></td>
                                                                    <td style="padding:1%; font-family:Arial, sans-serif;">
                                                                        <?=$item['name'];?>
                                                                    </td>
                                                                </tr>

                                                                <tr style="background: #f6f6f6">
                                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;">
                                                                        <strong style="width:230px; display: block;">Quantity:</strong></td>
                                                                    <td style="padding:1%; font-family:Arial, sans-serif;">
                                                                        <?=$item['quantity'];?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;"><strong style="width:230px; display: block;">
                                                                            Product Price:</strong></td>
                                                                    <td style="padding:1%; font-family:Arial, sans-serif;">
                                                                        $<?=sprintf('%.2f', $item['unitPrice']); ?>
                                                                    </td>
                                                                </tr>
                                                               
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>


                                                <?php } ?>
                                                
                                                 <tr style="background: #f6f6f6">
                                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;">
                                                                        <strong >Shipping/ Handling Fee:</strong>
                                                                    </td>
                                                                    <td style="padding:1%; font-family:Arial, sans-serif;"> $0.00 </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;"><strong>Sales
                                                                            Tax:</strong></td>
                                                                    <td style="padding:1%; font-family:Arial, sans-serif;">$0.00</td>
                                                                </tr>
                                                                <tr style="background: #f6f6f6">
                                                                    <td width="230" style="padding:1%; width:230px; font-family:Arial, sans-serif;"><strong>Grand
                                                                            Total:</strong></td>
                                                                    <td style="padding:1%; font-family:Arial, sans-serif;">$<?php $grand_total = $items_total + 0.00;
                                                                        echo sprintf('%.2f', number_format($grand_total, 2)); 
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                
                                            </tbody>
                                        </table>

                                        <table border="0" cellpadding="0" cellspacing="0"
                                            style="width:100%; margin-top:10px;">
                                            <tbody>
                                                <tr>
                                                    <td style="color:#036e04; font-family:Arial, sans-serif;">Thank you for shopping with us.</td>
                                                </tr>
                                            </tbody>
                                        </table>


                                        <!-- <p style="margin-top:0px;">Your estimated delivery date is between
                        <span style="font-weight:bold; color:#036e04;">
                            <?=date('Y-m-d')?> and
                            <?=date('Y-m-d', strtotime('+7 days'));
        ?>.</span>
                    </p> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>

        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="580" style="margin:10px 0px; font-family:Arial, sans-serif;">
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
                        <a style="color:#e36c09;" href="<?=site_url(" shopping/privacy_policy ");?>" >Privacy
                            Policy</a> |
                        <a style="color:#e36c09;" href="<?=site_url(" shopping/terms_of_service ");?>" >Terms of
                            Service</a>
                    </td>
                </tr> -->
            </tbody>
        </table>
    </div>
</body>

</html>
