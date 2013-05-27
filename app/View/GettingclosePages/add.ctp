
<?php echo $this->element('menu', array( "trimestre" => 3, "pag" => "gettingclose")); ?>

<?php
		echo $this->Html->link(
				    'Add Moment',
				    array('controller' => 'bellymonth_pages', 'action' => 'add'),
				    array('class' => 'add_moment')
				);
	?>

<div class="content">
<?php echo $this->element('trim_menu', array( "trimestre" => 3)); ?>

<div class="page_title">
	<?php
			echo $this->Html->link(
				    'Anterior',
				    array('controller' => 'bellymonth_pages', 'action' => 'add'),
				    array('class' => 'ant')
				);
	?>
	<div class="title_page">
		<p>Se acerca</p>
		<span>el gran momento</span>
	</div>
	<?php 
		echo $this->Html->link(
				    'Siguiente',
				    array('controller' => 'babyshower_pages', 'action' => 'add'),
				    array('class' => 'sig')
				);
	?>
</div>

	<div class="gettingclosePages form">
<?php echo $this->Form->create('GettingclosePage'); ?>
  <p>Estoy tomando un curso de preparación para el parto, ¡ay que miedo!</p>

	<label>Querido bebé, perdónanos pero te hemos llamado: </label>  
  <?php
		if(isset($gettingclose['GettingclosePage']['named'])){
			$named = $gettingclose['GettingclosePage']['named'];
		} else{
			$named = '';
		}
  ?> 
  <input type="text" name="data[GettingclosePage][named]" value="<?php if($named != ''){ echo $named; } ?>">

  <p>Nombres reales qué estamos considerando:</p>
  <?php
		if(isset($gettingclose['GettingclosePage']['possiblename1'])){
			$possiblename1 = $gettingclose['GettingclosePage']['possiblename1'];
		} else{
			$possiblename1 = '';
		}
		if(isset($gettingclose['GettingclosePage']['possiblename2'])){
			$possiblename2 = $gettingclose['GettingclosePage']['possiblename2'];
		} else{
			$possiblename2 = '';
		}
		if(isset($gettingclose['GettingclosePage']['possiblename3'])){
			$possiblename3 = $gettingclose['GettingclosePage']['possiblename3'];
		} else{
			$possiblename3 = '';
		}
		if(isset($gettingclose['GettingclosePage']['possiblename4'])){
			$possiblename4 = $gettingclose['GettingclosePage']['possiblename4'];
		} else{
			$possiblename4 = '';
		}
		if(isset($gettingclose['GettingclosePage']['possiblename5'])){
			$possiblename5 = $gettingclose['GettingclosePage']['possiblename5'];
		} else{
			$possiblename5 = '';
		}
  ?>
  <input type="text" name="data[GettingclosePage][possiblename1]" value="<?php if($possiblename1 != ''){ echo $possiblename1; } ?>">
  <input type="text" name="data[GettingclosePage][possiblename2]" value="<?php if($possiblename2 != ''){ echo $possiblename2; } ?>">
  <input type="text" name="data[GettingclosePage][possiblename3]" value="<?php if($possiblename3 != ''){ echo $possiblename3; } ?>">
  <input type="text" name="data[GettingclosePage][possiblename4]" value="<?php if($possiblename4 != ''){ echo $possiblename4; } ?>">
  <input type="text" name="data[GettingclosePage][possiblename5]" value="<?php if($possiblename5 != ''){ echo $possiblename5; } ?>">

  <p>Mi favorito:</p>
   <?php
		if(isset($gettingclose['GettingclosePage']['favoritename'])){
			$favoritename = $gettingclose['GettingclosePage']['favoritename'];
		} else{
			$favoritename = '';
		}
  ?>
  <input type="radio" name="data[ChildsexPage][favoritename]" value="1" <?php if($favoritename == 1){
	echo  'checked="checked"'; } ?> />
 	<input type="radio" name="data[ChildsexPage][favoritename]" value="2" <?php if($favoritename == 2){
  echo   'checked="checked"'; } ?> />
 	<input type="radio" name="data[ChildsexPage][favoritename]" value="3" <?php if($favoritename == 3){
  echo   'checked="checked"'; } ?> />
  <input type="radio" name="data[ChildsexPage][favoritename]" value="4" <?php if($favoritename == 3){
  echo   'checked="checked"'; } ?> />
  <input type="radio" name="data[ChildsexPage][favoritename]" value="5" <?php if($favoritename == 3){
  echo   'checked="checked"'; } ?> />


   <p>Sugerencias de otras personas:</p>
  <?php
		if(isset($gettingclose['GettingclosePage']['suggestedname1'])){
			$suggestedname1 = $gettingclose['GettingclosePage']['suggestedname1'];
		} else{
			$suggestedname1 = '';
		}
		if(isset($gettingclose['GettingclosePage']['suggestedname2'])){
			$suggestedname2 = $gettingclose['GettingclosePage']['suggestedname2'];
		} else{
			$suggestedname2 = '';
		}
		if(isset($gettingclose['GettingclosePage']['suggestedname3'])){
			$suggestedname3 = $gettingclose['GettingclosePage']['suggestedname3'];
		} else{
			$suggestedname3 = '';
		}
		if(isset($gettingclose['GettingclosePage']['suggestedname4'])){
			$suggestedname4 = $gettingclose['GettingclosePage']['suggestedname4'];
		} else{
			$suggestedname4 = '';
		}
		if(isset($gettingclose['GettingclosePage']['suggestedname5'])){
			$suggestedname5 = $gettingclose['GettingclosePage']['suggestedname5'];
		} else{
			$suggestedname5 = '';
		}
  ?>
  <input type="text" name="data[GettingclosePage][suggestedname1]" value="<?php if($suggestedname1 != ''){ echo $suggestedname1; } ?>">
  <input type="text" name="data[GettingclosePage][suggestedname2]" value="<?php if($suggestedname2 != ''){ echo $suggestedname2; } ?>">
  <input type="text" name="data[GettingclosePage][suggestedname3]" value="<?php if($suggestedname3 != ''){ echo $suggestedname3; } ?>">
  <input type="text" name="data[GettingclosePage][suggestedname4]" value="<?php if($suggestedname4 != ''){ echo $suggestedname4; } ?>">
  <input type="text" name="data[GettingclosePage][suggestedname5]" value="<?php if($suggestedname5 != ''){ echo $suggestedname5; } ?>">

  <label> Mis suegros insisten que se llame: </label>
  	 <?php
		if(isset($gettingclose['GettingclosePage']['inlaw'])){
			$inlaw = $gettingclose['GettingclosePage']['inlaw'];
		} else{
			$inlaw = '';
		} 
	?>
  <input type="text" name="data[GettingclosePage][inlaw]" value="<?php if($inlaw != ''){ echo $inlaw; } ?>">

    <label> Mis papás opinan: </label>
  	 <?php
		if(isset($gettingclose['GettingclosePage']['parents'])){
			$parents = $gettingclose['GettingclosePage']['parents'];
		} else{
			$parents = '';
		} 
	?>
  <input type="text" name="data[GettingclosePage][parents]" value="<?php if($parents != ''){ echo $parents; } ?>">

		<?php
			echo $this->Form->input('profile_id', array('type' => 'hidden', 'value' => $profileid));
		?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

</div>