<div class="container mt-3">

  <div class="row">
    <div class="col-12">

      <div class="card">
        <div class="card-header bg-primary text-white">
          <i class="fa fa-shopping-bag"></i> <?php echo $data['tag']; ?>
        </div>
        <div class="card-body">
          <div class="container">
            <div class="row">
              <?php if (!empty($data['inventory'])) { ?>
                <div class="col-12 mb-3">
                  <input type="search" class="form-control" id="search-item" placeholder="Search items...">
                </div>
                <br>
                <?php foreach ($data['inventory'] as $res) { ?>
                  <div class="col-3 item-box" data-name="<?php echo strtolower($res['name']); ?>">
                    <form method="POST" name="add_to_cart">
                      <input type="hidden" name="product_id" value="<?php echo $res['id']; ?>">
                      <input type="hidden" name="price" value="<?php echo $res['price']; ?>">
                      <div class="card">
                        <div class="card-header bg-primary text-white">
                          <i class="fa fa-tags"></i> <?php echo $res['name']; ?>
                        </div>
                        <div class="card-body">
                          <center>
                            <img src="images/products/<?php echo $res['image']; ?>" style="width:100px;height:100px;text-align:center" />
                          </center>
                          <h5 class="card-title">₱ <?php echo $res['price']; ?></h5>
                          <p class="card-text"><?php echo $res['description']; ?></p>
                        </div>
                        <div class="card-footer" style="display: flex;">
                          <div class="input-group mb-3">
                            <button class="btn btn-primary" type="submit" id="button-addon1">Add To Cart <i class="fa fa-plus"></i></button>
                            <input type="number" name="qty" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" value="1" min="1" max="<?php echo $res['qty']; ?>">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <p>No Result. </p>
              <?php } ?>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<script>
  var search = document.querySelector("#search-item"),
    images = document.querySelectorAll(".item-box");

  search.addEventListener("keyup", e => {
    // if (e.key == "Enter") {
    let searcValue = search.value,
      value = searcValue.toLowerCase();
    images.forEach(image => {
      if (image.dataset.name.includes(value)) {
        return image.style.display = "block";
      }
      image.style.display = "none";
    });
    // }
  });

  search.addEventListener("keyup", () => {
    if (search.value != "") return;
    images.forEach(image => {
      image.style.display = "block";
    })
  })
</script>
<br>