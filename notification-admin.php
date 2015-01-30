<div class="wrap">
    <h2>WooCommerce Checkout Notification</h2>

    <form method="post" action="options.php">
        <?php settings_fields('wcn-settings'); ?>
        <h4>Status:</h4>
        <p>Enabled: <input type="checkbox" name="enabled" <?php echo (esc_attr( get_option('enabled'))) ? "checked='checked'" : ""; ?> size="20"></p>
        <hr />
        <h4>Message to Display:</h4>
        <p><textarea name="message" rows="5" cols="60"><?php echo esc_attr( get_option('message') ); ?></textarea></p>
        <?php submit_button(); ?>
    </form>
</div>
