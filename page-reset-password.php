<?php // Template Name: Reset Password ?>

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

									.reset-password-success { color: green; border: 1px solid green; padding: 10px 15px; margin: 30px auto; }
									.reset-password-error { color: red; border: 1px solid red; padding: 10px 15px; margin: 30px auto; }
									.reset-password-form { display: grid; grid-template-columns: 1fr; grid-gap: 30px; margin: 20px auto 100px; }
									.reset-password-title { margin: auto; }
									.reset-password-fields { display: grid; grid-template-columns: 1fr; grid-gap: 0px; }
									.reset-password-fields label { font-size: 24px; font-weight: bold; line-height: 1; color: #000; display: block; width: 100%; margin: 0 auto 15px; }
								</style>

								<?php // Isset Reset Password
								if( isset( $_POST["reset_password_submit"] ) ) {

									$action = $_POST["action"]; // Action
									$key = $_POST["key"]; // Reset Key
									$email = $_POST["login"]; // Email Address |\ Username
									$password = $_POST["password"]; // Password
									$confirm_password = $_POST["confirm_password"]; // Confirm Password

									// Errors
									if( !username_exists($email) && !email_exists($email) ) { echo '<div class="reset-password-error">'.__("Email Not Exists", "wp").'</div>'; }
									if( $password != $confirm_password ) { echo '<div class="reset-password-error">'.__("Password Not Matched", "wp").'</div>'; }
									// Errors

									// User Exists
									$user = "";
									if( username_exists( $email ) ) { $user = get_user_by( "login", $email ); }
									if( email_exists( $email ) ) { $user = get_user_by( "email", $email ); }
									if( $user ) {
										$user_activation_key = $user->user_activation_key;
										if($user_activation_key == $key) {
											wp_set_password( $password, $user->ID );
											echo '<div class="reset-password-success">'.__("Password Reset Successfully", "wp").'</div>';
										} else {
											echo '<div class="reset-password-error">'.__("Reset key not matched", "wp").'</div>';
										}
									}
									// User Exists
								}
								// Isset Reset Password ?>

								<form role="form" method="post" class="reset-password-form" action="">
									<h1 class="reset-password-title"><?php echo __("Reset Password", "wp"); ?></h1>
									<div class="reset-password-fields">
								 		<label for="password"><?php echo __("Password", "wp"); ?></label>
								 		<input type="password" name="password" id="password" class="reset-password-password" placeholder="<?php echo __("Password", "wp"); ?>" value="<?php echo $_POST["password"]; ?>" required />
								 	</div>
									<div class="reset-password-fields">
								 		<label for="email"><?php echo __("Password", "wp"); ?></label>
								 		<input type="password" name="confirm_password" id="confirm_password" class="reset-password-confirm-password" placeholder="<?php echo __("Confirm Password", "wp"); ?>" value="<?php echo $_POST["confirm_password"]; ?>" required />
								 	</div>
									<input type="hidden" name="action" value="<?php echo $_GET["action"]; ?>" />
									<input type="hidden" name="key" value="<?php echo $_GET["key"]; ?>" />
									<input type="hidden" name="login" value="<?php echo $_GET["login"]; ?>" />
									<input type="submit" name="reset_password_submit" class="reset-password-submit" value="<?php echo __("Reset Password", "wp"); ?>" />
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
