<footer>
  <div class="row">
    <div class="large-12 columns">
      <ul class="breadcrumbs">
        <?php 
              $num = 1;
              foreach ($servicesMenu as $array){ 
                $_title = $array['title'.$idiom]!= '' ? $array['title'.$idiom] : $array['title'];
        ?>
        <li>
            <a href="<?=$config['domain'].'/content/body/'.$array['id']?>">
              <?=formatString($_title)?>
            </a>
          </li>
        <?php if ($num++==5) break; } ?>
      </ul>
    </div>  
  </div>

  <div class="row">
    <div class="large-12 columns copy">
      <?=formatString($companyInfo->name)?>&nbsp;&copy;&nbsp;2015&nbsp;-&nbsp;<?=date('Y')?>
      &nbsp;&nbsp;::&nbsp;&nbsp;
      Power By&nbsp;<a href="http://jcloudhost.net" target="_blank">JCM</a>
    </div>
  </div>
</footer>

<script src="<?=base_url()?>js/vendor/jquery.min.js"></script>

<script src="<?=base_url()?>js/foundation.min.js"></script>

<script src="<?=base_url()?>js/jquery.form.min.js"></script>

<script src="<?=base_url()?>js/jquery.smartmenus.js"></script>

<script src="<?=base_url()?>js/functions.js"></script>

<script>
  $(document).foundation();

  $('#main-menu').smartmenus({
      subMenusSubOffsetX: 1,
      subMenusSubOffsetY: -8
  });

  newsletters();

  <?php  
    // if (empty($index)){
    //   echo "goToScroll('#middle');";
    // }
  ?>

</script>

<?php
  if (isset($jsLibraries) && count($jsLibraries)>0){
    foreach ($jsLibraries as $file){

      if (strpos($file, 'http://maps.google.com') !== false)
      {
        echo '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>';
      }

      if (trim($file)!='' && (file_exists('js/'.$file)||file_exists($file)))
      {
        if (strpos($file, 'ckeditor') !== false)
        {
          echo '<script src="'.base_url().$file.'"></script>';
        }
        else
        {
          echo '<script src="'.base_url().'js/'.$file.'"></script>';
        }
      }//file_exists
    }
  }
?>
</body>
</html>
