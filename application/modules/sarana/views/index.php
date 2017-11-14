<?php

$hiddenFields = array('id_sarana',);
?>
<h1 class='page-header'>
    <?php echo lang('sarana_area_title'); ?>
</h1>
<?php if (isset($records) && is_array($records) && count($records)) : ?>
<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            
            <th>Kecamatan</th>
            <th>Parameter Jalan</th>
            <th>Drainase</th>
            <th>Air Bersih</th>
            <th>Air Limbah</th>
            <th>Persampahan</th>
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
                    e(($value > 0) ? lang('sarana_true') : lang('sarana_false'));
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