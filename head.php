<?php
if(isset($_GET['resp']))
{
	$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
	$url = base64_encode($url);
}
else
{
	$url ='';
}

include_once('scpanel/web-config.php');
include_once('scpanel/functions/common.php');
include_once('scpanel/classes/class.DBQuery.php');
include_once('functions/common.php');
$db = new DBQuery();
if($_SESSION['userDetail']['email']=='')
{
	headerRedirect(USER_PATH.'login.php');
}
if (!$db->getRecordCount(0,'tbl_profiles', array('email' => $_SESSION['userDetail']['email'], 'profile_status' => 'A')))
{
	if($url !='')
	headerRedirect(USER_PATH.'index_main.php?go='.urlencode($url));
	else
	headerRedirect(USER_PATH.'index_main.php');
}
//echo $url;
$not_tot = countNotificationById($_SESSION['userDetail']['profile_code']);
if($not_tot>0){
	$flag_cls ='fa-flag';
}else{
	$flag_cls='fa-flag-o';
}

$act_tot = countNotificationById($_SESSION['userDetail']['profile_code']);
if($act_tot>0){
	$heart_cls ='fa fa-heart';
}else{
	$heart_cls='fa-heart-o';
}

$mess_tot = countNotificationById($_SESSION['userDetail']['profile_code']);
if($mess_tot>0){
	$mess_cls ='fa fa-envelope';
}else{
	$mess_cls='fa-envelope-o';
}

