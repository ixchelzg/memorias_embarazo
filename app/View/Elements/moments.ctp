<?php $momentos = $this->requestAction('moment_pages/index'); ?>

<?php if(isset($momentos) && !empty($momentos)) {  ?>
<h3>Primer Trimestre</h3>
<ul>
	<?php
		foreach ($momentos as $moment):
			if($moment['MomentPage']['trimester'] == 1){ ?>
			<li>
			<?php	echo $this->Html->link(
			    $moment['MomentPage']['title'],
			    array('controller' => 'moment_pages', 'action' => 'add', 
			    	$moment['MomentPage']['id'], $moment['MomentPage']['trimester'])
				);
			?>
			</li>
			<?php
			}
		endforeach; 
		?>
</ul>
<h3>Segundo Trimestre</h3>
<ul>
	<?php
		foreach ($momentos as $moment):
			if($moment['MomentPage']['trimester'] == 2){ ?>
			<li>
			<?php	echo $this->Html->link(
			    $moment['MomentPage']['title'],
			    array('controller' => 'moment_pages', 'action' => 'add', 
			    	$moment['MomentPage']['id'], $moment['MomentPage']['trimester'])
				);
			?>
			</li>
			<?php
			}
		endforeach; 
		?>
</ul>
<h3>Tercer Trimestre</h3>
<ul>
	<?php
		foreach ($momentos as $moment):
			if($moment['MomentPage']['trimester'] == 3){ ?>
			<li>
			<?php	echo $this->Html->link(
			    $moment['MomentPage']['title'],
			    array('controller' => 'moment_pages', 'action' => 'add', 
			    	$moment['MomentPage']['id'], $moment['MomentPage']['trimester'])
				);
			?>
			</li>
			<?php
			}
		endforeach; 
		?>
</ul>
<?php }?>