<?php 
#Power by nicolaspar 2007 - especific proyect
function get_date_spanish( $time, $part = false, $formatDate = '' ){
    #Declare n compatible arrays
    $month = array("","enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiempre", "diciembre");#n
    $month_execute = "n"; #format for array month

    $month_mini = array("","ENE", "FEB", "MAR", "ABR", "MAY", "JUN", "JUL", "AGO", "SEP", "DIC");#n
    $month_mini_execute = "n"; #format for array month

    $day = array("domingo","lunes","martes","miércoles","jueves","viernes","sábado"); #w
    $day_execute = "w";
    
    $day_mini = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB"); #w
    $day_mini_execute = "w";

    #Content array exception print "HOY", position content the name array. Duplicate value and key for optimization in comparative
    $print_hoy = array("month"=>"month", "month_mini"=>"month_mini");

    if( $part === false ){
        return date("d", $time) . " de " . $month[date("n",$time)] . ", ". date("H:i",$time) ." hs";
    }elseif( $part === true ){
        if( ! empty( $print_hoy[$formatDate] ) && date("d-m-Y", $time ) == date("d-m-Y") ) return "HOY"; #Exception HOY
        if( ! empty( ${$formatDate} ) && !empty( ${$formatDate}[date(${$formatDate.'_execute'},$time)] ) ) return ${$formatDate}[date(${$formatDate.'_execute'},$time)];
        else return date($formatDate, $time);
    }else{
        return date("d-m-Y H:i", $time);
    }
}

?>


<?php echo $this->Html->css('PhotoSelector'); ?>
<?php echo $this->Html->script('photo_selector'); ?>
<?php echo $this->Html->script('jquery-ui/js/jquery-ui-1.10.3.custom.min'); ?>
<?php echo $this->Html->script('functions'); ?>
<?php echo $this->Html->css('redmond/jquery-ui-1.10.3.custom.min'); ?>

<script type="text/javascript">

	var buttonOK = $('a#CSPhotoSelector_buttonOK');
	var o = this;
  
fbphotoSelect = function(id, idpapa) {
		// if no user/friend id is sent, default to current user
		if (!id) id = 'me';
		
		callbackAlbumSelected = function(albumId) {
			var album, name;
			album = CSPhotoSelector.getAlbumById(albumId);
			// show album photos
			selector.showPhotoSelector(null, album.id);
		};

		callbackAlbumUnselected = function(albumId) {
			var album, name;
			album = CSPhotoSelector.getAlbumById(albumId);
		};

		callbackPhotoSelected = function(photoId) {
			var photo;
			photo = CSPhotoSelector.getPhotoById(photoId);
			buttonOK.show();
			// console.log('is this working? ');
			// buttonOK.css('display', 'inline-block');
			// buttonOK.css('marginTop', -2);
			// console.log(buttonOK);
			$('a#CSPhotoSelector_buttonOK').css('display', 'block');
			//logActivity('Selected ID: ' + photo.id);
		};

		callbackPhotoUnselected = function(photoId) {
			var photo;
			album = CSPhotoSelector.getPhotoById(photoId);
			buttonOK.hide();
			$('a#CSPhotoSelector_buttonOK').css('display', 'none');

		};

		callbackSubmit = function(photoId) {
			var photo;
			photo = CSPhotoSelector.getPhotoById(photoId);

			//logActivity('<br><strong>Submitted</strong><br> Photo ID: ' + photo.id + '<br>Photo URL: ' + photo.source + '<br>');
			// guardar img como portada , agregar a hidden field , y que lo mande .. inmediately ? 
			console.log(photo.source);
			console.log(' ehmem == > '+idpapa);
			$('.'+idpapa).val(photo.source);
			$('#'+idpapa+"-back").css('background-image','url('+photo.source+')');

		};


		// Initialise the Photo Selector with options that will apply to all instances
		CSPhotoSelector.init({debug: true});

		// Create Photo Selector instances
		selector = CSPhotoSelector.newInstance({
			callbackAlbumSelected	: callbackAlbumSelected,
			callbackAlbumUnselected	: callbackAlbumUnselected,
			callbackPhotoSelected	: callbackPhotoSelected,
			callbackPhotoUnselected	: callbackPhotoUnselected,
			callbackSubmit			: callbackSubmit,
			maxSelection			: 1,
			albumsPerPage			: 6,
			photosPerPage			: 200,
			autoDeselection			: true
		});

		// reset and show album selector
		selector.reset();
		selector.showAlbumSelector(id);
	}

  $(document).ready(function(){
  	
  	$(".pick_fb").click(function (e) {
		    e.preventDefault();
		    elpapa = $(this).parent().get(0).id;
		    id = null;
		    if ( $(this).attr('data-id') ) id = $(this).attr('data-id');
		    fbphotoSelect(id, elpapa); 
		});


<?php if(isset($special['SpecialdeliveryPage']['birthday'])){ 

			$source = $special['SpecialdeliveryPage']['birthday'];
			$date = new DateTime($source);
			$letime = strtotime($source);

			$mes = get_date_spanish($letime, true, 'month'); # return Enero

			$dia = $date->format('d'); // 31.07.2012
			$ano = $date->format('Y'); // 31-07-2012

			$birthday = $dia.' '.$mes.' '.$ano;
			$monthi = ($date->format('m'))-1;
			$mese = $date->format('m');
		?>
	 $( "#datepickerCongrats" ).datepicker("setDate", new Date(<?php echo $ano.', '.$monthi.', '.$dia;?>));	
<?php } else{
			$birthday = '';
		}
?>

	});


