<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Customer</title>
</head>

<body>
    <table border="0" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto;">
        <tr>
            <td style="border-bottom: 1px solid #E8E8E8; padding:5px 0px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td style="text-align:left;">
                            <img src="<?php echo base_url("public/images/logo_email.png"); ?>" width="160px">
                        </td>
                        <td style="text-align:left; width:300px;">
                            <table  border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td>
                                        <img src="<?php echo base_url("public/images/email-icon.png"); ?>" width="46px">
                                    </td>
                                    <td style="color:#181A19; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                                    <strong>Contact Support</strong><br>
                                    support@earnatural.com
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="text-align:left; padding:10px 0px; ">
                <strong style="display: block;  color: #181A19; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                    Dear <?=$orderData['postData']['card_holder_name'];?>,
                </strong>
                <p style="padding:0px; margin:5px 0px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">Thank you for your order of the following items</p>
            </td>
        </tr>

        <!-- Product Details -->
        <tr>
            <td colspan="2" style="text-align:left; padding:10px 5px; background:#9E005D; color: #fff; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                <strong style="display: block;">
                    Product Details
                </strong>
            </td>
        </tr>
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="text-align:left; padding:3px 5px; border-bottom:1px solid #CECECE; width:270px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">Product Description</th>
                            <th style="text-align:left; padding:3px 5px; border-bottom:1px solid #CECECE; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">Product Price</th>
                            <th style="text-align:center; padding:3px 5px; border-bottom:1px solid #CECECE; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">QTY.</th>
                            <th style="text-align:right; padding:3px 5px; border-bottom:1px solid #CECECE; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align:left; padding:3px 5px; border-bottom:1px solid #CECECE; width:270px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                                <?=$orderData['cartItem'][0]['name'];?>
                            </td>
                            <td style="text-align:left; padding:3px 5px; border-bottom:1px solid #CECECE; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">$<?=sprintf('%.2f', $orderData['cartItem'][0]['unitPrice']); ?></td>
                            <td style="text-align:center; padding:3px 5px; border-bottom:1px solid #CECECE; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;"><?=$orderData['cartItem'][0]['quantity'];?></td>
                            <td style="text-align:right; padding:3px 5px; border-bottom:1px solid #CECECE; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                                $<?php  echo sprintf('%.2f', number_format( $orderData['cartItem'][0]['unitPrice'] * $orderData['cartItem'][0]['quantity'], 2 ));  ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="text-align:left; padding:3px 5px;  width:270px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                            </td>
                            <td colspan="2" style="padding:3px 5px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">Discounted Price</td>
                            <td style="text-align:right; padding:3px 5px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                            $<?php 
                             $subTotal = $orderData['cartItem'][0]['unitPrice'] * $orderData['cartItem'][0]['quantity'];
							 $discount = round($subTotal * 0.33);
							 $discounted_price = $subTotal - $discount;
                             echo sprintf('%.2f', $discounted_price);  ?> 
                            </td>
                        </tr> 
                        <tr> 
                            <td style="text-align:left; padding:3px 5px;  width:270px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                            </td>
                            <td colspan="2" style="padding:3px 5px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">Sales Tax</td>
                            <td style="text-align:right; padding:3px 5px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">$0.00</td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding:3px 5px;  width:270px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                            </td>
                            <td colspan="2" style="padding:3px 5px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">S/H Fee</td>
                            <td style="text-align:right; padding:3px 5px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">$<?=sprintf('%.2f', $orderData['cartItem'][0]['shipping_charge']); ?></td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding:3px 5px;  border-bottom:1px solid #CECECE; width:270px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                            </td>
                            <td colspan="2" style="padding:3px 5px; border-bottom:1px solid #CECECE; color:#181A19; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                                <strong>Grand Total</strong>
                            </td>
                            <td style="text-align:right; padding:3px 5px; border-bottom:1px solid #CECECE; color:#181A19; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                                <strong>$<?php $grand_total = $discounted_price + $orderData['cartItem'][0]['shipping_charge'];
                                    echo sprintf('%.2f', number_format($grand_total, 2)); 
                                ?></strong>
                            </td>
                        </tr> 
                    </tbody>
                </table>
            </td>
        </tr>

        <!-- Transaction Details -->
        <tr>
            <td style="padding-bottom:15px; padding-top:15px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td colspan="2" style="text-align:left; padding:10px 5px; background:#FEF8FB; color: #181A19; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                            <strong style="display: block;">
                                Transaction Details
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; width:175px; padding:3px 5px;">
                            <strong>Transaction ID:</strong>
                        </td>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; padding:3px 5px;"><?=$orderData['order']['transId'] ?></td>
                    </tr>
                    <tr>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; width:175px; padding:3px 5px;">
                            <strong>Date and Time:</strong>
                        </td>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; padding:3px 5px;"><?=date('Y-m-d H:i:s');?></td>
                    </tr>
                   
                </table>
            </td>
        </tr>

        <!-- Order Details -->
        <tr>
            <td style="padding-bottom:15px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td colspan="2" style="text-align:left; padding:10px 5px; background:#FEF8FB; color: #181A19; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                            <strong style="display: block;">
                                Order Details
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; width:175px; padding:3px 5px;">
                            <strong>Order Confirmation#:</strong>
                        </td>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; padding:3px 5px;"><?=$orderData['postData']['customer_id'] ?></td>
                    </tr>
                    <tr>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; width:175px; padding:3px 5px;">
                            <strong>Auth Code:</strong>
                        </td>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; padding:3px 5px;"><?=$orderData['order']['authCode'] ?></td>
                    </tr>
                    <tr>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; width:175px; padding:3px 5px;">
                            <strong>Order Date:</strong>
                        </td>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; padding:3px 5px;"><?=date('Y-m-d');?></td>
                    </tr>
                    <tr>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; width:175px; padding:3px 5px;">
                            <strong>Estd Shipping Date:</strong>
                        </td>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; padding:3px 5px;"><?=date('Y-m-d', strtotime('+3 days'))?></td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Customer Information -->
        <tr>
            <td style="padding-bottom:15px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td colspan="2" style="text-align:left; padding:10px 5px; background:#FEF8FB; color: #181A19; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                            <strong style="display: block;">
                                Customer Information
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; width:175px; padding:3px 5px;">
                            <strong>Customer Name:</strong>
                        </td>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; padding:3px 5px;"><?=$orderData['postData']['card_holder_name'];?> </td>
                    </tr>
                    <tr>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; width:175px; padding:3px 5px;">
                            <strong>Email Address:</strong>
                        </td>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; padding:3px 5px;"><?=$orderData['postData']['email'];?></td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Address -->
        <tr>
            <td style="padding-bottom:15px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td colspan="2" style="text-align:left; padding:10px 5px; background:#FEF8FB; color: #181A19; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                            <strong style="display: block;">
                                Address
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; width:175px; padding:3px 5px;">
                            <strong>Billing Address:</strong>
                        </td>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; padding:3px 5px;">
                        <?=$orderData['postData']['address_1'] . ', ' . $orderData['postData']['address_2'] . ', ' . $orderData['postData']['city'] . ', ' . $orderData['postData']['state'] . ', ' . $orderData['postData']['zip'] ;?>
                     </td>
                    </tr>
                    <tr>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; width:175px; padding:3px 5px;">
                            <strong>Shipping Address:</strong>
                        </td>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; padding:3px 5px;">
                        <?=$orderData['postData']['shipping_address_1'] . ', ' . $orderData['postData']['shipping_address_2'] . ', ' . $orderData['postData']['shipping_city'] . ', ' . $orderData['postData']['shipping_state'] . ', ' . $orderData['postData']['shipping_zip'] ;?>
                    </td>
                    </tr>
                </table>
            </td>
        </tr>

        

        <!-- thanks message -->
        <tr>
            <td style="text-align:left; padding:10px 5px; color:#0B9F47; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                <strong>
                        Thank you for shopping with us.
                </strong>
            </td>
        </tr>

        <!-- copyright-->
        <tr>
                <td style="text-align:center; padding:10px 5px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:14px;">
                        Copyright &copy; 2021 IPG Natural Health. All rights reserved.
                </td>
            </tr>

    </table>
</body>

</html>