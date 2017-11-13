<?php echo theme_view('header'); ?>
<!-- Start of Main Container -->
    <?php
    echo theme_view('_sitenav');
    ?>
    <div class="container" style="margin-top:60px">
    <?php
    echo Template::message();
    echo isset($content) ? $content : Template::content();
    ?>
    </div>
    <?php
    echo theme_view('footer');
    ?>