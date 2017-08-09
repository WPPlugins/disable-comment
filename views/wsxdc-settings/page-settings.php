<div class="wrap">
    <div id="icon-options-general" class="icon32"><br/></div>
    <h2><?php esc_html_e(WSXDC_NAME); ?> Settings</h2>

    <form method="post" action="<?php echo $network_activated ? 'edit.php?action=adc_settings' : 'options.php';?>">
        <?php settings_fields('adc_settings'); ?>
        <?php do_settings_sections('adc_settings'); ?>

        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button-primary"
                   value="<?php esc_attr_e('Save Changes'); ?>"/>
        </p>
    </form>
</div> <!-- .wrap -->
