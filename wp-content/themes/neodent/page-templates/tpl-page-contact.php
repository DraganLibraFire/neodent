<?php
/*
Template Name: Contact template
*/
?>
<?php
/*
 * Verteez Premium Themes
 * -----------------------------------------------------------
 * @package Theme Name -  Verteez  - Premium Multipurpose Wordpress Theme
 * @subpackage ThemezKitchen WP Theme Framework
 * @copyright Copyright (c), ThemezKitchen,  (http://www.themezkitchen.com/)
 * @link http://www.themezkitchen.com/
 * @version 1.0.0
 * @since Version 1.0.0
 */

/**
 * @name Sidebar widget template file
 * Used for displaying the list of primary sidebar
 * @group templates
 * @category main
 */
get_header('header1');
?>
<div id="content" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="container">
		<?php $contact = new WP_Query(array(
			'post_type' => 'contact_page'
			));
		?>
		<?php if ( $contact->have_posts() ) : ?>
		<?php while ( $contact->have_posts() ) : $contact->the_post(); ?>

		<!-- <article id="post-<?php //the_ID(); ?>" <?php //post_class('col-md-9'); ?>> -->
			<?php if( get_field('kontakt_detalji') ): ?>
			<?php while(has_sub_field('kontakt_detalji')): ?>
    		<div class="row">
    			<div class="contact-details-wrapp">
					<div class="col-md-12">
						<h2 class="title-border-bottom"><?php the_sub_field('naslov_kontakt'); ?></h2>
					</div>
	    			<?php if ((get_sub_field('ikonica_lokacija')!='') || (get_sub_field('ikonica_telefon') != '') || (get_sub_field('ikonica_fax') != '')){?>
	    			<nav class="col-md-6">
	    				<ul class="contact-list-info contact-list-info-first">
			                <?php if ((get_sub_field('ikonica_lokacija')!='') && (get_sub_field('dodajte_lokaciju') != '')){?>
							<li><img src="<?php the_sub_field('ikonica_lokacija'); ?>" alt=""/> <?php the_sub_field('dodajte_lokaciju'); ?></li>
							<?php } ?>
							<?php if ((get_sub_field('ikonica_telefon')!='') && (get_sub_field('brojevi_telefona') != '')){?>
							<li><img src="<?php the_sub_field('ikonica_telefon'); ?>" alt=""/> <?php the_sub_field('brojevi_telefona'); ?></li>
							<?php } ?>
							<?php if ((get_sub_field('ikonica_fax')!='') && (get_sub_field('brojevi_fax') != '')){?>
							<li><img src="<?php the_sub_field('ikonica_fax'); ?>" alt=""/> <?php the_sub_field('brojevi_fax'); ?></li>
							<?php } ?>
	    				</ul>
	    			</nav> <!-- /col-md-6 -->
	    			<?php } ?>
    				<?php if ((get_sub_field('ikonica_osoblje')!='') && (get_sub_field('dodajte_osoblje') != '')){?>
						<div class="contact-info-description col-md-6">
							<img src="<?php the_sub_field('ikonica_osoblje'); ?>" alt=""/>
							<?php the_sub_field('dodajte_osoblje'); ?>
						</div>
					<?php } ?>
    			</div> <!-- /.contact-details-wrapp -->
    		</div>
			<?php endwhile; ?>
			<?php endif; ?>

			<?php if( get_field('direktna_isporuka') ): ?>
			<?php while(has_sub_field('direktna_isporuka')): ?>
    		<div class="row">
    			<div class="contact-details-wrapp contact-information-wrapp">
					<div class="col-md-12">
						<h2 class="title-border-bottom"><?php the_sub_field('naslov_direktne_isporuke'); ?></h2>
					</div>
	    			<!-- <div class="row"> -->
		    				<?php if ((get_sub_field('ikonicu_za_lokaciju_isporuka')!='') && (get_sub_field('lokacija_direktne_isporuke') != '')){?>
		    				<nav class="col-md-6">
			    				<ul>
					                <?php if ((get_sub_field('ikonicu_za_lokaciju_isporuka')!='') && (get_sub_field('lokacija_direktne_isporuke') != '')){?>
									<li><img src="<?php the_sub_field('ikonicu_za_lokaciju_isporuka'); ?>" alt=""/> <?php the_sub_field('lokacija_direktne_isporuke'); ?></li>
									<?php } ?>
									<?php if ((get_sub_field('ikonica_telefon_isporuka')!='') && (get_sub_field('broj_telefona_isporuka') != '')){?>
									<li><img src="<?php the_sub_field('ikonica_telefon_isporuka'); ?>" alt=""/> <?php the_sub_field('broj_telefona_isporuka'); ?></li>
									<?php } ?>
								</ul>
							</nav>
							<?php } ?>
							<?php if ((get_sub_field('ikonica_pojedinca')!='') && (get_sub_field('naziv_pojedinca') != '')){?>
							<nav class="col-md-6">
								<ul>
									<?php if ((get_sub_field('ikonica_pojedinca')!='') && (get_sub_field('naziv_pojedinca') != '')){?>
									<li><img src="<?php the_sub_field('ikonica_pojedinca'); ?>" alt=""/><?php the_sub_field('naziv_pojedinca'); ?></li>
									<?php } ?>
									<?php if ((get_sub_field('ikonica_telefon_second')!='') && (get_sub_field('telefon_br_isporuka_second') != '')){?>
									<li><img src="<?php the_sub_field('ikonica_telefon_second'); ?>" alt=""/><?php the_sub_field('telefon_br_isporuka_second'); ?></li>
									<?php } ?>
								</ul>
							</nav>
							<?php } ?>
							<?php if ((get_sub_field('ikonicu_pojedinca_second')!='') && (get_sub_field('naziv_pojedinca_second') != '')){?>
							<nav class="col-md-6">
								<ul>
									<?php if ((get_sub_field('ikonicu_pojedinca_second')!='') && (get_sub_field('naziv_pojedinca_second') != '')){?>
									<li><img src="<?php the_sub_field('ikonicu_pojedinca_second'); ?>" alt=""/><?php the_sub_field('naziv_pojedinca_second'); ?></li>
									<?php } ?>
									<?php if ((get_sub_field('ikonica_telefon_theerd')!='') && (get_sub_field('telefon_br_isporuka_theerd') != '')){?>
									<li><img src="<?php the_sub_field('ikonica_telefon_theerd'); ?>" alt=""/><?php the_sub_field('telefon_br_isporuka_theerd'); ?></li>
									<?php } ?>
								</ul>
							</nav>
							<?php } ?>
							<?php if ((get_sub_field('naziv_pojedinca_fourth')!='') && (get_sub_field('naziv_pojedinca_fourth') != '')){?>
							<nav class="col-md-6">
								<ul>
									<?php if ((get_sub_field('ikonica_pojedinca_fourth')!='') && (get_sub_field('naziv_pojedinca_fourth') != '')){?>
									<li><img src="<?php the_sub_field('ikonica_pojedinca_fourth'); ?>" alt=""/><?php the_sub_field('naziv_pojedinca_fourth'); ?></li>
									<?php } ?>
									<?php if ((get_sub_field('ikonica_telefon_fourth')!='') && (get_sub_field('telefon_br_isporuka_fourth') != '')){?>
									<li><img src="<?php the_sub_field('ikonica_telefon_fourth'); ?>" alt=""/><?php the_sub_field('telefon_br_isporuka_fourth'); ?></li>
									<?php } ?>
			    				</ul>
			    			</nav>
		    				<?php } ?>
	    			<!-- </div> -->
    			</div> <!-- /.contact-details-wrapp contact-information-wrapp -->
    		</div>
			<?php endwhile; ?>
			<?php endif; ?>

    		<div class="row">
    			<div class="contact-detail-wrapp contact-email-wrapp">
					<div class="col-md-12">
						<h2 class="title-border-bottom"><?php the_field('unesite_naslov_sekcije'); ?></h2>
					</div>
	    			<!-- <div class="row"> -->
    				<?php if ((get_field('ikonica_za_mejl')!='') && (get_field('dodajte_ikonicu_za_mejl_second') != '')){?>
    				<div class="col-md-6">
	    				<h3><?php the_field('lokacija_za_mejl_first'); ?></h3>
	    				<nav>
		    				<ul>
				                <?php if ((get_field('ikonica_za_mejl')!='') && (get_field('prvi_mejl') != '')){?>
								<li><img src="<?php the_field('ikonica_za_mejl'); ?>" alt=""/> <a href="mailto:<?php the_field('prvi_mejl'); ?>"><?php the_field('prvi_mejl'); ?></a></li>
								<?php } ?>
							</ul>
						</nav>
					</div>
					<?php } ?>
					<?php if ((get_field('ikonica_za_mejl')!='') && (get_field('dodajte_ikonicu_za_mejl_second') != '')){?>
					<div class="col-md-6">
						<h3><?php the_field('lokacija_za_mejl_second'); ?></h3>
	    				<nav>
		    				<ul>
								<?php if ((get_field('dodajte_ikonicu_za_mejl_second')!='') && (get_field('drugi_mejl') != '')){?>
								<li><img src="<?php the_field('dodajte_ikonicu_za_mejl_second'); ?>" alt=""/> <a href="mailto:<?php the_field('drugi_mejl'); ?>"><?php the_field('drugi_mejl'); ?></a></li>
								<?php } ?>
							</ul>
						</nav>
					</div>
					<?php } ?>
				</div> <!-- /.contact-detail-wrapp contact-email-wrapp -->
			</div>
		<!-- </article> -->
		</div>

		<div class="contact-detail-wrapp contact-maps-wrapp">
			<?php if ((get_field('mapu_ovde')!='')){?>
			<div><?php the_field('mapu_ovde'); ?></div>
			<?php } ?>
		</div> <!-- /.contact-detail-wrapp contact-maps-wrapp -->

		<div class="container">
			<div class="contact-detail-wrapp contact-form-wrapp">
				<?php if ((get_field('kontakt_forma')!='')){?>
				<h3><?php the_field('naslov_map'); ?></h3>
				<div><?php the_field('kontakt_forma'); ?></div>
				<?php } ?>
			</div> <!-- /.contact-detail-wrapp contact-form-wrapp -->
		<!-- </article> -->
		<?php endwhile; ?>
		<?php endif; ?>
		<?php //get_sidebar();?>
		</div>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php
get_footer();
?>