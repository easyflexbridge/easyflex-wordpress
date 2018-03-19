<?php
$form_vacature_id     = get_field('wm_vacature_idnr',$post_id);

if(!$form_vacature_id){
  $form_post            = $_POST;
  $form_field_info      = _mw_easyflexbridge_mapping_vacature_apply(array());
  $form_field_manditory = array('wm_vacature_reactie_geslacht','wm_vacature_reactie_voorletters','wm_vacature_reactie_achternaam','wm_vacature_reactie_email','wm_vacature_reactie_plaats','wm_vacature_reactie_adres','wm_vacature_reactie_huisnr','wm_vacature_reactie_land');
  $form_field_options   = get_field('_mw_easyflexbride_vacatures_reply_items','options');
  $form_login_info      = isset($_SESSION["easyflexbridge"]["flexwerker"])?$_SESSION["easyflexbridge"]["flexwerker"]:false;
  $form_login_session   = isset($_SESSION["easyflexbridge"]["session"])?$_SESSION["easyflexbridge"]["session"]:false;



  echo '<form id="vacatureapply" action="" method="post" enctype="multipart/form-data">';
  if($form_post){
    //print_r($form_post['easyflexbridge_vacaturereactie']);
    $success = $form_post['easyflexbridge_vacaturereactie']['feedback']['success'];
    if($success){
      $class="success";
    }
    if(!$success){
      $class="error";
    }
    echo '<div class="apply-message '.$class.'">';
    //echo 'Uw reactie is niet verstuurd.';
    print_r($form_post['easyflexbridge_vacaturereactie']['feedback']['message']);
    echo '</div>';
  }

  echo '<div class="apply-items">';
  /*MANDITORY ID*/
  echo '<div class="apply-item" data-item="wm_vacature_idnr" data-required="required">';
  echo '<label>Vacature nummer<span class="required">*</span></label>';
  echo '<div class="field">';
  echo '<input type="text" name="easyflexbridge_vacaturereactie[wm_vacature_idnr]" value="'.$form_vacature_id.'" placeholder="Vacature nummer" readonly="readonly" />';
  echo '</div>';
  echo '</div>';
  /*END MANDITORY ID*/
  if($form_field_options){
    foreach ($form_field_options as $key => $values) {
      $field_label      = $values['label'];
      $field_key        = $values['value'];
      $field_manditory  = (in_array($field_key,$form_field_manditory)?true:false);
      echo _mw_easyflexbridge_render_field($field_key,$form_field_info,$field_manditory);
      _mw_easyflexbridge_remove_array_item($field_key, $form_field_manditory);
    }
  }
  if(!empty($form_field_manditory)){
    foreach ($form_field_manditory as $key => $field_key) {
      echo _mw_easyflexbridge_render_field($field_key,$form_field_info,true);
    }
  }
  echo '</div>';
  echo '<div class="apply-actions">';
  if($form_login_session){
    echo '<input type="hidden" name="easyflexbridge_vacaturereactie[wm_session]" value="'.$form_login_session.'" readonly="readonly" />';
  }
  echo '<button>Reageer op vacature</button>';
  echo '</div>';
  echo '</form>';
}


