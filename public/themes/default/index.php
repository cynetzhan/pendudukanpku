<?php echo theme_view('header'); ?>
<!-- Start of Main Container -->
    <?php
    echo theme_view('_sitenav');
    ?>

    <?php
    echo Template::message();
    echo isset($content) ? $content : Template::content();
    ?>

    <?php
    echo theme_view('footer');
    ?>