<?php

class cfs_hyperlink extends cfs_field
{

    function __construct() {
        $this->name = 'hyperlink';
        $this->label = __( 'Hyperlink', 'cfs' );
    }


    function html( $field ) {
        if ( empty( $field->value ) ) {
            $field->value = array(
                'url'       => 'http://',
                'text'      => '',
                'class'     => '',
                'target'    => '',
            );
        }
    ?>
        <div class="cfs-hyperlink" style="overflow:hidden;">
		    <div class="cfs-hyperlink-url" style="width:49%;float:left;">
                <div>URL</div>
                <input type="text" name="<?php echo $field->input_name; ?>[url]" class="link-url" value="<?php echo $field->value['url']; ?>" />
		    </div>
		    <div class="cfs-hyperlink-text" style="width:49%;float:right;">
                <div>Link Text</div>
                <input type="text" name="<?php echo $field->input_name; ?>[text]" class="link-text" value="<?php echo $field->value['text']; ?>" />
		    </div>
	    </div>
    <?php
    }


    function pre_save( $value, $field ) {
        // convert to a proper associative array when inside a Loop
	    if ( isset( $value[0]['url'] ) && isset( $value[1]['text'] ) ) {
		    $value = array(
			    'url' => $value[0]['url'],
			    'text' => $value[1]['text'],
		    );
	    }
        return serialize( $value );
    }


    function prepare_value( $value, $field ) {
        return unserialize( $value[0] );
    }


    function format_value_for_api( $value, $field ) {
        $output = '';

        if ( ! empty( $value['url'] ) ) {
            $output = '<a href="' . $value['url'] . '">' . $value['text'] . '</a>';
        }

        return $output;
    }
}
