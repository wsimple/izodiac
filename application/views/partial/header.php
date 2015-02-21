<!DOCTYPE html>
<html class="no-js" lang="es">
  <head>
    <title><?=$config['title']?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="y_key" content="64b257ab4f44157c">

    <meta name="description" content="<?=$config['description']?>">

    <meta name="author" content="<?=$config['author']?>">

    <meta name="copyright" content="<?=$config['copyright']?>">

    <meta name="keywords" lang="en" content="<?=$config['keywords']?>" />

    <meta name="reply-to" content="<?=$config['contact'][1]?>">

    <link rel="stylesheet" href="<?=base_url()?>css/foundation.css" />

    <link rel="stylesheet" href="<?=base_url()?>css/style.css">

    <!-- Main Menu -->
    <link href="<?=base_url()?>css/mainMenu/sm-core-css.css" rel="stylesheet" type="text/css" />
    
    <link href="<?=base_url()?>css/mainMenu/sm-clean/sm-clean.css" rel="stylesheet" type="text/css" />

    <script src="<?=base_url()?>js/vendor/modernizr.min.js"></script>

    <link rel="shortcut icon" href="http://websarrollo.com/img/favicon.ico" type="image/x-icon">
</head>
<body>

<div class="row top_info">
    <div class="large-12 columns ">
       <div class="row">
           <div class="large-6 columns font_12 no_padding ">
                <img src="<?=base_url()?>/img/mail67x50.png" width="15" height="15" alt="">&nbsp;<a href="mailto:<?=$companyInfo->email?>"><?=$companyInfo->email?></a>
                &nbsp;&nbsp;
                <img src="<?=base_url()?>/img/phone20x20.png" width="15" height="15" alt="">&nbsp;<?=$companyInfo->tlf?>
           </div>
           <div class="large-2 columns no_padding">
                &nbsp;
           </div>
            <div class="large-4 columns font_12 text_right">
                 <img src="<?=base_url()?>/img/tagbum20x20.png" width="15" height="15" alt="">&nbsp;Follow me on:&nbsp;<a href="http://tagbum.com/Izodiac">tagbum.com</a>
           </div>
       </div>
    </div>
</div>

<div class="row">&nbsp;</div>

<div class="row logo-row">
    <div class="large-5 columns no_padding">
        <img src="<?=base_url()?>/img/logo.png" class="logo left" alt="">
    </div>
    <div class="large-7 columns">
        <?php include ('mainMenu.php'); ?>
    </div>
</div>

<div class="row full-width orbit-wrap" id="map">
    <ul class="" data-orbit data-options="bullets:false; pause_on_hover: false; timer_speed: 3000; slide_number: true; slide_number_text: de; timer: true">
        <li>
            <img src="<?=base_url()?>img/orbit/1.jpg" alt="banner" />
        </li> 
        <li>
            <img src="<?=base_url()?>img/orbit/2.jpg" alt="banner" />
        </li> 
        <li>
            <img src="<?=base_url()?>img/orbit/3.jpg" alt="banner" />
        </li> 
        <li>
            <img src="<?=base_url()?>img/orbit/4.jpg" alt="banner" /> 
        </li>
    </ul>
</div>

<div class="row">
    <div class="large-12 columns">
        <div class="row title_content_bar">
            <img src="<?=base_url()?>/img/content40x40.png" width="20" height="20" alt="browse">
                <?php 
                    if (isset($content)){
                        if ($idiom=='_english' && $content->title_english!=''){
                            echo formatString($content->title_english);
                        }else{
                            echo formatString($content->title);
                        }
                ?>
                        <small>
                            <?=$language->line('general_writtenby_label')?>&nbsp;<a href="http://tagbum.com/Izodiac"><?=formatString($content->author)?></a>
                            <?=' '.$language->line('general_article_on').' '.formatDate($array['date'])?>
                        </small>
                <?php 
                    }else{ 
                        echo $language->line('general_title_news'); 
                    }    
                ?>
        </div>
    </div>
</div>

<div class="row margin_b">
    <div class="large-10 columns" role="content">