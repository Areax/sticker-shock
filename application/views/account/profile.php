<!--This page show all listing of a seller and their review-->

<?php require 'application/views/layouts/header.php'; ?>
    <div class="container">
        <div class="h1"><?php echo ucfirst($user->username); ?>'s Account History </div><br>
        <div class="h2">Listings</div>
        <hr>
        <?php if(count($listings) > 0) {?>
            <ul class="list-unstyled"><?php
            foreach($listings as $item) {?>
                <li class="media">
                    <img class="mr-3" style="width:64px; height:64px;" src="<?php if(file_exists('uploads/item_'.$item->item_id)) {echo '/uploads/item_'.$item->item_id;} else echo 'https://placehold.it/700x400?text=Image+Unavailable'; ?>" alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-0 mb-1"><?php if($item->available){?><a href="/items/item/<?php echo $item->item_id?>"><?php echo $item->item_name?></a><?php } else echo $item->item_name;?></h5>
                        <?php echo $item->description?>
                    </div>
                </li>
                <?php if(end($listings) !== $item){
                echo '<hr>';
                }?>
                <?php }?>
            </ul> <?php } else {echo '<hr><p>They have no listings!';}?>
        <br>
        <div class="h2">Reviews</div><hr>
        <?php if(count($reviews) > 0){ ?> <ul class="list-unstyled"> <?php foreach($reviews as $review) {?>
            <li class="media">
                <div class="media-body">
                    <?php
                        for ($j=0; $j<5; $j++) {
                            if ($review->rating - $j >= 0.5)
                                echo '&#9733; ';
                            else
                                echo '&#9734; ';
                        }
                        echo $review->title;
                    ?>
                   <br>
                   <small>
                        <?php
                            $date = strtotime($review->review_date);
                            $formatted_date = date("F d, Y", $date);
                            echo 'By '. $users->readUser($review->reviewer_id)->username.' on ' . $formatted_date?>
                   </small>
                   <p><?php echo $review->comment; ?></p>
                    <?php
                      if(end($reviews) !== $review){
                        echo '<hr>';
                        }?>
                </div>
            </li>
        <?php }?></ul><?php } else {echo '<p>They have no reviews yet!';}?>
        </div>
    </div>
</div>
<?php require 'application/views/layouts/footer.php'; ?>

