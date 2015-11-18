<?php get_template_part('templates/page', 'header'); ?>

<div id="doctors-overview">
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
					$firstName	 	= get_field("first-name"); 
					$lastName		= get_field("last-name");
					$phonenumber	= get_field("phone-number");
					$email			= get_field("email-address");
					$passportImg	= get_field("passport-photo");
					$locations		= get_field("locations"); 
				?>

				<div class="col-md-3 doctor">
					<a href="<?php echo get_post_permalink(); ?>">
						<div class="passport-img">
							<img src="<?php echo $passportImg; ?>">
						</div>
					</a>
					<ul class="personal-info">
						<span class="title-header">Info</span>
						<li class="name">			<?php echo $firstName; ?> <?php echo $lastName; ?></li>
						<li class="phonenumber">	<?php echo $phonenumber; ?></li>
						<li class="email">			<?php echo $email; ?></li>

						<span class="title-header">Specialismen</span>
						<?php echo get_the_term_list( $post->ID, 'specialties', '', ', ' ); ?>

						<span class="title-header">Locaties</span>
						<?php foreach( $locations as $post ) { ?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php } ?>						
					</ul>
				</div>

			<?php endwhile; ?>

		</div>
	</div>
</div>

<?php the_posts_navigation(); ?>

