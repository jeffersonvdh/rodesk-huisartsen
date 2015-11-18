<div id="single-doctor">
	<div class="container-fluid">
		<div class="row">

			<div class="col-md-8 doctor">
				
				<?php 
				// Define variables
					$firstName	 		= get_field("first-name"); 
					$lastName			= get_field("last-name");
					$phonenumber		= get_field("phone-number");
					$mobilephone		= get_field("mobile-number");
					$email				= get_field("email-address");
					$shortDescription 	= get_field("short-description");
					$passportImg		= get_field("passport-photo");
					$locations			= get_field("locations"); 
					$attendance			= get_field_object("attendance"); 
				?>

					<a href="<?php echo get_post_permalink(); ?>">
						<div class="passport-img">
							<img src="<?php echo $passportImg; ?>">
						</div>
					</a>
					<ul class="personal-info">
						<span class="title-header">Info</span>
						<li class="name">			<?php echo $firstName; ?> <?php echo $lastName; ?></li>
						<li class="phonenumber">	<?php echo $phonenumber; ?></li>
						<li class="mobilephone">	<?php echo $mobilephone; ?></li>
						<li class="email">			<?php echo $email; ?></li>

						<span class="title-header">Over deze doctor</span>
						<li class="short-description"><?php echo $shortDescription ?></li>
						
						<span class="title-header">Specialismen</span>
						<?php echo get_the_term_list( $post->ID, 'specialties', '', ', ' ); ?>
						
						<span class="title-header">Locaties</span>
						<?php foreach( $locations as $post ) { ?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php } ?>
					</ul>

			</div>	

			<div class="col-md-4">
				<div class="attendance">
					<?php
					$value 		= $attendance['value']; 
					$choices 	= $attendance['choices']; 
					?>
					<div class="title-header">Aanwezig op:</div>
					<ul class="aanwezig">
					<?php if($value) {
						foreach ($value as $v) { ?>
						<li> <?php echo $choices [ $v ]; ?> </li>
					<?php }
					}
					?>
					</ul>
				</div>
			</div>

		</div>
	</div>
</div>
