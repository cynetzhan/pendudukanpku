<?php



$inline  = '$(".dropdown-toggle").dropdown();';
$inline .= '$(".tooltips").tooltip();';
Assets::add_js($inline, 'inline');
Assets::add_css(array('bootstrap.min.css', 'bootflat.min.css','site.css','font-awesome.min.css'));
Assets::add_js(array('jquery.min.js','bootstrap.min.js'));
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <title><?php
        echo isset($page_title) ? "{$page_title} : " : '';
        e(class_exists('Settings_lib') ? settings_item('site.title') : 'Bonfire');
    ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php e(isset($meta_description) ? $meta_description : ''); ?>">
    <meta name="author" content="<?php e(isset($meta_author) ? $meta_author : ''); ?>">
    
    <?php echo Assets::css(); ?>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
</head>
<body>