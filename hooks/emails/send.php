<?php
Class easyflexbridge_emails_send {
  public $emails = false;

  function __construct($function=false,$fields=false){
    if($function){
      if($function=='easyflexbridge_register_email'){
        $this->emails = self::easyflexbridge_register_email($fields);
      }
      if($function=='easyflexbridge_apply_email'){
        $this->emails = self::easyflexbridge_apply_email($fields);
      }
    } else {
      // nothing
    }
  }

  function easyflexbridge_register_email($fields){

    $header_companyname     = get_field('_mw_easyflexbride_accounts_email_from_name','option');
    $header_companyemail    = get_field('_mw_easyflexbride_accounts_email_from_address','option');
    $message_mailed         = false;
    $notification_mailed    = false;

    if($header_companyname && $header_companyemail){

      $message_to             = $fields['wm_inschrijving_email'];
      $message_subject        = 'Bedankt voor uw registratie.';
      $message_content        = get_field('_mw_easyflexbride_accounts_email_content_reply','option');

      $notification_to        = $header_companyemail;
      $notification_subject   = 'Er is een nieuwe registratie in Easyflex';
      $notification_content   = 'In easyflex kunt u nu uw nieuwe registreerder toegang geven tot zijn of haar Easyflex account.';

      $headers  = "From: ".$header_companyname." <".strip_tags($header_companyemail).">\r\n";
      $headers .= "Reply-To: ".$header_companyname." <".strip_tags($header_companyemail).">\r\n";
      //$headers .= "CC: susan@example.com\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

      if(@mail($message_to, $message_subject, $message_content, $headers)){
        $message_mailed       = true;
      } else {
        $message_mailed       = false;
      }

      if(@mail($notification_to, $notification_subject, $notification_content, $headers)){
        $notification_mailed  = true;
      } else {
        $notification_mailed  = false;
      }

    }

    return array(
      "message_sent"        => $message_mailed,
      "notification_sent"   => $notification_mailed
    );

  }

  function easyflexbridge_apply_email($fields){

    $header_companyname     = get_field('_mw_easyflexbride_vacatures_email_from_name','option')?get_field('_mw_easyflexbride_vacatures_email_from_name','option'):(get_field('_mw_easyflexbride_accounts_email_from_name','option')?get_field('_mw_easyflexbride_accounts_email_from_name','option'):false);
    $header_companyemail    = get_field('_mw_easyflexbride_vacatures_email_from_address','option')?get_field('_mw_easyflexbride_vacatures_email_from_address','option'):(get_field('_mw_easyflexbride_accounts_email_from_address','option')?get_field('_mw_easyflexbride_accounts_email_from_address','option'):false);
    $message_mailed         = false;
    $notification_mailed    = false;

    if($header_companyname && $header_companyemail){

      $message_to             = $fields['wm_vacature_reactie_email'];
      $message_subject        = 'Bedankt voor uw vacature reactie.';
      $message_content        = get_field('_mw_easyflexbride_vacatures_email_content_reply','option');

      $notification_to        = $header_companyemail;
      $notification_subject   = 'Er is een nieuwe vacature reactie in Easyflex';
      $notification_content   = 'In easyflex kunt u nu uw nieuwe vacature reactie verwerken.';

      $headers  = "From: ".$header_companyname." <".strip_tags($header_companyemail).">\r\n";
      $headers .= "Reply-To: ".$header_companyname." <".strip_tags($header_companyemail).">\r\n";
      //$headers .= "CC: susan@example.com\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

      if(@mail($message_to, $message_subject, $message_content, $headers)){
        $message_mailed       = true;
      } else {
        $message_mailed       = false;
      }

      if(@mail($notification_to, $notification_subject, $notification_content, $headers)){
        $notification_mailed  = true;
      } else {
        $notification_mailed  = false;
      }

    }

    return array(
      "message_sent"        => $message_mailed,
      "notification_sent"   => $notification_mailed
    );

  }
}
?>
