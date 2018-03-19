<?php
$form_signup_post            = $_POST['easyflexbridge_flexwerkerinschrijven'];
$form_signup_field_info      = _mw_easyflexbridge_mapping_account_apply(array());
$form_signup_field_manditory = array('wm_inschrijving_geslacht','wm_inschrijving_burgerlijkestaat','wm_inschrijving_voorletters','wm_inschrijving_achternaam','wm_inschrijving_email','wm_inschrijving_adres','wm_inschrijving_huisnummer','wm_inschrijving_postcode','wm_inschrijving_plaats','wm_inschrijving_landcode');
$form_signup_field_options   = get_field('_mw_easyflexbridge_account_shortcode_apply','options');

//print_r($form_signup_post);

echo '<form id="accountapply" action="" method="post" enctype="multipart/form-data">';

echo '<div class="register-header">';
echo '<h3>Registreren</h3>';
echo '</div>';
if($form_signup_post){
  if($form_signup_post['feedback']['success']){
    $class="success";
  } else {
    $class="error";
  }
  echo '<div class="register-message '.$class.'">';
  echo $form_signup_post['feedback']['message'];
  echo '</div>';
}
echo '<div class="register-items">';
if($form_field_options){
  foreach ($form_signup_field_options as $key => $values) {
    $field_label      = $values['label'];
    $field_key        = $values['value'];
    $field_manditory  = (in_array($field_key,$form_signup_field_manditory)?true:false);
    echo _mw_easyflexbridge_render_register_field($field_key,$form_signup_field_info,$field_manditory);
    _mw_easyflexbridge_remove_register_array_item($field_key, $form_field_manditory);
  }
}
if(!empty($form_signup_field_manditory)){
  foreach ($form_signup_field_manditory as $key => $field_key) {
    echo _mw_easyflexbridge_render_register_field($field_key,$form_signup_field_info,true);
  }
}
echo '</div>';
echo '<div class="register-actions">';
echo '<button>Inschrijven</button>';
echo '</div>';
echo '</form>';

function _mw_easyflexbridge_render_register_field($field_key,$fields_array,$field_manditory){
  $fields_info      = $fields_array['choices'];

  $field            = '';
  if($field_key=='wm_vacature_idnr'){


  } else if( $field_key=='wm_inschrijving_geslacht' ) {
    $field .= '<div class="apply-item" data-item="'.$field_key.'" data-required="'.($field_manditory?'required':'notrequired').'">';
    $field .= '<label>'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'Geslacht').''.($field_manditory?'<span class="required">*</span>':'').'</label>';
    $field .= '<div class="field">';
    $field .= '
    <select name="easyflexbridge_flexwerkerinschrijven['.$field_key.']">
      <option value="default" selected="selected" disabled="disabled">Selecteer</option>
      <option value="20091">Man</option>
      <option value="20092">Vrouw</option>
    </select>';
    $field .= '</div>';
    $field .= '</div>';
  } else if( $field_key=='wm_inschrijving_burgerlijkestaat' ) {
    $field .= '<div class="apply-item" data-item="'.$field_key.'" data-required="'.($field_manditory?'required':'notrequired').'">';
    $field .= '<label>'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'Geslacht').''.($field_manditory?'<span class="required">*</span>':'').'</label>';
    $field .= '<div class="field">';
    $field .= '
    <select name="easyflexbridge_flexwerkerinschrijven['.$field_key.']">
      <option value="default" selected="selected" disabled="disabled">Selecteer</option>
      <option value="21660">Ongehuwd</option>
      <option value="21661">Gehuwd</option>
      <option value="21662">Samenwonend</option>
      <option value="21663">Gescheiden</option>
    </select>';
    $field .= '</div>';
    $field .= '</div>';
  } else if( $field_key=='wm_inschrijving_landcode' ) {
    $field .= '<div class="apply-item" data-item="'.$field_key.'" data-required="'.($field_manditory?'required':'notrequired').'">';
    $field .= '<label>'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'Land').''.($field_manditory?'<span class="required">*</span>':'').'</label>';
    $field .= '<div class="field">';
    $field .= '
    <select name="easyflexbridge_flexwerkerinschrijven['.$field_key.']">
      <option value="NL" selected="selected">Nederland</option>
    </select>';
    $field .= '</div>';
    $field .= '</div>';
  } else if( $field_key=='wm_inschrijving_cv' ) {
    $field .= '<div class="apply-item" data-item="'.$field_key.'" data-required="'.($field_manditory?'required':'notrequired').'">';
    $field .= '<label>'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'CV').''.($field_manditory?'<span class="required">*</span>':'').'</label>';
    $field .= '<div class="field">';
    $field .= '<input type="file" name="easyflexbridge_flexwerkerinschrijven['.$field_key.']" value="" placeholder="'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'Onbekend').'" />';
    $field .= '</div>';
    $field .= '<small>Maximaal 5mb</small>';
    $field .= '</div>';
  } else if( $field_key=='wm_inschrijving_foto' ) {
    $field .= '<div class="apply-item" data-item="'.$field_key.'" data-required="'.($field_manditory?'required':'notrequired').'">';
    $field .= '<label>'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'Foto').''.($field_manditory?'<span class="required">*</span>':'').'</label>';
    $field .= '<div class="field">';
    $field .= '<input type="file" name="easyflexbridge_flexwerkerinschrijven['.$field_key.']" value="" placeholder="'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'Onbekend').'" />';
    $field .= '</div>';
    $field .= '<small>Maximaal 0.5mb</small>';
    $field .= '</div>';
  } else {
    $field .= '<div class="apply-item" data-item="'.$field_key.'" data-required="'.($field_manditory?'required':'notrequired').'">';
    $field .= '<label>'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'Onbekend').''.($field_manditory?'<span class="required">*</span>':'').'</label>';
    $field .= '<div class="field">';
    $field .= '<input type="text" name="easyflexbridge_flexwerkerinschrijven['.$field_key.']" value="" placeholder="'.($fields_info["{$field_key}"]?$fields_info["{$field_key}"]:'Onbekend').'" />';
    $field .= '</div>';
    $field .= '</div>';
  }
  return $field;
}
function _mw_easyflexbridge_remove_register_array_item($element, &$array){
  $index = array_search($element, $array);
  if($index !== false){
      unset($array[$index]);
  }
}
?>
