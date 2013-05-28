<?php echo $this->Html->css('PhotoSelector'); ?>
<?php echo $this->Html->script('photo_selector'); ?>

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
			$('#'+idpapa).css('background-image','url(../img/marco.png), url('+photo.source+')');

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

	});


function readURL(input) {
      if (input.files && input.files[0]) {
      	  var elpapa = $(input).parent().get(0).id;
          var reader = new FileReader();
          reader.onload = function (e) {
                  $('#'+elpapa).css('background-image','url(../img/marco.png), url('+e.target.result+')');
          };
          reader.readAsDataURL(input.files[0]);
      }
  }

</script>

<style type="text/css">

<?php if( isset($nesting['NestingPage']['room_photo']) ){ ?>
#photo{
	background-image: url(../img/marco.png), url(../img/cover_photos/<?php echo str_replace(' ','%20',$nesting['NestingPage']['room_photo']); ?>);
	background-size: 297px 392px, 225px 320px;
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


<?php echo $this->element('menu', array( "trimestre" => 3, "pag" => "nesting")); ?>
<?php
		echo $this->Html->link(
				    'Add Moment',
				    array('controller' => 'moment_pages', 'action' => 'add'),
				    array('class' => 'add_moment')
				);
	?>

<div class="content">
<?php echo $this->element('trim_menu', array( "trimestre" => 3)); ?>

<div class="page_title">
	<?php
			echo $this->Html->link(
				    'Anterior',
				    array('controller' => 'coolultrasound_pages', 'action' => 'add'),
				    array('class' => 'ant')
				);
	?>
	<div class="title_page">
		<p>SÍNTOMAS</p>
		<span>de anidar</span>
	</div>
	<?php 
		echo $this->Html->link(
				    'Siguiente',
				    array('controller' => 'byebelly_pages', 'action' => 'add'),
				    array('class' => 'sig')
				);
	?>
</div>

	
	<div class="nestingPages form">
	<?php echo $this->Form->create('NestingPage', array('enctype' => 'multipart/form-data')); ?>
		<p>¡Muchas emociones! Me estoy preparando para tu llegada.<br>Oﬁcialmente estoy anidando.</p>

		<p>En este trimestre tu pap&aacute; est&aacute; un poco: </p>
 	<?php
		if(isset($nesting['NestingPage']['nest'])){
			$nest = $nesting['NestingPage']['nest'];
		} else{
			$nest = '';
		}
  	?>
  <input type="radio" name="data[NestingPage][nest]" value="1" <?php if($nest == 1){
	echo 'checked="checked"'; } ?> />
	<label>Limpiar toda la casa</label>
 	<input type="radio" name="data[NestingPage][nest]" value="2" <?php if($nest == 2){
  echo 'checked="checked"'; } ?> />
  <label>Lavar y acomodar tu ropita</label>
 	<input type="radio" name="data[NestingPage][nest]" value="3" <?php if($nest == 3){
  echo 'checked="checked"'; } ?> />
  <label>Tener nuestra maleta lista en la puerta</label>
   	<input type="radio" name="data[NestingPage][nest]" value="4" <?php if($nest == 4){
  echo 'checked="checked"'; } ?> />
  <label>Todas las anteriores</label>

	
  	
  	<p>Nos falta comprar: </p>
  	<?php
		if(isset($nesting['NestingPage']['buy1'])){
			$buy1 = $nesting['NestingPage']['buy1'];
		} else{
			$buy1 = '';
		}
		if(isset($nesting['NestingPage']['buy2'])){
			$buy2 = $nesting['NestingPage']['buy2'];
		} else{
			$buy2 = '';
		}
		if(isset($nesting['NestingPage']['buy3'])){
			$buy3 = $nesting['NestingPage']['buy3'];
		} else{
			$buy3 = '';
		}
	?>
  	<input type="text" name="data[NestingPage][buy1]" value="<?php if($buy1 != ''){ echo $buy1; } ?>" >
  	<input type="text" name="data[NestingPage][buy2]" value="<?php if($buy2 != ''){ echo $buy2; } ?>" >
  	<input type="text" name="data[NestingPage][buy3]" value="<?php if($buy3 != ''){ echo $buy3; } ?>" >

	
	<div id="room_photo">
		<input type="hidden" name="data[NestingPage][url_photo]" class="room_photo" value=""/>
		<div class="pick_fb">Elegir de Facebook</div>
		<?php
			echo $this->Form->file('room_photo', array('class' => 'upload_bt', 'onchange' => 'readURL(this);' ));
		?>
	</div>

	<p> As&iacute; ser&aacute; tu cuarto: </p>
	<?php
		echo $this->Form->input('profile_id', array('type' => 'hidden', 'value' => $profileid));
	?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

</div>