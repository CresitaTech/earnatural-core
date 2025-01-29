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
                            <img src="<?php echo base_url("public/images/logo_email.png"); ?>" width="299px">
                        </td>
                        <td style="text-align:left; width:240px;">
                            <table  border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td>
                                        <img src="<?php echo base_url("public/images/email-icon.png"); ?>" width="46px">
                                    </td>
                                    <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; width: 180px;">
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
                    Hi Admin,
                </strong>
                <p style="padding:0px; margin:5px 0px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">A new order has been received and below are the order details</p>
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
                                <?=$orderData['cartItem']['name'];?>
                            </td>
                            <td style="text-align:left; padding:3px 5px; border-bottom:1px solid #CECECE; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">$<?=sprintf('%.2f', $orderData['cartItem']['unitPrice']); ?></td>
                            <td style="text-align:center; padding:3px 5px; border-bottom:1px solid #CECECE; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;"><?=$orderData['cartItem']['quantity'];?></td>
                            <td style="text-align:right; padding:3px 5px; border-bottom:1px solid #CECECE; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                                $<?php  echo sprintf('%.2f', number_format( $orderData['cartItem']['subTotal'], 2 )); 
                                ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="text-align:left; padding:3px 5px;  width:270px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                            </td>
                            <td colspan="2" style="padding:3px 5px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">Discounted Price</td>
                            <td style="text-align:right; padding:3px 5px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                            $<?php echo sprintf('%.2f', $orderData['cartItem']['discountedPrice']);  ?> 
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
                            <td style="text-align:right; padding:3px 5px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">$<?=sprintf('%.2f', $orderData['cartItem']['shippingCharge']); ?></td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding:3px 5px;  border-bottom:1px solid #CECECE; width:270px; color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                            </td>
                            <td colspan="2" style="padding:3px 5px; border-bottom:1px solid #CECECE; color:#181A19; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                                <strong>Grand Total</strong>
                            </td>
                            <td style="text-align:right; padding:3px 5px; border-bottom:1px solid #CECECE; color:#181A19; font-family: Arial, Helvetica, sans-serif; font-size:15px;">
                                <strong>
                                $<?php echo sprintf('%.2f', number_format($orderData['cartItem']['grandTotal'], 2));?>
                                </strong> 
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
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; padding:3px 5px;"><?=$orderData['customer_id'] ?></td>
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
					<tr>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; width:175px; padding:3px 5px;">
                            <strong>Promo Code:</strong>
                        </td>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; padding:3px 5px;">
                            <?php echo $orderData['cartItem']['promocode']; ?> 
                            </td>
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
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; padding:3px 5px;"><?=$orderData['postData']->cardHolderName;?> </td>
                    </tr>
                    <tr>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; width:175px; padding:3px 5px;">
                            <strong>Email Address:</strong>
                        </td>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; padding:3px 5px;"><?=$orderData['postData']->email;?></td>
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
                        <?=$orderData['postData']->address1 . ', ' . (!empty($orderData['postData']->address2) ? $orderData['postData']->address2 . ', ' : "" ) . $orderData['postData']->city . ', ' . $orderData['postData']->state . ', ' . $orderData['postData']->zip ;?>
                     </td>
                    </tr>
                    <tr>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; width:175px; padding:3px 5px;">
                            <strong>Shipping Address:</strong>
                        </td>
                        <td style="color:#5F6461; font-family: Arial, Helvetica, sans-serif; font-size:15px; padding:3px 5px;">
                        <?=$orderData['postData']->shippingAddress1 . ', ' . (!empty($orderData['postData']->shippingAddress2) ? $orderData['postData']->shippingAddress2 . ', ' : "" ) . $orderData['postData']->shippingCity . ', ' . $orderData['postData']->shippingState . ', ' . $orderData['postData']->shippingZip ;?>
                    </td>
                    </tr>
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
                Copyright &copy; 2024 IPG Natural Health. All rights reserved.
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

    <table border="0" cellpadding="0" cellspacing="0" style="width:800px; margin:10px auto; border:1px dashed #707070;">
        <tr>
            <td style="background:#E8E8E8; padding:5px; color:#181A19; font-family: Arial, Helvetica, sans-serif; font-size:16px;">
                <strong>
                    Shipping Details:
                </strong>
            </td>
        </tr>
       
        <tr>
            <td style="padding:10px;">
                <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                    <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                <tr>
                                    <td colspan="2">
                                    <img src="<?php echo base_url("public/images/logo_email.png"); ?>" width="299px">
                                    </td>
                                </tr>
                                <tr>
                                <td style="color:#181A19; padding-top:15px; padding-bottom:10px; font-weight:bold; font-family: Arial, Helvetica, sans-serif; font-size:15px; ">
                                         From:
                                    </td>
                                    <td style="color:#181A19;  padding-top:15px; padding-bottom:10px; font-family: Arial, Helvetica, sans-serif; font-size:15px;  text-align: left;">2390 Crenshaw Blvd Suite #239, Torrance, CA 90501
                                    </td>
                                </tr>
                                <tr>
                                <td style="color:#181A19;  font-weight:bold; font-family: Arial, Helvetica, sans-serif; font-size:15px; ">
                                To:
                                    </td>
                                    <td style="color:#181A19; font-family: Arial, Helvetica, sans-serif; font-size:15px; text-align: left;">
                        <?=$orderData['postData']->shippingAddress1 . ', ' . (!empty($orderData['postData']->shippingAddress2) ? $orderData['postData']->shippingAddress2 . ', ' : "" ) . $orderData['postData']->shippingCity . ', ' . $orderData['postData']->shippingState . ', ' . $orderData['postData']->shippingZip ;?>
                                    </td>
                                </tr>
                                
                            </table>
                        </td>
                        
                  </tr>
                </table>
            </td>
        </tr>
    </table>


</body>

</html>