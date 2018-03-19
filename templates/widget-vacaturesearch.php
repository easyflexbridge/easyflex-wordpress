<?php
$obj_searchbar        = new easyflexbridge_searchbar_vacatures;

if($obj_searchbar->searchbar){
  echo '<div id="vacaturesearch">';
  echo '<div class="search-header">';
  echo '<span class="search-title">Zoeken</span>';
  if($obj_searchbar->searchbar['count']){
    echo '<span class="search-count">'.$obj_searchbar->searchbar['count'].'</span>';
  }
  echo '</div>';
  echo '<form class="search-items" action="'.$website_url.'/'.$posttype_base.'" method="get">';
  echo '<div class="search-item" data-filter="Naam">';
  echo '<div class="search-item-title">Functie</div>';
  echo '<div class="search-item-options">';
  echo '<input type="text" value="'.$_GET['Naam'].'" name="Naam" placeholder="Zoek naar functie" />';
  echo '</div>';
  echo '</div>';
  if($obj_searchbar->searchbar['fields']){
    foreach($obj_searchbar->searchbar['fields'] as $search_url => $search_values){
      echo '<div class="search-item" data-filterfield="'.$search_values['field'].'" data-filterparam="'.$search_values['param'].'" data-filterurl="'.$search_url.'">';
      echo '<div class="search-item-title">'.$search_values['label'].'</div>';
      if($search_values['options']){
        echo '<div class="search-item-options">';
        echo '<select name="'.$search_url.'">';
        echo '<option value="" selected="selected">'.($_GET[$search_url]?'Alles in '.strtolower($search_values['label']).'':'Selecteer '.strtolower($search_values['label']).'').'</option>';
        foreach($search_values['options'] as $search_option_url => $search_option_values){
          echo '<option value="'.$search_option_values['url'].'" '.($_GET[$search_url]==$search_option_values['url']?'selected="selected"':'').'>'.$search_option_values['label'].' '.( $_GET && !empty(array_filter($_GET))?'':'('.$search_option_values['count'].')').'</option>';
        }
        echo '</select>';
        echo '</div>';
      }
      echo '</div>';
    }
  }
  echo '<div class="search-actions">
    <button>Zoeken '.($obj_searchbar->searchbar['count']?'in '.$obj_searchbar->searchbar['count'].' vacatures':'').'</button>
  </div>';
  echo '</form>';
  echo '</div>';
}
?>
