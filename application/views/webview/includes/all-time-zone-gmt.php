<select id="timezone" class="select form-control" name="timeZone">
    <?php  foreach($timezones as $region => $list): ?>
        <optgroup label="<?= $region ?>">
        <?php foreach($list as $timezone => $name): ?>
            <option value="<?= $timezone ?>" <?= ( ( $timezone == $user_timezone ) ? 'selected' : '' ) ?>><?= $name ?></option>
         <?php endforeach; ?>
        </optgroup>
    <?php endforeach; ?>
</select>