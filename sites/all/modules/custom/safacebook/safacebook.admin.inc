<?php

function safacebook_admin_settings() {
    
    $form['safacebook_api_key'] = array(
        '#type' => 'textfield',
        '#title' => t('Facebook API Key'),
        '#description' => t('Facebook API Key'),
        '#default_value' => variable_get('safacebook_api_key', ''),
        '#size' => 50,
    );
    
    $form['safacebook_secret'] = array(
        '#type' => 'textfield',
        '#title' => t('Facebook Secret'),
        '#description' => t('Facebook Secret'),
        '#default_value' => variable_get('safacebook_secret', ''),
        '#size' => 50,
    );
    
    return system_settings_form($form);
    
}