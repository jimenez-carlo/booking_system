<div class="container mt-3 accordion" id="accordionExample">
  <h2><i class="fa fa-cube"></i> Orders</h2>
  <?php if (isset($data['orders']['invoice'])) { ?>
    <?php foreach ($data['orders']['invoice'] as $res => $invoice_key) { ?>
      <!-- <div class="col-12 mb-3">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <i class="fa fa-cube"></i> #<?php echo $res; ?> - <?php echo $data['orders']['status'][$res]; ?>
            <button class="accordion-button collapsed btn btn-sm btn-primary pull-right" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo str_replace('#', '', 'accordion_' . $res); ?>" aria-expanded="false">
            </button>
          </div>
          <div class="card-body accordion-collapse collapse" id="<?php echo str_replace('#', '', 'accordion_' . $res); ?>">
            <table class="table table-sm table-striped table-hover table-bordered" style="width:100%">
              <thead class="table-primary">
                <tr>
                  <th scope="col">TXN#</th>
                  <th scope="col">Status</th>
                  <th scope="col">PID#</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Product Price</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Total Price</th>
                  <th scope="col">Last Updated</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $id = 1;
                $price = 0;
                $total_price = 0;
                $qty = 0; ?>
                <?php foreach ($data['orders']['invoice'][$res] as $sub_res) { ?>
                  <tr>
                    <td><?php echo $sub_res['id']; ?></td>
                    <td><?php echo ucwords($sub_res['status']); ?></td>
                    <td><?php echo $sub_res['product_id']; ?></td>
                    <td><?php echo $sub_res['name']; ?></td>
                    <td class="text-end"><?php echo number_format($sub_res['product_price'], 2); ?></td>
                    <td class="text-end"><?php echo $sub_res['qty']; ?></td>
                    <td class="text-end"><?php echo number_format($sub_res['product_price'] * $sub_res['qty'], 2); ?></td>
                    <td><?php echo $sub_res['date_updated']; ?></td>
                    <td class="text-end" style="width: 0.1%;">
                      <?php if ($sub_res['status_id'] == 2) { ?>
                        <form method="post" name="update_transaction">
                          <input type="hidden" name="id" value="<?php echo $sub_res['id']; ?>">
                          <input type="hidden" name="status" value="5">
                          <button type="submit" class="btn btn-sm btn-primary"> Cancel</button>
                        </form>
                      <?php } ?>
                    </td>
                  </tr>
                  </td>
                  <?php $price +=       (in_array(intval($sub_res['status_id']), array(1, 5, 6))) ? 0 :  $sub_res['product_price']; ?>
                  <?php $total_price += (in_array(intval($sub_res['status_id']), array(1, 5, 6))) ? 0 :  $sub_res['product_price'] * $sub_res['qty']; ?>
                  <?php $qty +=         (in_array(intval($sub_res['status_id']), array(1, 5, 6))) ? 0 : $sub_res['qty']; ?>
                <?php } ?>
                <tr class="fw-bold">
                  <td colspan="4">Grand Total</td>
                  <td id="total_price" class="text-end"><?php echo number_format($price, 2); ?></td>
                  <td id="total_qty" class="text-end"><?php echo $qty; ?></td>
                  <td id="total_final_price" class="text-end"><?php echo number_format($total_price, 2); ?></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div> -->
    <?php } ?>
  <?php } ?>
</div>
</div>