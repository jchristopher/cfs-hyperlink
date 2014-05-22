<?php

class cfs_hyperlink extends cfs_field
{

    function __construct( $parent ) {
        $this->name = 'hyperlink';
        $this->label = __( 'Hyperlink', 'cfs' );
        $this->parent = $parent;
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
        <div>URL</div>
        <input type="text" name="<?php echo esc_attr( $field->input_name ); ?>[url]" class="link-url" value="<?php echo esc_url( $field->value['url'] ); ?>" />
        <div>Link Text</div>
        <input type="text" name="<?php echo esc_attr( $field->input_name ); ?>[text]" class="link-text" value="<?php echo esc_attr( $field->value['text'] ); ?>" />
    <?php
    }


    function pre_save( $value, $field ) {
        return serialize( $value );
    }


    function prepare_value( $value, $field ) {
        return unserialize( $value[0] );
    }


    function format_value_for_api( $value, $field ) {
        $output = '';

        if ( ! empty( $value['url'] ) ) {
            $output = '<a href="' . esc_url( $value['url'] ) . '">' . esc_html( $value['text'] ) . '</a>';
        }

        return $output;
    }
}
