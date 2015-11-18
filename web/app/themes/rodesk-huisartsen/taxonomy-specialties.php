<?php get_template_part('templates/page', 'header'); ?>

<?php
	$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	echo $term->name;

	$thumbnail = get_field('specialties-thumbnail', $term); 
	$shortDescription = get_field('specialties-short-description', $term); 
					
	$thumbUrl = $thumbnail['url']; ?>
	<img src="<?php echo $thumbUrl; ?>">

	<p><?php echo $shortDescription; ?></p>

	<?php $slug = $term->slug; ?>

	<?php 
	$args = array (
		'numberposts'	=> -1,
		'post_type'		=> 'doctors',
		'tax_query'		=> array(
			'relation'		=> 'AND',
			array(
				'taxonomy' 		=> 'specialties',
				'field'			=> 'slug',
				'terms'			=> $slug
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
				$doctorLocations	= get_field("locations");
			?>

			<li class="active-doctor">
				<a href="<?php echo get_post_permalink(); ?>">
					<?php echo $doctorFirstName . ' ' . $doctorLastName;  ?>					
				</a>
			</li>
			
			<!-- loop through locations -->
			<?php foreach ($doctorLocations as $doctorLocation): ?>
				<a href="<?php echo $doctorLocation->guid; ?><br>">
					<?php echo $doctorLocation->post_title; ?><br>
				</a>
			<?php endforeach ?>
			
		<?php endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_query(); ?>

<?php the_posts_navigation(); ?>
