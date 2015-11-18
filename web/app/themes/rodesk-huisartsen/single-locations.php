<div id="single-location">
	<div class="container-fluid">
		<div class="row">

			<div class="col-md-8 location">
				
				<?php 
				// Define variables
					$locationID 		= $post->ID; 
					$name 		 		= get_field("name-location"); 
					$streetAndNumber	= get_field("street-and-number");
					$postalcode			= get_field("postalcode");
					$place				= get_field("place");
					$phonenumber		= get_field("location-place-number");
					$email				= get_field("location-email-address"); 
					$businessHours		= get_field("business-hours");
					$locationImg		= get_field("location-image");  
				?>

					<a href="<?php echo get_post_permalink(); ?>">
						<div class="location-img">
							<img src="<?php echo $locationImg; ?>">
						</div>
					</a>
					<ul class="location-info">
						<span class="title-header">Info</span>
						<li class="name">			<?php echo $name; ?> </li>
						<li class="street">			<?php echo $streetAndNumber; ?> </li>
						<li class="postalcode">		<?php echo $postalcode; ?> </li>
						<li class="place">			<?php echo $place; ?> </li>
						<li class="phonenumber">	<?php echo $phonenumber; ?></li>
						<li class="email">			<?php echo $email; ?></li>

						<span class="title-header">Actieve doktoren</span>

						<?php 
						$args = array (
							'numberposts'	=> -1,
							'post_type'		=> 'doctors',
							'meta_query'	=> array(
								'relation'		=> 'AND',
								array(
									'key' 		=> 'locations',
									'value'		=> '"' . get_the_ID() . '"',
									'compare'	=> 'LIKE'
								)
							)
						); 
						?>

						<?php $loop = new WP_Query( $args );
						if ( $loop->have_posts() ) :
						    while ( $loop->have_posts() ) : $loop->the_post(); ?>

								
								<?php 
									$doctorFirstName 	= get_field("first-name"); 
									$doctorLastName		= get_field("last-name");
								?>

								<li class="active-doctor">
									<a href="<?php echo get_post_permalink(); ?>">
										<?php echo $doctorFirstName . ' ' . $doctorLastName;  ?>
									</a>
								</li>

								<?php $terms = get_the_terms( get_the_ID(), 'specialties'); 
								
								foreach ($terms as $term) { ?>
								
								<?php $term_link = get_term_link( $term ); ?>
								
								<a href="<?php echo $term_link ?>">
									<span class="specialism">
										<?php echo $term->name; ?>
									</span>
								</a>
								<?php } ?>

							<?php endwhile; ?>
						<?php endif; ?>
						<?php wp_reset_query(); ?>

					</ul>

				</div>

				<div class="col-md-4 business-hours">
					<?php
					if( have_rows('business-hours') ): ?>

						<span class="title-header">Openingstijden</span>

					    <?php while ( have_rows('business-hours') ) : the_row(); ?>
							<div class="day"><?php the_sub_field('business-hours-day'); ?></div>					        
					        <div class="hours"><?php the_sub_field('business-hours-times'); ?> </div>

					    <?php endwhile;
					else :

					endif;
					?>
				</div> 

		</div>
	</div>
</div>
