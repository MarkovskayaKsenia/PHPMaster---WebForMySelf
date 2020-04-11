<?php foreach ($this->groups as $group_id => $group_item): ?>
<section class="sky-form">
    <h4><?= $group_item; ?></h4>
    <div class="row1 scroll-pane">
        <div class="col col-4">
            <?php foreach($this->attributes[$group_id] as $attribute_id => $value): ?>
            <?php $checked = (!empty($filter) && in_array($attribute_id, $filter)) ? ' checked' : null; ?>
            <label class="checkbox">
                <input type="checkbox" name="checkbox" value="<?= $attribute_id; ?>" <?= $checked ?>><i></i><?= $value ?>
            </label>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endforeach; ?>
