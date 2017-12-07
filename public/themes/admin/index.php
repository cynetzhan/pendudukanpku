<?php



echo theme_view('header');

?>

 <div class="container" style="margin-top:70px;min-height:90vh">
  <div class="row" style="min-height:90vh">
   <div class="col-sm-3">
    <div class="panel panel-primary">
     <div class="panel-heading">
      Menu Sistem
     </div>
     <div class="panel-body">
     <?php echo Contexts::render_menu('text', 'normal'); ?>
     </div>
    </div>
   </div>
   <div class="col-sm-9 body">
	    <?php
            echo Template::message();
            echo Template::block('sub_nav', '');
            echo isset($content) ? $content : Template::content();
        ?>
   </div>
  </div>
	</div>

<?php echo theme_view('footer'); ?>