<?php echo theme_view('header');
      echo theme_view('_sitenav');
?>
<style>body { background: #f5f5f5; }</style>

    <?php
    echo isset($content) ? $content : Template::content();

    echo theme_view('footer', array('show' => false));
?>