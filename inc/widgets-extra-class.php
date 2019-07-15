<?php
function understrap_in_widget_form($t,$return,$instance){
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'width' => '') );
    if ( !isset($instance['width']) )
        $instance['width'] = null;
    if ( !isset($instance['extra-class']) )
        $instance['extra-class'] = null;
    ?>
	<p>
        <label for="<?php echo $t->get_field_id('width'); ?>">Column width:</label>
        <select id="<?php echo $t->get_field_id('width'); ?>" name="<?php echo $t->get_field_name('width'); ?>">
            <option <?php selected($instance['width'], '');?> value="">auto</option>
			<?php for($i=1; $i<=12; $i++){ ?>
				<option <?php selected($instance['width'], '-'.$i);?> value="-<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php } ?>
        </select>
    </p>
	<p>
		<label for="<?php echo $t->get_field_id('extra-class'); ?>"><?php _e('Extra Class'); ?></label>
        <input type="text" name="<?php echo $t->get_field_name('extra-class'); ?>" id="<?php echo $t->get_field_id('extra-class'); ?>" value="<?php echo $instance['extra-class'];?>" />
    </p>
    
    <?php
    $return = null;
    return array($t,$return,$instance);
}

function understrap_in_widget_form_update($instance, $new_instance, $old_instance){
    $instance['width'] = $new_instance['width'];
    $instance['extra-class'] = strip_tags($new_instance['extra-class']);
    return $instance;
}

function understrap_dynamic_sidebar_params($params){
    global $wp_registered_widgets;
    $widget_id = $params[0]['widget_id'];
    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number'];
    if (isset($widget_opt[$widget_num]['width'])){
			isset($widget_opt[$widget_num]['width']) ? $width = $widget_opt[$widget_num]['width'] : $width = '';
			isset($widget_opt[$widget_num]['extra-class']) ? $extra_class = $widget_opt[$widget_num]['extra-class'] : $extra_class = '';
			$params[0]['before_widget'] = preg_replace('/col/', 'col' . $width . ' ' ,  $params[0]['before_widget'], 1);
            $params[0]['before_widget'] = preg_replace('/class="/', 'class="' . $extra_class . ' ' ,  $params[0]['before_widget'], 1);
    }
    return $params;
}

//Add input fields(priority 5, 3 parameters)
add_action('in_widget_form', 'understrap_in_widget_form',5,3);
//Callback function for options update (priorität 5, 3 parameters)
add_filter('widget_update_callback', 'understrap_in_widget_form_update',5,3);
//add class names (default priority, one parameter)
add_filter('dynamic_sidebar_params', 'understrap_dynamic_sidebar_params');