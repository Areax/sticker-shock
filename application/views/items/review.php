<?php require 'application/views/layouts/header.php'; ?>


    <div class="container">
        <div class="h1">Submit a Review<hr></div>
        <form action="/reviews/submit_review" method="POST">
            <div class="form-group row">
                <div class="col-md-6">
                    <select class="form-control" name="rating">
                        <option value="" disabled selected>Select Stars to give</option>
                        <option value="1">&#9733;</option>
                        <option value="2">&#9733;&#9733;</option>
                        <option value="3">&#9733;&#9733;&#9733;</option>
                        <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                        <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <input required type="text" class="form-control" name="title" placeholder="Title" rows="3">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6"><div class="form-group">
                    <textarea class="form-control" rows="3" name="comment" placeholder="Description"></textarea>
                </div></div>
            </div>

            <input type="hidden" name="sellerID" value='<?php echo $sellerID; ?>' />


            <div class="form-group">
                <button type="submit" class="btn-ss btn-bw"" name="submit">Submit</button>
            </div>


        </form>
    </div>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>