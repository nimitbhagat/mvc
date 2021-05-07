<div id="ContentGrid">
   <?php
   $children = $this->getChildren();

   foreach ($children as $key => $value) :
      echo $value->toHtml();
   endforeach;
   ?>

</div>


<script type="text/javascript">
   var mage = new Base();
</script>