?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta charset="utf-8">
<!---Tittle--->
<title>Shaadi Choice</title>
<!---Bootstrap CSS--->
<link href="<?=USER_PATH?>css/bootstrap.css" rel="stylesheet" type="text/css" />
<!---Custom CSS--->
<link href="<?=USER_PATH?>css/custom.css" rel="stylesheet" type="text/css" />
<!---Responsive CSS--->
<link href="<?=USER_PATH?>css/responsive.css" rel="stylesheet" type="text/css" />
<!---Fontawesome--->
<link rel="stylesheet" href="<?=USER_PATH?>css/font-awesome.min.css">
<!---Fevicon--->
<link href="<?=USER_PATH ?>img/fev.png" rel="icon" type="image/png" />
<link href="<?=USER_PATH ?>css/blog.css" rel="stylesheet" type="text/css" />
<!---Font-->
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>

	<nav class="navbar navbar-default menu" role="navigation" role="navigation" data-spy="affix" data-offset-top="50">
		  <div class="container">
		  	<div class="row">
		  		<div class="col-sm-12">
		  			<div class="navbar-header">
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <a class="navbar-brand navbar-brand-logo" href="<?=USER_PATH?>dashboard.php" style="padding-top: 3px; height: 55px;">
						<img src="<?=USER_PATH?>img/logo.png" class="img-responsive">
					  </a>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					
						  <ul class="nav navbar-nav navbar-nav1 nav2 menu1">
						  		<li>
									<a href="<?=USER_PATH?>dashboard.php	" class="text-center">
										<i class="fa fa-tachometer" aria-hidden="true"></i>
										<p>My Dashboard</p>
									</a>
								</li>
								<li>
									<a href="<?=USER_PATH?>search.php" class="text-center">
										<i class="fa fa-search"></i>
										<p>Search</p>
									</a>
								</li>
								<li>
									<a href="<?=USER_PATH?>message.php" class="text-center">
										<i class="fa <?=$mess_cls;?>" aria-hidden="true"></i>
										<?php 
										$countMessage = countMessageById($_SESSION['userDetail']['profile_code']);
										if($countMessage > 0){
										?>
										<span class="badge" style="right: 8px;"><?php echo countMessageById($_SESSION['userDetail']['profile_code']);?></span>
										
										<? }?>
										<p>Messages</p>
									</a>
								</li>
								<li>
									<a href="<?=USER_PATH?>interest.php" class="text-center">
									<?php 
										$qry = "to_code = '". $_SESSION['userDetail']['profile_code'] ."' AND (notification_type = 'favorited me notification' OR notification_type = 'my favorite notification' OR notification_type = 'favorited back notification' OR notification_type = 'view profile notification' OR notification_type = 'ignored notification' OR notification_type = 'connect accept notification') AND read_status = 'N'";
										$allNoti = $db->getRecordCount(0, 'tbl_notifications', $qry);
										//$countNotiAll = count($allNoti);
									
									
									?>
										<i class="fa <?=$heart_cls;?>" aria-hidden="true"></i>
									<? if($allNoti > 0){?>	
										<span class="badge" style="right: 8px;"><?php echo $allNoti;?></span>
									<?}?>	
										<p>Activity</p>
									</a>
								</li>
								<?php /*
								<li>
									<a href="<?=USER_PATH?>meet-me.php" class="text-center">
										<i class="fa fa-handshake-o" aria-hidden="true"></i>
										<p>Connect</p>
									</a>
								</li>
								*/ ?>
								<li>
									<a href="<?=USER_PATH?>connect.php" class="text-center">
										<i class="fa fa-handshake-o" aria-hidden="true"></i>
										<p>Connect</p>
									</a>
								</li>

								<li>
									<a href="<?=USER_PATH?>notification.php" class="text-center">
										<i class="fa <?=$flag_cls;?>" aria-hidden="true"></i>
										<?php 
										$countNotification = countNotificationById($_SESSION['userDetail']['profile_code']);
										if($countNotification > 0){
										?>
										<span class="badge"><div id="notification_count"><?php echo countNotificationById($_SESSION['userDetail']['profile_code']);?></div></span>
										<? }?>
										<p>Notification</p>
									</a>
								</li>
						  </ul>
						  
						  <ul class="nav navbar-nav navbar-nav1 nav2 menu1 col-sm-offset-1">

							  <li>
								<a href="<?=USER_PATH?>improve.php" class="text-center">
									<i class="fa fa-line-chart" aria-hidden="true"></i> 
									<p>How can we improve?</p>
								</a>
							  </li>
							 
						  </ul>
						  <ul class="nav navbar-nav	navbar-right navbar_nav">
							<li><a href="<?=USER_PATH?>upgrade.php" class="btn-header">Upgrade Now</a></li>
							<li><i class="fa" aria-hidden="true"></i><p><?= "&nbsp;&nbsp;&nbsp;Welcome <a href='".USER_PATH."self-profile.php' class='wel-pro'>".(!empty($_SESSION['userDetail'])?($_SESSION['userDetail']['fname']!=''?ucfirst($_SESSION['userDetail']['fname']):''):'')."</a>"?></p></li>
							<li class="dropdown">
								<?php
								$profileImage='';
								if(!empty($_SESSION['userDetail']))
								{
									 $userProfileImage = $db->getRecord(0, array('image','image_code'), ' tbl_profile_images', array('profile_code' => $_SESSION['userDetail']['profile_code'], 'approved' => 'Y', 'default_image' => 'Y'));
									 $count = count($userProfileImage);
									 if($count>0 && $userProfileImage[0]['image']!='')
									 {
										 $profileImage = USER_PATH.'uploads/profile_pic/thumb/'.$userProfileImage[0]['image'];
									 }
									 else if($_SESSION['userDetail']['gender'] == 'M'){ $profileImage = USER_PATH.'img/male-default.png'; }
									 else if($_SESSION['userDetail']['gender'] == 'F') { $profileImage = USER_PATH.'img/female-default.png'; }
								}
								?>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img  src="<?=$profileImage?>"> <b class="caret"></b></a>
								<ul class="dropdown-menu multi-column columns-2">
									<div class="row">
										<div class="col-sm-6">
											<ul class="multi-column-dropdown">
												<li><a href="<?=USER_PATH?>self-profile.php"><i class="fa fa-user-o" aria-hidden="true"></i> My Profile</a></li>
												<li><a href="<?=USER_PATH?>self-profile.php#partner"><i class="fa fa-filter" aria-hidden="true"></i>Partner Preference</a></li>
												<li><a href="<?=USER_PATH?>setting.php"><i class="fa fa-cog" aria-hidden="true"></i> Manage Account</a></li>
											</ul>
										</div>
										<div class="col-sm-6">
											<ul class="multi-column-dropdown">
												<li><a href="<?=USER_PATH?>setting.php"><i class="fa fa-cogs" aria-hidden="true"></i> Account Settings</a></li>
												<li><a href="<?=USER_PATH?>setting.php"><i class="fa fa-lock" aria-hidden="true"></i> Change Password </a></li>
												<li><a href="<?=USER_PATH?>logout.php"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a></li>
											</ul>
										</div>
										<div class="col-sm-12  text-center">
											<hr>
											<li><a href="<?=USER_PATH?>help.php" class="btn btn-danger text-center">Help Center</a></li>
										</div>
									</div>
								</ul>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->	
		  		</div>
		  	</div>
		  </div><!-- /.container-fluid -->
		</nav>
       

<!--  end navbar -->
<script>
 setInterval(function(){  
  //alert('checked');
  var sess_id='logedin';
  $.get("checklogedin.php", {sess_id: sess_id} , function(data,status){
   if(status=='success'){
    //alert(data);
    if(data==1){
     //alert('logedin');
    }else{
     <?php //session_destroy(); ?>
    }   
   }else{
   }
  }); 
 }, 5000);

</script>