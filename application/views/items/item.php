<?php require 'application/views/layouts/header.php';
$_POST['item_name'] = $item->item_name;
$_POST['price'] = $item->price;
$_POST['shipping'] = $item->shipping;
$_POST['seller_id'] = $item->account_id;
$_POST['item_id'] = $item->item_id;
?>
   <div class="container">
        <div class="row">
            <?php include 'application/views/includes/category-menu.php';?>
            <div class="col-md-9">
                <div class="card">
                    <img src="<?php if(file_exists('uploads/item_'. $item->item_id)) {echo '/uploads/item_'.$item->item_id;} else {echo 'https://placehold.it/800x300';}?>" alt="">
                    <div class="card-block">
                        <h4 style="display:inline-block;"><?php echo $item->item_name?></h4>
                        <h5 class="float-right" style="display:inline-block;">$<?php echo number_format((float)$item->price, 2, '.', ''); ?></h5>
                        <p><?php echo $item->description?></p>
                        <div class="text-left">
                            <form action="/items/purchaseitem" method="POST">
                                <input type="hidden" name="id" type="Number" value="<?php echo htmlspecialchars($item->item_id); ?>" >
                                <button type="submit" class="btn-ss btn-bw"" name="submit"> Purchase
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <big>
                            <?php
                            if(isset($item->rating)){
                                $avgReview=$item->rating;
                            }
                            else{
                                $avgReview = 0;
                            }
                            for ($i=0; $i<5; $i++) {
                                if ($avgReview - $i >= 0.5)
                                    echo '&#9733; ';
                                else
                                    echo '&#9734; ';
                            }?>
                        </big>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>
