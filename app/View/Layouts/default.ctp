<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
  $cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
  <?php echo $this->Html->charset(); ?>
  <title>Memorias de mi embarazo | MoM to MoM, consintiendo mi piel de mamá</title>
  <?php echo $this->Html->meta('icon');
    echo $this->Html->css('cake.generic');
    echo $this->fetch('meta');
    echo $this->fetch('script');
    echo $this->fetch('css');
  ?>
<?php /*<script type="text/javascript" src="//use.typekit.net/zhu8iai.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script> */ ?>

  <script type="text/javascript">
    (function() {
      var config = {
        kitId: 'zhu8iai',
        scriptTimeout: 3000
      };
      var h=document.getElementsByTagName("html")[0];h.className+=" wf-loading";var t=setTimeout(function(){h.className=h.className.replace(/(\s|^)wf-loading(\s|$)/g," ");h.className+=" wf-inactive"},config.scriptTimeout);var tk=document.createElement("script"),d=false;tk.src='//use.typekit.net/'+config.kitId+'.js';tk.type="text/javascript";tk.async="true";tk.onload=tk.onreadystatechange=function(){var a=this.readyState;if(d||a&&a!="complete"&&a!="loaded")return;d=true;clearTimeout(t);try{Typekit.load(config)}catch(b){}};var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(tk,s)
    })();
  </script>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <!--link href='//fonts.googleapis.com/css?family=Crafty+Girls' rel='stylesheet' type='text/css'>
  <link href='//fonts.googleapis.com/css?family=Loved+by+the+King' rel='stylesheet' type='text/css'>
  <link href='//fonts.googleapis.com/css?family=Sacramento' rel='stylesheet' type='text/css'> 
  <link href='//fonts.googleapis.com/css?family=Waiting+for+the+Sunrise' rel='stylesheet' type='text/css'-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <?php echo $this->Html->css('letras'); ?>
  <?php echo $this->Html->script('clickoutside'); ?>
  <?php //echo $this->Html->script('lightbox'); ?>
  <?php echo $this->Html->script('script'); ?>
	<?php echo $this->Html->script('modernizr'); ?>
  <script type="text/javascript">
    WebFontConfig = {
      google: { families: [ 'Open+Sans:400,700,600,300:latin' ] }
    };
    (function() {
      var wf = document.createElement('script');
      wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
        '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
      wf.type = 'text/javascript';
      wf.async = 'true';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(wf, s);
    })(); 
  </script>
  <?php $tema = $this->Session->read("User.theme");
    echo $this->Html->css('tema1');
    if( strpos($_SERVER['REQUEST_URI'], 'view_book') == TRUE ){
       echo $this->Html->css('book1');
    }
    if($tema == 2){
      echo $this->Html->css('tema2');
      if( strpos($_SERVER['REQUEST_URI'], 'view_book') == TRUE ){
         echo $this->Html->css('book2');
      }
    }
    elseif($tema == 3){
      echo $this->Html->css('tema3');
      if( strpos($_SERVER['REQUEST_URI'], 'view_book') == TRUE ){
         echo $this->Html->css('book3');
      }
    }
    elseif($tema == 4){
      echo $this->Html->css('tema4');
      if( strpos($_SERVER['REQUEST_URI'], 'view_book') == TRUE ){
         echo $this->Html->css('book4');
      }
    }
  ?>
  <?php $profileid = $this->Session->read("User.id");
    $facebookid = $this->Session->read("User.uid");
    //if( strpos($_SERVER['REQUEST_URI'], 'print_book') == FALSE ){      
      $font = $this->Session->read("User.font");
      if($font == 1){ echo $this->Html->css('letra1'); }
      elseif($font == 2){ echo $this->Html->css('letra2'); }
      elseif($font == 3){ echo $this->Html->css('letra3'); }
      elseif($font == 4){ echo $this->Html->css('letra4'); }
      elseif ($font == NULL || empty($font)) {  echo $this->Html->css('letra1'); }
    //}
  ?>
  <style type="text/css">
    <?php if($tema == 2){ ?>
      #popup_instructions {
        background-image: url(../img/tema2/pop_instrucciones.png);
      }
    <?php } elseif($tema == 3){ ?>
      #popup_instructions {
        background-image: url(../img/tema3/pop_instrucciones.png);
      }
    <?php } elseif($tema == 4){ ?>
      #popup_instructions {
        background-image: url(../img/tema4/pop_instrucciones.png);
      }
    <?php } ?>
  </style>