function _mw_easyflexbridge_render_field($field_key,$fields_array,$field_manditory){
  $fields_info      = $fields_array['choices'];
  $fields_login     = isset($_SESSION["easyflexbridge"]["flexwerker"])?$_SESSION["easyflexbridge"]["flexwerker"]:false;
  if($fields_login){
    $field_value_mapping = array();
    $field_value_mapping['wm_vacature_reactie_geslacht']    = $fields_login['fw_geslacht']!=''?($fields_login['fw_geslacht']=='Vrouw'?'20092':'20091'):'default';
    $field_value_mapping['wm_vacature_reactie_voorletters'] = $fields_login['fw_voorletters'];
    $field_value_mapping['wm_vacature_reactie_achternaam']  = $fields_login['fw_achternaam'];
    $field_value_mapping['wm_vacature_reactie_postcode']    = $fields_login['fw_woonadres_postcode'];
    $field_value_mapping['wm_vacature_reactie_adres']       = $fields_login['fw_woonadres_straat'];
    $field_value_mapping['wm_vacature_reactie_huisnr']      = $fields_login['fw_woonadres_huisnummer'];
    $field_value_mapping['wm_vacature_reactie_plaats']      = $fields_login['fw_woonadres_plaats'];
    $field_value_mapping['wm_vacature_reactie_land']        = $fields_login['fw_woonadres_land_code']!=''?$fields_login['fw_woonadres_land_code']:'default';

  }

  $field            = '';
  if($field_key=='wm_vacature_idnr'){


  } else if( $field_key=='wm_vacature_reactie_geslacht' ) {
    $field .= '<div class="apply-item" data-item="'.$field_key.'" data-required="'.($field_manditory?'required':'notrequired').'">';
    $field .= '<label>'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'Geslacht').''.($field_manditory?'<span class="required">*</span>':'').'</label>';
    $field .= '<div class="field">';
    $field .= '
    <select name="easyflexbridge_vacaturereactie['.$field_key.']">
      <option value="default" '.($field_value_mapping[$field_key]=='default'?'selected="selected"':'').' disabled="disabled">Selecteer</option>
      <option value="20091" '.($field_value_mapping[$field_key]=='20091'?'selected="selected"':'').'>Man</option>
      <option value="20092" '.($field_value_mapping[$field_key]=='20092'?'selected="selected"':'').'>Vrouw</option>
    </select>';
    $field .= '</div>';
    $field .= '</div>';
  } else if( $field_key=='wm_vacature_reactie_land' ) {
    $field .= '<div class="apply-item" data-item="'.$field_key.'" data-required="'.($field_manditory?'required':'notrequired').'">';
    $field .= '<label>'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'Land').''.($field_manditory?'<span class="required">*</span>':'').'</label>';
    $field .= '<div class="field">';
    $field .= '
    <select name="easyflexbridge_vacaturereactie['.$field_key.']">
      <option value="default" '.($field_value_mapping[$field_key]=='default'?'selected="selected"':'').' disabled="disabled">Selecteer</option>
      <option value="NL" '.($field_value_mapping[$field_key]=='NL'?'selected="selected"':'').'>Nederland</option>
    </select>';
    $field .= '</div>';
    $field .= '</div>';
  } else if( $field_key=='wm_vacature_reactie_cv' ) {
    $field .= '<div class="apply-item" data-item="'.$field_key.'" data-required="'.($field_manditory?'required':'notrequired').'">';
    $field .= '<label>'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'CV').''.($field_manditory?'<span class="required">*</span>':'').'</label>';
    $field .= '<div class="field">';
    $field .= '<input type="file" name="easyflexbridge_vacaturereactie['.$field_key.']" value="" placeholder="'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'Onbekend').'" />';
    $field .= '</div>';
    $field .= '<small>Maximaal 5mb</small>';
    $field .= '</div>';
  } else if( $field_key=='wm_vacature_reactie_foto' ) {
    $field .= '<div class="apply-item" data-item="'.$field_key.'" data-required="'.($field_manditory?'required':'notrequired').'">';
    $field .= '<label>'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'Foto').''.($field_manditory?'<span class="required">*</span>':'').'</label>';
    $field .= '<div class="field">';
    $field .= '<input type="file" name="easyflexbridge_vacaturereactie['.$field_key.']" value="" placeholder="'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'Onbekend').'" />';
    $field .= '</div>';
    $field .= '<small>Maximaal 0.5mb</small>';
    $field .= '</div>';
  } else {
    $field .= '<div class="apply-item" data-item="'.$field_key.'" data-required="'.($field_manditory?'required':'notrequired').'">';
    $field .= '<label>'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'Onbekend').''.($field_manditory?'<span class="required">*</span>':'').'</label>';
    $field .= '<div class="field">';
    $field .= '<input type="text" name="easyflexbridge_vacaturereactie['.$field_key.']" value="'.$field_value_mapping[$field_key].'" placeholder="'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'Onbekend').'" />';
    $field .= '</div>';
    $field .= '</div>';
  }
  return $field;
}
function _mw_easyflexbridge_remove_array_item($element, &$array){
  $index = array_search($element, $array);
  if($index !== false){
      unset($array[$index]);
  }
}
?>
