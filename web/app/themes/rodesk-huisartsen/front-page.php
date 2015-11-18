<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
<?php endwhile; ?>

<div id="home-welcome">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1><?php the_field('options-welcome-title', 'option'); ?></h1>
				<p><?php the_field('options-welcome-text', 'option'); ?></p>			
			</div>
		</div>
	</div>
</div>


<div id="latest-locations">
	<div class="container-fluid">
		<div class="row">	

			<div class="header-title">
				Laatste locaties
			</div>
		
			<?php $loop = new WP_Query( array( 'post_type' => 'locations', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC' ) );
			if ( $loop->have_posts() ) :
			    while ( $loop->have_posts() ) : $loop->the_post(); ?>
					
					<div class="col-md-4 latest-location">
						<?php 
							$locationName 	= get_field("name-location"); 
							$locationImgUrl	= get_field("location-image");
						?> 
						<a href="<?php echo get_post_permalink(); ?>">
							<img src="<?php echo $locationImgUrl; ?>">
						</a>
						<a href="<?php echo get_post_permalink(); ?>">
							<span class="title"><?php echo $locationName; ?></span>
						</a>
					</div><!-- .latest-location -->

				<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>

		</div>
	</div>
</div>

<div id="latest-doctors">
	<div class="container-fluid">
		<div class="row">	

			<div class="header-title">
				Laatste doktoren
			</div>
		
			<?php $loop = new WP_Query( array( 'post_type' => 'doctors', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC' ) );
			if ( $loop->have_posts() ) :
			    while ( $loop->have_posts() ) : $loop->the_post(); ?>
					
					<div class="col-md-4 latest-doctor">
						<?php 
							$doctorFirstName 	= get_field("first-name"); 
							$doctorLastName		= get_field("last-name");
							$doctorPhoto		= get_field("passport-photo");
						?> 

						<a href="<?php echo get_post_permalink(); ?>">
							<img src="<?php echo $doctorPhoto; ?>">
						</a>
						<a href="<?php echo get_post_permalink(); ?>">
							<span class="first-name"><?php echo $doctorFirstName; ?></span>
							<span class="last-name"><?php echo $doctorLastName; ?></span> 
						</a>
					</div><!-- .latest-doctor -->

				<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>

		</div>
	</div>
</div>

<div id="latest-specialties">
	<div class="container-fluid">
		<div class="row">	

			<div class="header-title">
				Laatste specialismen
			</div>
		
				<?php 
				$specialismen = get_terms( 'specialties', 'orderby=date&order=DESC&number=3' );
				foreach ($specialismen as $specialiteit) { ?>

    				<?php $term_link = get_term_link( $specialiteit ); ?>

					<div class="col-md-4 latest-doctor">
						<a href="<?php echo esc_url($term_link); ?>">
							<?php echo $specialiteit->name; ?>
						</a>
					</div>

				<?php } ?>

		</div>
	</div>
</div>