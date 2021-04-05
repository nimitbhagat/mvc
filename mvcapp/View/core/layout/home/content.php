<?php

$children = $this->getChildren();

foreach ($children as $key => $value) {
   echo $value->toHtml();
}
