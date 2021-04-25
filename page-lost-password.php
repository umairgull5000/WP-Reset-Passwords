<?php // Template Name: Lost Password ?>

<?php get_header(); #HEADER ?>

	<?php do_action("body_start"); // body start hook ?>

		<div id="content_area" class="content_area">

			<?php do_action("content_area_start"); // content area start hook ?>

				<div class="content_area--wrap">

					<?php do_action("content_wrap_start"); // content wrap start hook ?>

					<?php if(have_posts()) { while(have_posts()) { the_post(); ?>

            <div class="content_area--context">

              <?php do_action("context_start"); // context start hook ?>

	              <?php the_content(); // Content ?>

								<style type="text/css">
									.page-template .content_area--wrap { grid-template-columns: 1fr; }

									.lost-password-success { color: green; border: 1px solid green; padding: 10px 15px; margin: 30px auto; }
									.lost-password-error { color: red; border: 1px solid red; padding: 10px 15px; margin: 30px auto; }
									.lost-password-form { display: grid; grid-template-columns: 1fr; grid-gap: 30px; margin: 20px auto 100px; }
									.lost-password-title { margin: auto; }
									.lost-password-fields { display: grid; grid-template-columns: 1fr; grid-gap: 0px; }
									.lost-password-fields label { font-size: 24px; font-weight: bold; line-height: 1; color: #000; display: block; width: 100%; margin: 0 auto 15px; }
								</style>

								<?php // Isset Lost Password
								if( isset( $_POST["lost_password_submit"] ) ) {

									$email = $_POST["email"]; // Email Address |\ Username

									// Errors
									if( !username_exists($email) && !email_exists($email) ) { echo '<div class="lost-password-error">'.__("Email Not Exists", "wp").'</div>'; }
									// Errors

									// User Exists
									$user = "";
									if( username_exists( $email ) ) { $user = get_user_by( "login", $email ); }
									if( email_exists( $email ) ) { $user = get_user_by( "email", $email ); }
									if( $user ) {
										if(demographic_retrieve_password( $email )) {
											echo '<div class="lost-password-success">'.__("Reset password send to your email address", "wp").'</div>';
										}
									}
									// User Exists
								}
								// Isset Lost Password ?>

								<form role="form" method="post" class="lost-password-form" action="">
									<h1 class="lost-password-title"><?php echo __("Lost Password", "wp"); ?></h1>
									<div class="lost-password-fields">
								 		<label for="email"><?php echo __("E-Mail or Username", "wp"); ?></label>
								 		<input type="email" name="email" id="email" class="lost-password-email" placeholder="<?php echo __("E-Mail or Username", "wp"); ?>" value="" required />
								 	</div>
									<input type="submit" name="lost_password_submit" class="lost-password-submit" value="<?php echo __("Lost Password", "wp"); ?>" />
								 </form>

						    <?php do_action("context_end"); // context end hook ?>

							</div>

						<?php } wp_reset_query(); } #CONTENT ?>

					<?php do_action("content_wrap_end"); // content wrap end hook ?>

				</div>

			<?php do_action("content_area_end"); // content area end hook ?>

		</div>

	<?php do_action("body_end"); // body end hook ?>

<?php get_footer(); #FOOTER ?>
