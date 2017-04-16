<?php require 'application/views/layouts/header.php'; ?>
    <div class="container">
        <div class="h1">Update Item<hr></div>
        <form enctype="multipart/form-data" action="/items/updatesolditem/<?php echo $item->item_id;?>/<?php echo $item->available;?>" method="POST">
            <div class="form-group row">
                <div class="col-md-6">
                    <input required placeholder="Tracking Number" class="form-control" type="text" name="tracking">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <textarea placeholder="Enter any additional information you'd like to give the buyer of this item." class="form-control" name="comment" rows="6"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-bw" name="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>