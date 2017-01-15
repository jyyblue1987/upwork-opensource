<select name="timeZone" class="select form-control">
    <option value="">Select Time Zone</option>
    <?php if (!empty($timezones)): ?>
        <?php foreach ($timezones as $tz): ?>
            <option value="<?= $tz->id ?>" <?= !empty($timezone) && $timezone['id'] == $tz->id ? 'selected' : ''?>>(<?= $tz->gmt?>) <?= $tz->name ?></option>
        <?php endforeach; ?>
    <?php endif; ?>
</select>