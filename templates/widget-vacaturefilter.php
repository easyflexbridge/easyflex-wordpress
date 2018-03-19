<?php
$obj_filters = new easyflexbridge_filter_vacatures;
//print_r($obj_filters);
if($obj_filters->filters){
  echo '<div id="vacaturefilter">';
  echo '<div class="filter-header">';
  echo '<span class="filter-title">Filter</span>';
  if($obj_filters->filters['count']){
    echo '<span class="filter-count">'.$obj_filters->filters['count'].'</span>';
  }
  echo '</div>';
  if($obj_filters->filters['fields']){
    echo '<div class="filter-items">';
    foreach($obj_filters->filters['fields'] as $filter_url => $filter_values){
      echo '<div class="filter-item" data-filterparam="'.$filter_values['param'].'" data-filterurl="'.$filter_url.'">';
      echo '<div class="filter-item-title">'.$filter_values['label'].'</div>';
      if($filter_values['options']){
        echo '<div class="filter-item-options">';
        echo '<ul>';
        foreach($filter_values['options'] as $filter_option_url => $filter_option_values){
          echo '<li><a href="'.$website_url.'/'.$posttype_base.'/?'.urlencode($filter_url).'='.urlencode($filter_option_values['url']).'"><span class="filter-option-title">'.$filter_option_values['label'].'</span><span class="filter-option-count">'.$filter_option_values['count'].'</span></a></li>';
        }
        echo '</ul>';
        echo '</div>';
      }
      echo '</div>';
    }
    echo '</div>';
  }
  echo '</div>';
}
?>
