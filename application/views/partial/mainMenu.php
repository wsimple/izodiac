<ul id="main-menu" class="sm sm-clean">
<li><a href="<?=$config['domain']?>"><?=$language->line('header_home')?></a></li>
<?php 
  //$field = $idiom == '_english' ? '_english' : '';
  foreach ($mainMenu as $array){ 
    $sub = sub_menu($array['id']);
    $_title = $array['title'.$idiom]!=''?$array['title'.$idiom]:$array['title'];
?> 
      <li>
        <a href="<?=$sub?$config['not_click']:$config['domain'].'/content/body/'.$array['id']?>">
          <?=formatString($_title)?>
        </a> 
          <?php 
              if ($sub){
          ?>
                <ul>  
                    <?php foreach ($sub as $list){ $_title = $list['title'.$idiom]!=''?$list['title'.$idiom]:$list['title']; ?> 
                              <li>
                                <a href="<?=$config['domain'].'/content/body/'.$list['id']?>">
                                  <?=formatString($_title)?>
                                </a> 
                              </li>
                    <?php } ?>
                </ul>
          <?php 
              }//if $sub 
          ?>
      </li>
<?php 
  }//foreach mainMenu 
?>
</ul>