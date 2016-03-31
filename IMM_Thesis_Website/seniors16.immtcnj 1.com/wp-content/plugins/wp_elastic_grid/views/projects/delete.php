<div class="wrap">
  <h2 id="add-new-user"> Delete</h2>

  <div id="ajax-response"></div>

  <form method="post" name="createquiz" id="createuser" class="validate" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <input type="hidden" name="data[id]" value="<?php echo $data['id'];?>">
    <input type="hidden" name="data[egrid_id]" value="<?php echo $data['egrid_id'];?>">
    <table class="form-table">
    <tbody>
      <tr class="form-field form-required">
        <td><?php echo __('Are you sure to delete');?> &quot;<em><?php echo $data['title'];?></em>&quot; ? (All related photo will be deleted)</td>
      </tr>
    </tbody>
  </table>

  <p class="submit">
    <input type="submit" name="createquiz" id="createquizsub" class="button button-primary" value="Delete">
    <a href="admin.php?page=elastic-grid&controller=projects&action=index&egrid_id=<?php echo $_GET['egrid_id']?>" class="button">Cancel</a>
  </p>
</form>
</div>