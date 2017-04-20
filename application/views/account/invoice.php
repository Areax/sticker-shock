<!--print invoice for only order id-->
<?php
require 'application/views/layouts/header.php'; ?>

<div class="container">
    <div class="card">
        <img class="card-img-top img-fluid" style="object-fit: contain;" src="<?php if(file_exists('uploads/item_'. $item->item_id)) {echo '/uploads/item_'.$item->item_id;} else {echo 'https://placehold.it/800x300?text=Image+Unavailable';}?>" alt="">
        <div class="card-footer">
            <h4>Order #<?php echo $invoice->order_id .': ';?><?php echo $item->item_name?></h4>
            <span><b>Seller: </b></span> <a href="/account/profile/<?php echo $seller_account->user_id;?>"><?php echo $seller_account->username;?></a> <br>
            <span><b>Buyer: </b></span> <a href="/account/profile/<?php echo $buyer_account->user_id;?>"><?php echo $buyer_account->username;?></a> <br>
            <span><b>Size: </b></span><?php echo $invoice->size ?><br>
            <span><b>Shipping Address: </b></span><?php echo $invoice->address_1  .' '. $invoice->address_2.' '.$invoice->city ?>, <?php echo $invoice->state .' '. $invoice->zip ?><br>
            <span><b>Order Date: </b></span> <?php echo date("m/d/Y g:i A ", strtotime($invoice->completion_date)); echo date_default_timezone_get(); ?> <br>
            <span><b>Price: </b></span> $<?php echo number_format((float)$invoice->price, 2, '.', '')?> <br>
            <span><b>Shipping: </b></span> $<?php echo number_format((float)$invoice->shipping, 2, '.', '')?> <br>
            <span><b>Total: </b></span> $<?php echo number_format((float)$invoice->total, 2, '.', '') ?> <br>
        </div>
    </div>
</div>


<?php require 'application/views/layouts/footer.php'; ?>

