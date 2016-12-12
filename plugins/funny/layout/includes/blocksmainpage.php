/**
 * The funny theme is built upon the Essential theme.
 *
 * @package    theme
 * @subpackage funny
 * @author     estarguars113
 * @author     Based on code originally written Julian (@moodleman) Ridden,by G J Bernard, Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */ 
 <?php
                		if($hasblocksdescription ){ ?>
                			<legend> <?php  echo $blocksdescription ; ?></legend>
<?php } ?>  
 <div id="blocks_main_page" class="row-fluid blocks_inline">
                		<?php if($hasblock1){ ?>
	                			<div class="block">
	                				<div class="inner">
	                					<div class="header">
		                					<?php if($hasblockimage1){ ?>
		                						<img src="<?php echo $blockimage1; ?>" alt="<?php echo $blocktitle1; ?>">
		                					<?php }?>
		                					<h2><?php echo $blocktitle1; ?></h2>	                					
		                				</div>
		                				<?php if($hasblocktext1){ ?>
			                				<div class="content">
			                					<p><?php echo $blocktext1; ?></p>
			                				</div>
			                			<?php }?>	
			                			<?php if($hasblockurl1){ ?>
			                			<div class="link">	
			                					<a href="<?php echo $blockurl1;?>"><?php echo ($hasblockbutton1 ? $blockbutton1 :  get_string('readmore','theme_essential')) ;?></a>
			                				</div>
			                			<?php }?>
		                			</div>
	                				</div>
	                				
                		<?php }?>
                		<?php if($hasblock2){ ?>
	                			<div class="block">
	                				<div class="inner">
		                				<div class="header">
		                					<?php if($hasblockimage2){ ?>
		                						<img src="<?php echo $blockimage2; ?>" alt="<?php echo $blocktitle2; ?>">
		                					<?php }?>
		                					<h2><?php echo $blocktitle2; ?></h2>	                					
		                				</div>
		                				<?php if($hasblocktext2){ ?>
			                				<div class="content">
			                					<p><?php echo $blocktext2; ?></p>
			                				</div>
			                			<?php }?>
			                			<?php if($hasblockurl2){ ?>
			                				<div class="link">
			                				<a href="<?php echo $blockurl2;?>"><?php echo ($hasblockbutton2 ? $blockbutton2 :  get_string('readmore','theme_essential')) ;?></a>
			                				</div>
			                			<?php }?>	
		                			</div>
		                		</div>
                		<?php }?>
                		<?php if($hasblock3){ ?>
	                			<div class="block">
	                				<div class="inner">
		                				<div class="header">
		                					<?php if($hasblockimage3){ ?>
		                						<img src="<?php echo $blockimage3; ?>" alt="<?php echo $blocktitle3; ?>">
		                					<?php }?>
		                					<h2><?php echo $blocktitle3; ?></h2>	                					
		                				</div>
		                				<?php if($hasblocktext3){ ?>
			                				<div class="content">
			                					<p><?php echo $blocktext3; ?></p>
			                				</div>
			                			<?php }?>	
			                			<?php if($hasblockurl3){ ?>
			                				<div class="link">
			                					<a href="<?php echo $blockurl3;?>"><?php echo ($hasblockbutton3 ? $blockbutton3 :  get_string('readmore','theme_essential')) ;?></a>
			                				</div>
			                			<?php }?>
		                			</div>
		                		</div>
                		<?php }?>
                		<?php if($hasblock4){ ?>
	                			<div class="block">
	                				<div class="inner">
		                				<div class="header">
		                					<?php if($hasblockimage4){ ?>
		                						<img src="<?php echo $blockimage4; ?>" alt="<?php echo $blocktitle4; ?>">
		                					<?php }?>
		                					<h2><?php echo $blocktitle4; ?></h2>	                					
		                				</div>
		                				<?php if($hasblocktext4){ ?>
			                				<div class="content">
			                					<p><?php echo $blocktext4; ?></p>
			                				</div>
			                			<?php }?>	
			                			<?php if($hasblockurl4){ ?>
			                				<div class="link">
			                					<a href="<?php echo $blockurl4;?>"><?php echo ($hasblockbutton4 ? $blockbutton4 :  get_string('readmore','theme_essential')) ;?></a>
			                				</div>
			                			<?php }?>
		                			</div>
		                		</div>
                		<?php }?>
                		<?php if($hasblock5){ ?>
	                			<div class="block">
	                				<div class="inner">
		                				<div class="header">
		                					<?php if($hasblockimage5){ ?>
		                						<img src="<?php echo $blockimage5; ?>" alt="<?php echo $blocktitle5; ?>">
		                					<?php }?>
		                					<h2><?php echo $blocktitle5; ?></h2>	                					
		                				</div>
		                				<?php if($hasblocktext5){ ?>
			                				<div class="content">
			                					<p><?php echo $blocktext5; ?></p>
			                				</div>
			                			<?php }?>	
			                			<?php if($hasblockurl5){ ?>
			                				<div class="link">
			                					<a href="<?php echo $blockurl5;?>"><?php echo ($hasblockbutton5 ? $blockbutton5 :  get_string('readmore','theme_essential')) ;?></a>
			                				</div>
			                			<?php }?>
		                			</div>
		                		</div>
                		<?php }?>
                </div>