function readURL(input) {
      if (input.files && input.files[0]) {
      	  var elpapa = $(input).parent().get(0).id;
          var reader = new FileReader();
          reader.onload = function (e) {
                  $('#'+elpapa+"-back").css('background-image','url('+e.target.result+')');
          };
          reader.readAsDataURL(input.files[0]);
      }
  }

</script>

<style type="text/css">

<?php if( isset($special['SpecialdeliveryPage']['photo']) ){ ?>
#photo-back{
	background-image: url(../img/cover_photos/<?php echo str_replace(' ','%20',$special['SpecialdeliveryPage']['photo']); 
		?>);
}
<?php }?>

</style>

<!-- Markup for Carson Shold's Photo Selector -->
		<div id="CSPhotoSelector">
			<div class="CSPhotoSelector_dialog">
				<a href="#" id="CSPhotoSelector_buttonClose">x</a>
				<div class="CSPhotoSelector_form">
					<div class="CSPhotoSelector_header">
						<p>Choose from Photos</p>
					</div>

					<div class="CSPhotoSelector_content CSAlbumSelector_wrapper">
						<p>Browse your albums until you find a picture you want to use</p>
						<div class="CSPhotoSelector_searchContainer CSPhotoSelector_clearfix">
							<div class="CSPhotoSelector_selectedCountContainer">Select an album</div>
						</div>
						<div class="CSPhotoSelector_photosContainer CSAlbum_container"></div>
					</div>

					<div class="CSPhotoSelector_content CSPhotoSelector_wrapper">
						<p>Select a new photo</p>
						<div class="CSPhotoSelector_searchContainer CSPhotoSelector_clearfix">
							<div class="CSPhotoSelector_selectedCountContainer"><span class="CSPhotoSelector_selectedPhotoCount">0</span> / <span class="CSPhotoSelector_selectedPhotoCountMax">0</span> photos selected</div>
							<a href="#" id="CSPhotoSelector_backToAlbums">Back to albums</a>
						</div>
						<div class="CSPhotoSelector_photosContainer CSPhoto_container"></div>
					</div>

					<div id="CSPhotoSelector_loader"></div>


					<div class="CSPhotoSelector_footer CSPhotoSelector_clearfix">
						<a href="#" id="CSPhotoSelector_pagePrev" class="CSPhotoSelector_disabled">Previous</a>
						<a href="#" id="CSPhotoSelector_pageNext">Next</a>
						<div class="CSPhotoSelector_pageNumberContainer">
							Page <span id="CSPhotoSelector_pageNumber">1</span> / <span id="CSPhotoSelector_pageNumberTotal">1</span>
						</div>
						<a href="#" id="CSPhotoSelector_buttonOK">OK</a>
						<a href="#" id="CSPhotoSelector_buttonCancel">Cancel</a>
					</div>
				</div>
			</div>
		</div>
<!-- Markup for Carson Shold's Photo Selector -->


<?php echo $this->element('menu', array( "trimestre" => 3, "pag" => "specialdelivery")); ?>

<a href="#" class="add_moment" id="my-moments">Moments</a>

    <div id="moments_popup">
        <div id="popup_moments"> <!--your content start-->
          <?php echo $this->element('moments', array( "profyid" => $profileid)); ?>
          <a href="3" class="addnew-momento" id="mayiadd-moments" >Agrega un momento</a>
        </div> <!--your content end-->
    </div> <!--toPopup end-->

<div id="dialog-box-momento" class="dialog-popup"></div>


<div class="content">
<?php echo $this->element('trim_menu', array( "trimestre" => 3)); ?>

