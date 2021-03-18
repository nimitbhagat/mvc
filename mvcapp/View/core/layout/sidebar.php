<?php

  $childrens = $this->getChildren();
  
  foreach ($childrens as $key => $value) {
      echo $value->toHtml();
  }

?>
