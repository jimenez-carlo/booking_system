<h2><i class="fa fa-archive"></i> Inventory</h2>
<table class="table table-sm table-striped table-hover table-bordered">
  <thead class="table-primary">
    <tr>
      <th scope="col">ID#</th>
      <th scope="col">Name</th>
      <th scope="col">Qty</th>
      <th scope="col">Price</th>
      <th scope="col">Date Created</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['inventory'] as $res) { ?>
      <tr>
        <td><?php echo $res['id']; ?></td>
        <td><?php echo $res['name']; ?></td>
        <td><?php echo $res['qty']; ?></td>
        <td><?php echo $res['price']; ?></td>
        <td><?php echo $res['date_created']; ?></td>
        <td>
          <button type="button" class="btn btn-sm btn-primary"> Edit <i class="fa fa-edit"></i> </button>
          <button type="button" class="btn btn-sm btn-danger"> Delete <i class="fa fa-trash"></i> </button>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
</div>
<script>
  $('table').DataTable({
    dom: '<"top"<"left-col"B><"center-col"><"right-col"f>> <"row"<"col-sm-12"tr>><"row"<"col-sm-10"l><"col-sm-2">>',
  });
</script>