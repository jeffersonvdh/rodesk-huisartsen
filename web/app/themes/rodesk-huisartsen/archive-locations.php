<?php get_template_part('templates/page', 'header'); ?>

<div id="locations-overview">
	<div class="container-fluid">
		<div class="row">
			
			<?php if (!have_posts()) : ?>
			  <div class="alert alert-warning">
			    <?php _e('Sorry, no results were found.', 'sage'); ?>
			  </div>
			  <?php get_search_form(); ?>
			<?php endif; ?>

			<?php while (have_posts()) : the_post(); ?>
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

				<div class="col-md-4 location">
					<a href="<?php echo get_post_permalink(); ?>">
						<div class="location-img">
							<img src="<?php echo $locationImg; ?>">
						</div>
					</a>
					<ul class="location-info">
						<span class="title-header">Info</span>
						<li class="name">			<?php echo $name; ?> </li>
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

			<?php endwhile; ?>

		</div>
	</div>
</div>

<?php the_posts_navigation(); ?>
