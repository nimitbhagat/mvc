<?php

$children = $this->getChildren();

foreach ($children as $key => $value) {
   echo $value->toHtml();
}

?>

<!-- <div id='grid'>

</div>

<script type="text/javascript">
   var object = new Base();
   object.setParams({
      name: 'nimit',
      email: 'n@gmail.com'
   });

   object.setUrl('http://localhost/mvcapp/index.php?c=product&a=test');
   object.load();
</script> -->