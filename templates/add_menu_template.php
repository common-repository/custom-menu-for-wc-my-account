<?php if (!defined('ABSPATH')) {
  exit; // Exit if directly accessed
}

  $addOrGetStatus = new WACMAddMenuClass();
  $addOrGetStatus->WACM_add_menue();

 ?>

<div class="row">
<div class="card">
  <div class="card-header">
  <h3>Add Custome Menu</h3>
  <p>Add Your Own Menu In Woocommerce My Account Page</p>
  <p><b>Note : </b>Every add/update row than reset tha permalink</p>

  </div>
  <div class="card-body">
<form action="" method="POST">
<table width="100%" class="WACM_table">
  <tbody>
    <tr>
      <th>Menu Name</th>
      <th>Menu Position</th>
      <th>Select Page</th>
      <th>Add/Remove</th> 
    </tr>

    <?php foreach ($addOrGetStatus->getMenue() as $key => $value){ ?>
    <tr class="get_html">
      <td><input type="text" required class="form-control" maxlength="20" name="my_cm_menu[]" value="<?php _e($value['my_cm_menu']) ?>"></td>

      <td><input type="number" class="form-control" maxlength="2" name="my_cm_menu_position[]" value="<?php _e($value['my_cm_menu_position']) ?>"></td>

      <td><select type="text" class="form-control" name="my_cm_menu_template[]">
      <?php foreach (get_pages() as $key1 => $value1): ?>
        <option value="<?php _e($value1->ID) ?>" <?php _e(($value['my_cm_menu_template'] == $value1->ID) ? ("selected") : ("")) ?> ><?php _e($value1->post_title) ?></option>
      <?php endforeach ?>
      </select></td>
      
      <td> 
        <i class="fa fa-plus-circle WACM_lrf_add_row" aria-hidden="true"></i>
        <i class="fa fa-minus-circle WACM_lrf_remove" aria-hidden="true"></i>
    </td> 
      </tr>

    <?php  } ?>

  </tbody>
</table>

 <div class="form-group row">
    <div class="col-sm-12 button_div">
      <button type="submit" name="save_login" class="btn btn-primary">Update</button>
    </div>
  </div>
</form>
  </div>
</div>
  </div>
</div>




