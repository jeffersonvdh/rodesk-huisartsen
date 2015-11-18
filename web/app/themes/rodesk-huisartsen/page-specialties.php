<?php
/**
 * Template Name: Specialties
 */
?>
<div id="specialties-overview">
	<div class="container-fluid">
		<div class="row">
			
			<?php 
			$specialismen = get_terms( 'specialties', 'orderby=date&order=DESC' );
			foreach ($specialismen as $specialiteit) { ?>

				<?php $term_link = get_term_link( $specialiteit ); ?>

				<div class="col-md-4 latest-doctor">
					<a href="<?php echo esc_url($term_link); ?>">
						<?php echo $specialiteit->name; ?>
					</a>
					
					<?php $thumbnail = get_field('specialties-thumbnail', $specialiteit); ?>
					<?php $shortDescription = get_field('specialties-short-description', $specialiteit); ?>
					
					<?php $thumbUrl = $thumbnail['url']; ?>
					<a href="<?php echo esc_url($term_link); ?>">
						<img src="<?php echo $thumbUrl; ?>">
					</a>

					<p><?php echo $shortDescription; ?></p>

				</div>

			<?php } ?>

		</div>
	</div>
</div>

