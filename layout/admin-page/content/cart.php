<div class="container mt-3">
  <div class="row">

    <div class="col-12">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <i class="fa fa-shopping-cart"></i> My Cart
        </div>
        <div class="card-body">
          <table class="table table-sm table-striped table-hover table-bordered">
            <thead class="table-primary">
              <tr>
                <th scope="col">ID#</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Qty</th>
                <th scope="col">Total Price</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $id = 1;
              $price = 0;
              $total_price = 0;
              $qty = 0;  ?>
              <?php foreach ($data['cart'] as $res) { ?>
                <tr>
                  <td><?php echo $id++; //$res['id']; 
                      ?></td>
                  <td><?php echo $res['name']; ?></td>
                  <td class="text-end"><?php echo number_format($res['price'], 2); ?></td>
                  <td class="col-md-2">
                    <form action="post" name="update_cart">
                      <input type="hidden" name="transaction_id" value="<?php echo $res['id']; ?>">
                      <input type="hidden" name="price" value="<?php echo $res['price']; ?>">
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <button class="btn btn-sm btn-primary" type="submit">Update <i class="fa fa-save"></i></button>
                        </div>
                        <input type="text" class="form-control form-control-sm" name="qty" value="<?php echo $res['qty']; ?>" style="text-align:right">
                      </div>
                    </form>
                  </td>
                  <td class="text-end" data-sub-total-id="<?php echo $res['id']; ?>"><?php echo number_format($res['sum_price'], 2); ?></td>
                  <td class="">
                    <form action="post" name="remove_from_cart">
                      <input type="hidden" name="transaction_id" value="<?php echo $res['id']; ?>">
                      <button type="submit" class="btn btn-sm btn-primary btn-remove-row"><i class="fa fa-close"></i> </button>
                    </form>
                  </td>
                  <?php $price += $res['price']; ?>
                  <?php $total_price += $res['sum_price']; ?>
                  <?php $qty += $res['qty']; ?>
                </tr>
              <?php } ?>
              <tr class="fw-bold">
                <td colspan="2">Grand Total</td>
                <td id="total_price" class="text-end"><?php echo number_format($price, 2); ?></td>
                <td id="total_qty" class="text-end"><?php echo $qty; ?></td>
                <td id="total_final_price" class="text-end"><?php echo number_format($total_price, 2); ?></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <form action="post" name="checkout_cart">
          <button class="btn btn-lg btn-primary font-bold rounded-0 w-100">Checkout Now <i class="fa fa-check fa-lg"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>
<br>