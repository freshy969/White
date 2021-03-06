<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title(); ?></title>
<meta name="revisit-after" content="1 days">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/bbpress/style.css" type="text/css" media="screen">
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<?php wp_head(); ?>
</head>
<?php flush(); ?>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed animated tada" id="btn" data-toggle="collapse" data-target="#meni">Menu <i class="fa fa-bars"></i></button>
<?php if (is_single('')) : ?>
<a href="javascript:history.back();" data-toggle="tooltip" data-placement="bottom" title="Vrati se nazad" class="btn btn-default navbar-btn pull-left" id="nazad" style="margin-right:15px;"><i class="fa fa-angle-left"></i></a>
<?php endif; ?>
<a class="navbar-brand animated fadeInDown" id="limun" href="<?php echo esc_url(home_url()); ?>/forum" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?> Forum</a>
</div>
<div class="collapse navbar-collapse" id="meni">
<?php if (is_user_logged_in()) : ?>
<ul class="nav navbar-nav pull-right">
<a href="#new-post" class="zapocni btn navbar-btn navbar-right btn-primary hidden-lg hidden-md">Start a Discussion</a>
<li class="dropdown pull-right">
<a href="#" class="dropdown-toggle navbar-gravatar" data-toggle="dropdown"> <?php global $current_user; get_currentuserinfo(); echo get_avatar($current_user->user_email, 32 ); ?></a>
<ul class="dropdown-menu" role="menu" >
<li <?php if (bbp_is_single_user_edit()) { echo ' class="active"'; } ?>><a href="<?php echo bbp_get_user_profile_url( get_current_user_id() ); ?>edit/"><i class="fa fa-pencil-square-o"></i> Edit profile</a></li>
<li><a href="<?php echo bbp_get_user_profile_url( get_current_user_id() ); ?>edit/#user_login"><i class="fa fa-lock"></i> Change Password</a></li>
<li class="divider"></li>
<li><a href="<?php echo wp_logout_url(); ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
</ul>
</li>
</ul>
<?php else : ?>
<div class="btn-group pull-right navbar-btn" style="margin-left:15px;">
<a class="btn btn-default" href="" data-toggle="modal" data-target="#prijava">Login</a>
<a class="btn btn-success" href="" data-toggle="modal" data-target="#registracija">Registration</a>
</div>
<?php endif; ?>
<form role="search" method="get" id="bbp-searchform" action="<?php echo esc_url( home_url( 'forum/' ) ); ?>" class="navbar-form navbar-right hidden-xs hidden-sm">
<div class="form-group has-feedback has-feedback-left">
<input data-toggle="tooltip" data-placement="bottom" title="Enter topic for search" type="text" name="ts" id="ts" class="form-control" placeholder="Search...">
<span class="fa fa-search form-control-feedback" aria-hidden="true"></span>
</div>
</form>
</div>
</div>
</nav>
<?php if (bbp_is_user_home() == bbp_is_favorites_active() || bbp_is_single_user_profile() || bbp_is_single_user_topics() || bbp_is_single_user_replies() || bbp_is_single_user_edit()) : ?>
<div class="korisnik">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="pull-left" style="margin-right:25px;">
<a class="img-responsive" href="<?php bbp_user_profile_url(); ?>" title="<?php bbp_displayed_user_field( 'display_name' ); ?>" rel="me">
<?php echo get_avatar( bbp_get_displayed_user_field( 'user_email', 'raw' ), apply_filters( 'bbp_single_user_details_avatar_size', 100 ) ); ?>
</a>
</div>
<bottom class="btn btn-danger pull-right" style="margin-top:10px;">
<?php  printf( __( '%s', 'bbpress' ), bbp_get_user_display_role() ); ?>
</bottom>
<h1><?php bbp_displayed_user_field( 'display_name' ); ?></h1>
<?php bbp_displayed_user_field( 'description' ); ?>
</div>
</div>
</div>
</div>
<?php endif; ?>
<?php if (is_single()) : ?>
<div class="header">
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<h1><?php the_title();?></h1>
</div>
</div>
</div>
</div>
<?php endif; ?>
<div class="container" style="margin-top:40px;">
<div class="row">
<?php if (is_archive() ||  bbp_is_single_forum() || bbp_is_single_view()) : ?>
<div class="col-md-2">
<ul class="nav-pills nav-stacked hidden-xs hidden-sm" data-spy="affix">
<?php if ( is_user_logged_in() ) : ?>
<a href="#new-post" class="zapocni btn btn-primary btn-block">Start a Discussion</a>
<?php endif; ?>
<li <?php if ( is_archive('forum')) { echo ' class="active"'; } ?>><a href="<?php echo esc_url(home_url()); ?>/forum"><i class="fa fa-comments-o"></i> All Discussions</a></li>
<li <?php if ( bbp_is_single_view()) { echo ' class="active"'; } ?>><a href="<?php echo esc_url(home_url()); ?>/forum/view/no-replies/"><i class="fa fa-comment-o"></i> Unanswered</a></li>
<li><a href="<?php echo bbp_get_user_profile_url( get_current_user_id() ); ?>favorites/" class="hidden-xs hidden-sm"><i class="fa fa-star"></i> Following</a></li>
<li></li>
<?php if (get_option('white_kategorija_1')) : ?>
<li<?php if (is_single(get_option(white_kategorija_1))) { echo ' class="active"'; } ?>><a href="<?php echo esc_url(home_url()); ?>/<?php echo sanitize_title(strtolower(get_option('white_kategorija_1'))); ?>">
<i class="<?php echo get_option('white_boja_1'); ?>" style="float:left;width:16px;height:16px;margin-right:15px;margin-top:2px;"></i> <?php echo get_option('white_kategorija_1'); ?></a></li>
<?php endif; ?>
<?php if (get_option('white_kategorija_2')) : ?>
<li<?php if (is_single(get_option(white_kategorija_2))) { echo ' class="active"'; } ?>><a href="<?php echo esc_url(home_url()); ?>/<?php echo sanitize_title(strtolower(get_option('white_kategorija_2'))); ?>">
<i class="<?php echo get_option('white_boja_2'); ?>" style="float:left;width:16px;height:16px;margin-right:15px;margin-top:2px;"></i> <?php echo get_option('white_kategorija_2'); ?></a></li>
<?php endif; ?>
<?php if (get_option('white_kategorija_3')) : ?>
<li<?php if (is_single(get_option(white_kategorija_3))) { echo ' class="active"'; } ?>><a href="<?php echo esc_url(home_url()); ?>/<?php echo sanitize_title(strtolower(get_option('white_kategorija_3'))); ?>">
<i class="<?php echo get_option('white_boja_3'); ?>" style="float:left;width:16px;height:16px;margin-right:15px;margin-top:2px;"></i> <?php echo get_option('white_kategorija_3'); ?></a></li>
<?php endif; ?>
<?php if (get_option('white_kategorija_4')) : ?>
<li<?php if (is_single(get_option(white_kategorija_4))) { echo ' class="active"'; } ?>><a href="<?php echo esc_url(home_url()); ?>/<?php echo sanitize_title(strtolower(get_option('white_kategorija_4'))); ?>">
<i class="<?php echo get_option('white_boja_4'); ?>" style="float:left;width:16px;height:16px;margin-right:15px;margin-top:2px;"></i> <?php echo get_option('white_kategorija_4'); ?></a></li>
<?php endif; ?>
<?php if (get_option('white_kategorija_5')) : ?>
<li<?php if (is_single(get_option(white_kategorija_5))) { echo ' class="active"'; } ?>><a href="<?php echo esc_url(home_url()); ?>/<?php echo sanitize_title(strtolower(get_option('white_kategorija_5'))); ?>">
<i class="<?php echo get_option('white_boja_5'); ?>" style="float:left;width:16px;height:16px;margin-right:15px;margin-top:2px;"></i> <?php echo get_option('white_kategorija_5'); ?></a></li>
<?php endif; ?>
</ul>
</ul>
</div>
<div class="col-md-10">
<?php the_content(); ?>
</div>
<?php else : ?>
<div class="col-md-12"><?php the_content(); ?></div>
<?php endif; ?>
<div class="col-md-12"><div class="copyright text-right"><a href="http://www.sceko.com/" target="_blank" title="Created by Sceko">Created by Sceko</a></div></div>
</div>
</div>
<?php if (is_user_logged_in()) : ?>
<?php else : ?>
<div class="modal fade" id="prijava" tabindex="-1" role="dialog" aria-labelledby="prijava" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content text-center">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title text-center">Login in</h4>
</div>
<div class="modal-body">
<form name="login-form" role="form" action="<?php echo site_url( 'wp-login.php', 'login_post' ) ?>" method="post">
<div class="form-group">
<input type="text" name="log" class="form-control" placeholder="Username">
</div>
<div class="form-group">
<input type="password" name="pwd" class="form-control" placeholder="Password">
</div>
<div class="form-group">
<label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> Remember me</label>
</div>
<p>
<a href="<?php echo wp_lostpassword_url(); ?>" title="Forgot your password?">Forgot your password?</a>
</p>
<div class="form-group">
<button type="submit" name="wp-submit" style="width:100%;" class="btn btn-primary">Login</button>
</div>
</form>
</div>
</div>
</div>
</div> 
<div class="modal fade" id="registracija" tabindex="-1" role="dialog" aria-labelledby="registracija" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content text-center" style="width:335px;">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Registration</h4>
</div>
<div class="modal-body">
<form name="login-form" role="form" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
<div class="form-group">
<input type="text" name="user_login" class="form-control" placeholder="Username">
</div>
<div class="form-group">
<input type="text" name="user_email" class="form-control" placeholder="E-mail">
</div>
<div class="bbp-template-notice"><p>The password will be sent to you.</p></div>
<button type="submit" name="user-submit" style="width:100%;" class="btn btn-primary">Complete registration</button>
<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?register=true" />
<input type="hidden" name="user-cookie" value="1">
</form>
</div>
</div>
</div>
</div>
<?php endif; ?>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(
function() {
if(window.location.href.indexOf("#new-post") > -1) {
$("#new-post").fadeToggle();
}
$(".bbp-topic-reply-link").click(function() {
$("#new-post").fadeToggle();
});
$(".bbp-reply-to-link").click(function() {
$("#new-post").fadeToggle();
});
$(".zapocni").click(function() {
$("#new-post").fadeToggle();
});
$("body").mouseup(function(e) {
var subject = $("#new-post"); 
if(e.target.id != subject.attr('id') && !subject.has(e.target).length) { subject.fadeOut(); }
});
});
</script>
<script type="text/javascript">
$(function () {
$('[data-toggle="tooltip"]').tooltip()
});
</script>
<style>
.quicktags-toolbar{ border-bottom:none;background:#ECF1F8;border-top:1px solid #ECF1F8;border-left:1px solid #ECF1F8;border-right:1px solid #ECF1F8; }
.wp-editor-area { border:1px solid #ECF1F8; }
#wp-bbp_reply_content-editor-container .button { background-color: #fff; color: #444; border-color: #ECF1F8; border-radius:4px; }
#wp-bbp_reply_content-editor-container .button:hover { background-color: #fff; color: #355B8E; border-color: #ECF1F8; border-radius:4px; }
#wp-bbp_topic_content-editor-container .button { background-color: #fff; color: #444; border-color: #ECF1F8; border-radius:4px; }
#wp-bbp_topic_content-editor-container .button:hover { background-color: #fff; color: #355B8E; border-color: #ECF1F8; border-radius:4px; }
</style>
<?php wp_footer(); ?>
</body>
</html>