<?php get_header(); ?>
<?php get_template_part('includes/nav') ?>
<main id="main_container" class="padding1">
	<div class="container">
		<h1 class=" title1"><?php the_title(); ?></h1><br> 
		<div class="text-center"><?php if ( has_post_thumbnail()) { the_post_thumbnail('large', ['class' => 'img-fluid margin1']);} ?></div>
		<?php while(have_posts()) : the_post();?>
			<?php the_content(); ?>
		<?php	endwhile;	?>
	</div>
</main>
<?php get_template_part('includes/noticias') ?>
<?php get_footer(); ?>