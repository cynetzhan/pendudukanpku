<?php

$hiddenFields = array('id_keluhan',);
?>
<h1 class='page-header'>
    <?php echo lang('keluhan_area_title'); ?>
</h1>
<?php if (isset($records) && is_array($records) && count($records)) : ?>
<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            
            <th>Alamat Email</th>
            <th>Kecamatan</th>
            <th>Isi Keluhan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($records as $record) :
        ?>
        <tr>
            <?php
            foreach($record as $field => $value) :
                if ( ! in_array($field, $hiddenFields)) :
            ?>
            <td>
                <?php
                if ($field == 'deleted') {
                    e(($value > 0) ? lang('keluhan_true') : lang('keluhan_false'));
                } else {
                    e($value);
                }
                ?>
            </td>
            <?php
                endif;
            endforeach;
            ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php

endif; ?>