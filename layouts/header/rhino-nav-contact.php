
			<!-- BEGIN RHINO HEADER -->

			<div class="rhino-header">

				<div class="rhino-header-right">

					<ul class="rhino-contact-info">
					<?php if( get_field('rhino_contact_phone', 'options') ): ?>
						<li class="contact-phone">
							<a href="tel:<?php the_field( 'rhino_contact_phone', 'options'); ?>" target="_blank">
								<i class="fa fa-phone"></i> <?php the_field( 'rhino_contact_phone', 'options'); ?>
							</a>
						</li>
					<?php endif ?>

					<?php if( get_field('rhino_contact_address', 'options') ): ?>
						<li class="contact-address">
							<?php if( get_field('rhino_contact_address_link', 'options') ): ?>
								<a href="<?php the_field( 'rhino_contact_address_link', 'options'); ?>" target="_blank">
							<?php endif ?>
								<i class="fa fa-map-marker"></i> <?php the_field( 'rhino_contact_address', 'options' ); ?>
							<?php if( get_field('rhino_contact_address_link', 'options') ): ?>
								</a>
							<?php endif ?>
						</li>
					<?php endif ?>

					<?php if( get_field('rhino_contact_email', 'options') ): ?>
						<li class="contact-email">
							<a href="mailto:<?php the_field( 'rhino_contact_email', 'options'); ?>" target="_blank">
								<i class="fa fa-envelope"></i> <?php the_field( 'rhino_contact_email', 'options'); ?>
							</a>
						</li>
					<?php endif ?>
				</ul>

					<div class="rhino-social">
						<ul class="rhino-social-icons">
							<?php if( get_field('rhino_contact_facebook', 'options') ): ?>
								<li class="rhino-social-icon">
									<a href="<?php the_field( 'rhino_contact_facebook', 'options'); ?>" target="_blank">
										<i class="fa fa-facebook-official"></i>
									</a>
								</li>
							<?php endif ?>
							<?php if( get_field('rhino_contact_twitter', 'options') ): ?>
								<li class="rhino-social-icon">
									<a href="<?php the_field( 'rhino_contact_twitter', 'options'); ?>" target="_blank">
										<i class="fa fa-twitter"></i>
									</a>
								</li>
							<?php endif ?>
							<?php if( get_field('rhino_contact_googleplus', 'options') ): ?>
								<li class="rhino-social-icon">
									<a href="<?php the_field( 'rhino_contact_googleplus', 'options'); ?>" target="_blank">
										<i class="fa fa-google-plus"></i>
									</a>
								</li>
							<?php endif ?>
							<?php if( get_field('rhino_contact_instagram', 'options') ): ?>
								<li class="rhino-social-icon">
									<a href="<?php the_field( 'rhino_contact_instagram', 'options'); ?>" target="_blank">
										<i class="fa fa-instagram"></i>
									</a>
								</li>
							<?php endif ?>
							<?php if( get_field('rhino_contact_flickr', 'options') ): ?>
								<li class="rhino-social-icon">
									<a href="<?php the_field( 'rhino_contact_flickr', 'options'); ?>" target="_blank">
										<i class="fa fa-flickr"></i>
									</a>
								</li>
							<?php endif ?>
							<?php if( get_field('rhino_contact_pinterest', 'options') ): ?>
								<li class="rhino-social-icon">
									<a href="<?php the_field( 'rhino_contact_pinterest', 'options'); ?>" target="_blank">
										<i class="fa fa-pinterest"></i>
									</a>
								</li>
							<?php endif ?>
							<?php if( get_field('rhino_contact_tumblr', 'options') ): ?>
								<li class="rhino-social-icon">
									<a href="<?php the_field( 'rhino_contact_tumblr', 'options'); ?>" target="_blank">
										<i class="fa fa-tumblr"></i>
									</a>
								</li>
							<?php endif ?>
							<?php if( get_field('rhino_contact_youtube', 'options') ): ?>
								<li class="rhino-social-icon">
									<a href="<?php the_field( 'rhino_contact_youtube', 'options'); ?>" target="_blank">
										<i class="fa fa-youtube-play"></i>
									</a>
								</li>
							<?php endif ?>
							<?php if( get_field('rhino_contact_spotify', 'options') ): ?>
								<li class="rhino-social-icon">
									<a href="<?php the_field( 'rhino_contact_spotify', 'options'); ?>" target="_blank">
										<i class="fa fa-spotify"></i>
									</a>
								</li>
							<?php endif ?>
						</ul>
					</div>

				</div><!-- /.rhino-header-right -->

			</div><!-- /.rhino-header -->

			<!-- END RHINO HEADER -->


