(function($){
    $(document).ready(function(){

$(document).on("click",".WACM_lrf_remove",function() {
  $(this).parent().parent().fadeOut().remove();
});

$(document).on("click",".WACM_lrf_add_row",function() {
  $(this).parent().parent().after(`<tr>
      <td><input required type="text" class="form-control" maxlength="20" name="my_cm_menu[]" ></td>
      <td><input type="number" class="form-control" maxlength="2" name="my_cm_menu_position[]" ></td>
      <td><select type="text" class="form-control" maxlength="" name="my_cm_menu_template[]" >
      `+$("form").find("select").html()+`
      </select></td><td> 
        <i style="font-size: 24px;color: green;" class="fa fa-plus-circle WACM_lrf_add_row" aria-hidden="true"></i>
        <i style="font-size: 24px;color: red;" class="fa fa-minus-circle WACM_lrf_remove" aria-hidden="true"></i>
    </td></tr>`);
});

})
})(jQuery);
