<?php
$form_login_post            = $_POST['easyflexbridge_flexwerkerinloggen'];
$form_updating_post         = $_POST['easyflexbridge_flexwerkerupdating'];
$form_login_field_manditory = array('db_inlognaam','db_wachtwoord');
$form_login_checksession    = isset($_SESSION["easyflexbridge"]["session"])?$_SESSION["easyflexbridge"]["session"]:false;
$form_login_checkflexwerker = isset($_SESSION["easyflexbridge"]["flexwerker"])?$_SESSION["easyflexbridge"]["flexwerker"]:false;
//print_r($form_login_post);
//print_r($form_updating_post);
echo '<div id="accountlogin">';
  if( $form_login_checksession || (isset($form_login_post['feedback']['login']['success']) && $form_login_post['feedback']['login']['success']) || isset($form_updating_post['feedback']['login']['success']) && $form_updating_post['feedback']['login']['success'] ){
  echo '<div class="login-header">';
  echo '<h3>Inloggen</h3>';
  echo '<p>Inloggen is gelukt. Uw gegevens zijn 10 minuten beschikbaar om een reactie te kunnen plaatsen, daarna moet u weer opnieuw inloggen om uw gegevens op te halen.</p>';
  echo '</div>';
  } else {
  echo '<div class="login-header">';
  echo '<h3>Inloggen</h3>';
  echo '</div>';
  echo '<form id="accountloginform" action="" method="post" enctype="multipart/form-data">';
    if(isset($form_login_post['feedback']['login']['success']) && !$form_login_post['feedback']['login']['success']){
    echo '<div class="login-message">';
      echo '<p>Inlognaam en/of wachtwoord onjuist.</p>';
    echo '</div>';
    }
    echo '<div class="login-items">';
      echo '<div class="login-item">';
        echo '<label>Gebruikersnaam<span class="required">*</span></label>';
        echo '<div class="field">';
        echo '<input type="text" name="easyflexbridge_flexwerkerinloggen[db_inlognaam]" value="" placeholder="Gebruikersnaam" />';
        echo '</div>';
      echo '</div>';
      echo '<div class="login-item">';
        echo '<label>Wachtwoord<span class="required">*</span></label>';
        echo '<div class="field">';
        echo '<input type="password" name="easyflexbridge_flexwerkerinloggen[db_wachtwoord]" value="" placeholder="Wachtwoord" />';
        echo '</div>';
      echo '</div>';
    echo '</div>';
    echo '<div class="login-actions">';
    echo '<button>Log in</button>';
    echo '</div>';
  echo '</form>';
  }
  if( isset($form_login_post['feedback']['login']['results']['fields']['session']) && $form_login_post['feedback']['login']['results']['fields']['session']!=''){
    if( (isset($form_login_post['feedback']['flexwerker']['success']) && $form_login_post['feedback']['flexwerker']['success']) || (isset($form_updating_post['feedback']['flexwerker']['success']) && $form_updating_post['feedback']['flexwerker']['success']) ){
      echo '<div class="update-header">';
      echo '<h3>Uw gegevens zijn beschikbaar</h3>';
      echo '<p>U kunt nu reageren met gegevens die bij ons bekend zijn. Kloppen deze gegevens niet dan kunt u ze bij het reageren op een vacature aanpassen. Wilt u gegevens wijzigen? Dan kunt u deze doorgeven, zodat wij deze voor u kunnen aanpassen.</p>';
      echo '</div>';
    } else {
      echo '<div class="update-header">';
      echo '<h3>Uw inlog gegevens updaten</h3>';
      echo '<p>Omdat u voor het eerst inlogt moet u een nieuwe gebruikersnaam en wachtwoord kiezen.</p>';
      echo '</div>';
      echo '<form id="accountupdate" action="" method="post" enctype="multipart/form-data">';
        if(isset($form_updating_post['feedback']['flexwerker']['success']) && !$form_updating_post['feedback']['flexwerker']['success']){
        echo '<div class="update-message">';
          echo '<p>Criteria voor nieuwe inlognaam of wachtwoord niet geldig. Probeer het opnieuw.</p>';
        echo '</div>';
        }
        echo '<div class="update-items">';
          echo '<div class="update-item">';
            echo '<label>Uw nieuwe gebruikersnaam<span class="required">*</span></label>';
            echo '<div class="field">';
            echo '<input type="text" name="easyflexbridge_flexwerkerupdating[db_inlognaam]" value="" placeholder="Gebruikersnaam" />';
            echo '</div>';
            echo '<small>Mag geen spaties bevatten en mag niet beginnen met EF_. Minimaal 6 tekens tot maximaal 32 tekens.</small>';
          echo '</div>';
          echo '<div class="update-item">';
            echo '<label>Uw nieuwe wachtwoord<span class="required">*</span></label>';
            echo '<div class="field">';
            echo '<input type="password" name="easyflexbridge_flexwerkerupdating[db_wachtwoord]" value="" placeholder="Wachtwoord" />';
            echo '</div>';
            echo '<small>Mag geen spaties bevatten. Minimaal 6 tekens tot maximaal 32 tekens, met minimaal 1 cijfer en 1 speciaal teken.</small>';
          echo '</div>';
        echo '</div>';
        echo '<div class="update-actions">';
        echo '<input type="hidden" name="easyflexbridge_flexwerkerupdating[db_session]" value="'.(isset($form_login_post['feedback']['login']['results']['fields']['session'])?$form_login_post['feedback']['login']['results']['fields']['session']:$form_updating_post['feedback']['login']['results']['fields']['session']).'" placeholder="Gebruikersnaam" />';
        echo '<button>Update inlog gegevens</button>';
        echo '</div>';
      echo '</form>';
    }
  }
echo '</div>';
?>
