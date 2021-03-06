<?php
/**
 * the view for the support page
 */
?><div class="wrap">
    <?php screen_icon(); ?>
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <h2>1. <?php _e( 'Possible Issues', 'advanced-ads' ); ?></h2>
    <p><?php _e( 'Please fix the red highlighted issues on this page or try to understand their consequences before contacting support.', 'advanced-ads' ); ?></p>

    <?php $messages = array();
    if( ! Advanced_Ads_Checks::php_version_minimum() ) :
	    $messages[] = sprintf(__( 'Your <strong>PHP version (%s) is too low</strong>. Advanced Ads is built for PHP 5.3 and higher. It might work, but updating PHP is highly recommended. Please ask your hosting provider for more information.', 'advanced-ads' ), phpversion() );
    endif;
    if( Advanced_Ads_Checks::cache() && ! defined( 'AAP_VERSION' ) ) :
	    $messages[] = sprintf(__( 'Your <strong>website uses cache</strong>. Some dynamic features like ad rotation or visitor conditions might not work properly. Use the cache-busting feature of <a href="%s" target="_blank">Advanced Ads Pro</a> to load ads dynamically.', 'advanced-ads' ), ADVADS_URL . 'add-ons/advanced-ads-pro/#utm_source=advanced-ads&utm_medium=link&utm_campaign=support' );
    endif;
    if( Advanced_Ads_Checks::wp_update_available() ) :
	    $messages[] = __( 'There is a <strong>new WordPress version available</strong>. Please update.', 'advanced-ads' );
    endif;
    if( Advanced_Ads_Checks::plugin_updates_available() ) :
	    $messages[] = __( 'There are <strong>plugin updates available</strong>. Please update.', 'advanced-ads' );
    endif;
/*    if( Advanced_Ads_Checks::licenses_invalid() ) :
	    $messages[] = sprintf( __( 'One or more license keys for <strong>Advanced Ads add-ons are invalid or missing</strong>. Please add valid license keys <a href="%s">here</a>.', 'advanced-ads' ), admin_url( 'admin.php?page=advanced-ads-settings#top#licenses' ) );
    endif;
    if( Advanced_Ads_Checks::licenses_expired() ) :
	    $messages[] = sprintf( __( '<strong>Advanced Ads</strong> license(s) expired. Support and updates are disabled. Please visit <a href="%s"> the license page</a> for more information.', 'advanced-ads' ), admin_url( 'admin.php?page=advanced-ads-settings#top#licenses' ) );
    endif;*/
    if( Advanced_Ads_Checks::active_autoptimize() && ! defined( 'AAP_VERSION' ) ) :
	    $messages[] = sprintf(__( '<strong>Autoptimize plugin detected</strong>. While this plugin is great for site performance, it is known to alter code, including scripts from ad networks. <a href="%s" target="_blank">Advanced Ads Pro</a> has a build-in support for Autoptimize.', 'advanced-ads' ), ADVADS_URL . 'add-ons/advanced-ads-pro/#utm_source=advanced-ads&utm_medium=link&utm_campaign=support');
    endif;
    if( count( Advanced_Ads_Checks::conflicting_plugins() ) ) :
	    $messages[] = sprintf(__( 'Plugins that are known to cause (partial) problems: <strong>%1$s</strong>. <a href="%2$s" target="_blank">Learn more</a>.', 'advanced-ads' ), implode( ', ', Advanced_Ads_Checks::conflicting_plugins() ), ADVADS_URL . 'manual/known-plugin-conflicts/#utm_source=advanced-ads&utm_medium=link&utm_campaign=support');
    endif;
    if( Advanced_Ads_Checks::ads_disabled() ) :
	    $messages[] = sprintf(__( 'Ads are disabled for all or some pages. See "disabled ads" in <a href="%s">settings</a>.', 'advanced-ads' ), admin_url('admin.php?page=advanced-ads-settings#top#general') );
    endif;
    Advanced_Ads_Checks::jquery_ui_conflict();

    $messages = apply_filters( 'advanced-ads-support-messages', $messages );
    
    if( count( $messages )) :
	foreach( $messages as $_message ) :
	?><div class="message error"><p><?php echo $_message; ?></p></div><?php
	endforeach;
    endif; ?>
    <h2>2. <?php _e( 'Search', 'advanced-ads' ); ?></h2>
    <p><?php _e( 'Use the following form to search for solutions in the manual on wpadvancedads.com', 'advanced-ads' ); ?></p>
    <form action="https://wpadvancedads.com/" method="get">
	<input type="search" name="s"/>
	<input type="submit" value="<?php _e( 'search', 'advanced-ads' ); ?>">
    </form>	
    <h2>3. <?php _e( 'Contact', 'advanced-ads' ); ?></h2>
    <p><?php printf(__( 'Please search the manual for a solution and take a look at <a href="%s" target="_blank">Ads not showing up?</a> before contacting me for help.', 'advanced-ads' ), ADVADS_URL . 'manual/ads-not-showing-up/#utm_source=advanced-ads&utm_medium=link&utm_campaign=support' ); ?></p>
    <?php if( isset( $_POST['advads_support']['email'] ) && array() === $sent_errors ) : ?>
    <p class="advads-success-message"><?php _e( 'Email was successfully sent.', 'advanced-ads' ); ?></p>
    <?php else : ?>
    <?php if( isset( $_POST['advads_support']['email'] ) && count( $sent_errors ) ) : ?>
    <p class="advads-error-message"><?php echo implode( $sent_errors, '</p><p class="advads-error-message">' ); ?></p>
    <?php endif; ?>
    <form action="" method="post">
	<table class="form-table advads-support-form">
	    <tbody>
		<tr>
		    <th scope="row"><label for="advads-support-email"><?php _e( 'your email', 'advanced-ads' ); ?></label></th>
		    <td scope="row"><input id="advads-support-email" class="regular-text" type="email" name="advads_support[email]" value="<?php echo $email; ?>"/></td>
		</tr>
		<tr>
		    <th scope="row"><label for="advads-support-name"><?php _e( 'your name', 'advanced-ads' ); ?></label></th>
		    <td scope="row"><input type="text" class="regular-text" name="advads_support[name]" value="<?php echo $name; ?>"/></td>
		</tr>
		<tr>
		    <th scope="row"><label for="advads-support-text"><?php _e( 'your message', 'advanced-ads' ); ?></label></th>
		    <td scope="row"><textarea name="advads_support[message]"><?php echo $message; ?></textarea></td>
		</tr>
		<tr>
		    <td></td>
		    <td><input type="submit" class="button button-primary" value="<?php _e( 'send', 'advanced-ads' ); ?>"></td>
		</tr>
	    </tbody>
	</table>
    </form>
    <?php endif; ?>
</div>