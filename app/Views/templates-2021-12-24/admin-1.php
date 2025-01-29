<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
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
                        <td style="text-align:right; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                            <strong>Contact Support</strong> support@earnatural.com
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="text-align:left; padding:10px 0px; ">
                <strong style="display: block;  color: #181A19; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                    Hi Admin,
                </strong>
                <p style="padding:0px; margin:5px 0px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">A new order has been received and below are the order details</p>
            </td>
        </tr>

        <!-- Transaction Details -->
        <tr>
            <td style="padding-bottom:15px;">
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
                            <strong>Auth Code:</strong>
                        </td>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; padding:3px 5px;"><?=$orderData['order']['authCode'] ?></td>
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
                                $<?php  echo sprintf('%.2f', number_format( $orderData['cartItem'][0]['unitPrice'] * $orderData['cartItem'][0]['quantity'], 2 )); 
                                ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="text-align:left; padding:3px 5px;  width:270px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                            </td>
                            <td colspan="2" style="padding:3px 5px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">Discounted Price</td>
                            <td style="text-align:right; padding:3px 5px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                            $<?php 
                             $subTotal = $orderData['cartItem'][0]['unitPrice'] * $orderData['cartItem'][0]['quantity'];
                             $discounted_price = round($subTotal * 0.33) ;
                             echo sprintf('%.2f', $subTotal - $discounted_price);  ?>
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
                                <strong>$<?php $grand_total = $orderData['cartItem'][0]['subtotal'];
                                    echo sprintf('%.2f', number_format($grand_total, 2)); 
                                ?></strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>

        <!-- thanks message -->
        <!-- <tr>
            <td style="text-align:left; padding:10px 5px; color:#0B9F47; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                <strong>
                        Thank you for shopping with us.
                </strong>
            </td>
        </tr> -->

        <!-- copyright-->
        <tr>
            <td style="text-align:center; padding:10px 5px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:14px;">
                Copyright &copy; 2021 IPG Natural Health. All rights reserved.
            </td>
        </tr>

    </table>

    <!-- <table border="0" cellpadding="0" cellspacing="0" style="width:800px; margin:20px auto 5px;">
        <tr>
            <td style="color:#181A19; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">
                <strong>
                        Shipping Details:
                </strong>
            </td>
        </tr>
    </table> -->

    <table border="0" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto 20px; padding:15px; border:1px dashed #707070; position: relative;">
        
        <tr>
            <td colspan="3" style="padding:5px; background:#E8E8E8; color:#181A19; font-family: Arial, Helvetica, sans-serif; font-size:16px;">
                <strong>
                                        Shipping Details:
                                    </strong>
            </td>
        </tr>

        <tr>
            <td style="width:266px;">
            <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                    <tr>
						<td>
							<strong style="color:#181A19; font-family: Arial, Helvetica, sans-serif; font-size:15px; text-transform: uppercase;">Ship From:</strong>
						</td>
					</tr>
                    <tr>
					
					<td>
                    <strong style="display:block; color:#181A19; font-family: Arial, Helvetica, sans-serif; font-size:15px; margin-top:5px;">Earnatural.com</strong>
                    </td></tr>
                    <tr>
                        <td>
                        <p style="display:block; color:#181A19; font-family: Arial, Helvetica, sans-serif; font-size:16px; padding:0px; margin:0px;">2390 Crenshaw Blvd Suite #239, Torrance, CA 90501</p>
                        </td>
                    </tr>
                </table>
                
                
                
            </td>
			
            <td style="width:266px;">
                &nbsp;
            </td>
            <td style="width:266px; text-align: right;">
                <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                    <tr><td style="text-align: right;"><strong style="display:block; color:#181A19; font-family: Arial, Helvetica, sans-serif; font-size:15px; text-transform: uppercase;">SHIP TO:</strong></td></tr>
                    <tr><td style="text-align: right;"><strong style="display:block; color:#181A19; font-family: Arial, Helvetica, sans-serif; font-size:15px; margin-top:5px;">
                        <?=$orderData['postData']['card_holder_name'];?>
                        </strong>
                    </td></tr>
                    <tr>
                        <td style="text-align: right;">
                        <p style="display:block; color:#181A19; font-family: Arial, Helvetica, sans-serif; font-size:16px; padding:0px; margin:0px;">
                            <?=$orderData['postData']['shipping_address_1'] . ', ' . $orderData['postData']['shipping_address_2'] . ', ' . $orderData['postData']['shipping_city'] . ', ' . $orderData['postData']['shipping_state'] . ', ' . $orderData['postData']['shipping_zip'] ;?>
                            </p>
                        </td>
                    </tr>
                </table>
                
                
                
            </td>


        </tr>
    </table>
</body>

</html>