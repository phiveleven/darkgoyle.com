<? 
function console(){
  if (func_num_args() == 1)
    echo '<script>console.log("'.func_get_arg(0).'")</script>';
}
 ?>