<div class="page_title">
	<?php
			echo $this->Html->link(
				    'Anterior',
				    array('controller' => 'byebelly_pages', 'action' => 'add'),
				    array('class' => 'ant')
				);
	?>
	<div class="title_page">
		<p>entrega especial:</p>
		<span>t&uacute;</span>
	</div>
	<?php 
      echo $this->Html->link(
              'Siguiente',
              array('controller' => 'welcomebby_pages', 'action' => 'add'),
              array('class' => 'sig')
          );
    ?>
  </div>

  <div class="specialdeliveryPages form">
      <?php echo $this->Form->create('SpecialdeliveryPage', array('enctype' => 'multipart/form-data')); ?>
    <div class="todo">


      <div id="photo-back"></div>
      <div id="photo" class="photo-up">
        <input type="hidden" name="data[SpecialdeliveryPage][url_photo]" class="photo" value=""/>
        <div class="pick_fb">Elegir de Facebook</div>
        <?php
          echo $this->Form->file('photo', array('class' => 'upload_bt', 'onchange' => 'readURL(this);' ));
        ?>
      </div>

      <?php
        if(isset($special['SpecialdeliveryPage']['uare'])){
          $uare = $special['SpecialdeliveryPage']['uare'];
        } else{
          $uare = '';
        }
    ?>
      <p class="eres">
        <label> Eres: </label>
        <input type="text" maxlength="35" name="data[SpecialdeliveryPage][uare]" value="<?php if($uare != ''){ echo $uare; } ?>"/>
      </p>
      <?php
        if(isset($special['SpecialdeliveryPage']['hour'])){
          $hour = $special['SpecialdeliveryPage']['hour'];
        } else{
          $hour = '';
        }
      ?>
      <p class="bday">
        <label>Naciste el d&iacute;a: </label>
        <input type="text" id="datepickerCongrats" size="30" readonly="readonly"  value="<?php if($birthday != ''){
              echo $birthday; } ?>"/>
        <input type="hidden" name="data[SpecialdeliveryPage][birthday][month]" id="CongratsPagePruebaMonth" <?php if($birthday != ''){ ?>  value="<?php echo $mese; ?>" <?php } ?>  />
        <input type="hidden" name="data[SpecialdeliveryPage][birthday][day]" id="CongratsPagePruebaDay" <?php if($birthday != ''){ ?>  value="<?php echo $dia; ?>" <?php } ?>  />
        <input type="hidden" name="data[SpecialdeliveryPage][birthday][year]" id="CongratsPagePruebaYear" <?php if($birthday != ''){ ?>  value="<?php echo $ano; ?>" <?php } ?>  />
        a las:
        <input type="text" name="data[SpecialdeliveryPage][hour]" value="<?php if($hour != ''){ echo $hour; } ?>"/>
      </p>
      <?php
      if(isset($special['SpecialdeliveryPage']['location'])){
        $location = $special['SpecialdeliveryPage']['location'];
      } else{
        $location = '';
      }
      ?>
      <p class="bplace">
        <label> Naciste en: </label>
        <input type="text" name="data[SpecialdeliveryPage][location]" value="<?php if($location != ''){ echo $location; } ?>"/>
      </p>
      <div class="parto">
        <p>El parto fue: </p>
        <?php
        if(isset($special['SpecialdeliveryPage']['itwas'])){
          $itwas = $special['SpecialdeliveryPage']['itwas'];
        } else{
          $itwas = '';
        }
        ?>
        <div class="opciones">
          <div class="cf">
            <input type="radio" name="data[SpecialdeliveryPage][itwas]" value="1" <?php if($itwas == 1){ echo 'checked="checked"'; } ?> />
            <label> Natural </label>
          </div>
          <div class="cf">
            <input type="radio" name="data[SpecialdeliveryPage][itwas]" value="2" <?php if($itwas == 2){ echo 'checked="checked"'; } ?> />
            <label> Epidural</label>
          </div>
          <div class="cf">
            <input type="radio" name="data[SpecialdeliveryPage][itwas]" value="3" <?php if($itwas == 3){ echo 'checked="checked"'; } ?> />
            <label> Ces&aacute;rea</label>
          </div>
        </div>
      </div>

      <?php
        if(isset($special['SpecialdeliveryPage']['weightnmeasures'])){
          $weightnmeasures = $special['SpecialdeliveryPage']['weightnmeasures'];
        } else{
          $weightnmeasures = '';
        }
      ?>
      <p class="pesaste">
        <label> Pesaste y mediste: </label>
        <input type="text" name="data[SpecialdeliveryPage][weightnmeasures]" value="<?php if($weightnmeasures != ''){ echo $weightnmeasures; } ?>"/>
      </p>

      <?php
        if(isset($special['SpecialdeliveryPage']['urhairneyes'])){
          $urhairneyes = $special['SpecialdeliveryPage']['urhairneyes'];
        } else{
          $urhairneyes = '';
        }
      ?>
      <p class="ojos">
        <label> Tu cabello y tus ojos son: </label>
        <input type="text" name="data[SpecialdeliveryPage][urhairneyes]" value="<?php if($urhairneyes != ''){ echo $urhairneyes; } ?>"/>
      </p>

    </div>
     <p class="nota-foot"> ¡Apenas puedo creer que estabas en mi panza! </p>

    <?php	echo $this->Form->input('profile_id', array('type' => 'hidden', 'value' => $profileid)); ?>
    <?php echo $this->Form->end(__('Submit')); ?>
  </div>
</div>