</head>
<body>
  <?php if( strpos($_SERVER['REQUEST_URI'], 'book') == FALSE ){  ?>
    <div id="fb-root"></div>
    <!-- solution for resizing ! *0* -->
    <script type="text/javascript">
      var UID;
      var uname;
      window.fbAsyncInit = function() {
        FB.init({
          appId: '163480813810636',
          status: true,
          cookie: true,
          xfbml: true,
          frictionlessRequests: true,
          display: 'popup'
        });
        <?php $new_token = str_replace('|','&#124;',$this->Session->read("User.token")); ?>
        FB.api(unescape('/me?access_token='+"<?php echo $new_token;?>"), function (response) {
          console.log('Response :'+JSON.stringify(response));
          var neu_data = JSON.parse(JSON.stringify(response));
          UID = neu_data.id;
          uname = neu_data.username;
        });
        //this resizes the the i-frame 
        //on an interval of 100ms 
        //FB.Canvas.setAutoGrow();
        <?php if( strpos( $_SERVER['REQUEST_URI'],  'welcome' ) == TRUE && strpos( $_SERVER['REQUEST_URI'],  'welcomebby' ) == FALSE ){  ?>
          FB.Canvas.setSize({height:1000});
        <?php } elseif(strpos($_SERVER['REQUEST_URI'], 'fangate') == TRUE){ ?>
          console.log('canvas');
          FB.Canvas.setSize({height:840});
        <?php } elseif(strpos($_SERVER['REQUEST_URI'],  'familytree' ) == TRUE){ ?>
          FB.Canvas.setSize({height:1170});
        <?php } else { ?>
          FB.Canvas.setSize({height:1150});
          //setTimeout("FB.Canvas.setAutoGrow()",500);
        <?php } ?>
      };
      (function() {
        var e = document.createElement('script');
        e.async = true;
        e.src = document.location.protocol + 
         '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);   
      }());
      // Load the SDK asynchronously
      // (function(d, s, id){
      //    var js, fjs = d.getElementsByTagName(s)[0];
      //    if (d.getElementById(id)) {return;}
      //    js = d.createElement(s); js.id = id;
      //    js.src = "//connect.facebook.net/en_US/all.js";
      //    fjs.parentNode.insertBefore(js, fjs);
      //  }(document, 'script', 'facebook-jssdk'));
      /*FACEBOOK SHIT*/
    </script> 
  <?php } ?>
  <?php if( strpos($_SERVER['REQUEST_URI'], 'profiles') == FALSE && strpos($_SERVER['REQUEST_URI'], 'fangate') == FALSE && strpos($_SERVER['REQUEST_URI'], 'cover') == FALSE  ){ ?>
    <div class="header">  
      <ul class="menu">
        <a href="#" class="ask" id="instructions">FAQ</a>
        <a href="#" class="settings" id="themsettings">Settings</a>
        <li class="home">Home</li>          
      </ul>
    </div>
    <div id="toPopup">
      <div class="close"></div>
      <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
      <div id="popup_instructions">Instrucciones del popup</div>
    </div> <!--toPopup end-->
    <div id="settings_popup">

        <div class="close_sets"></div>
        <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
        <div id="popup_settings"> <!--your content start-->
          <ul class="ul_settings">
            <li class="personalizar"> Personalizar </li>
            <!--li class="vermemorias"> Ver Memorias </li> -->
            <li><a href="//momtomom.mx/apps/memorias_embarazo/profiles/view_book/<?php echo $facebookid;?>" target="_blank" class="vermemorias">Ver Memorias</a></li>

            <li><a href="#dialog-box" class="compartir"  id="share-this"> Compartir </a></li>
            <li><a href="//momtomom.mx/apps/memorias_embarazo/profiles/print_book/<?php echo $profileid;?>" class="imprimir"  id="share-this"> Imprimir </a></li>

          </ul>
        </div> <!--your content end-->

    </div> <!--toPopup end-->
    <div id="personalizar_popup">
      <div>
        <p>Para comenzar, seleccionar el estilo que prefieras para guardar tus Memorias de Embarazo:</p>
        <p>Selecciona la letra que prefieras para tu diario:</p>
      </div>
      <div>
        <ul class="losfonts">
          <li class="font1"> Mam&aacute; </li>
          <li class="font2"> Mam&aacute; </li>
          <li class="font3"> Mam&aacute; </li>
          <li class="font4"> Mam&aacute; </li>
        </ul>  
        <ul class="lostemas">
          <li class="tema1"> Tema 1 </li>
          <li class="tema2"> Tema 2  </li>
          <li class="tema3"> Tema 3 </li>
          <li class="tema4"> Tema 4 </li>
        </ul>
      </div>
    </div>
    <div class="loader"></div>
    <div id="backgroundPopup"></div>
    <div id="dialog-box" class="dialog-popup"></div>
  <?php } ?>
  <?php echo $this->Session->flash(); ?>
  <?php echo $this->fetch('content'); ?>
  <?php if( strpos($_SERVER['REQUEST_URI'], 'profiles') == FALSE && strpos($_SERVER['REQUEST_URI'], 'fangate') == FALSE && strpos($_SERVER['REQUEST_URI'], 'cover') == FALSE  ){ ?>
    <div class="footer">
      <div class="footer_mtm">Mom to mom , Consintiendo mi piel de mam&aacute;</div>
      <a href="http://www.momtomom.com.mx/" class="footer_link" target="_blank">www.momtomom.mx</a>
      <a href="https://twitter.com/momtomommx" class="footer_twitter" target="_blank">@momtomommx</a>
    </div>
  <?php } ?>
</body>
</html>
