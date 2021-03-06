<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo (isset($title) ? $title : "DCUO Nexus"); ?></title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<?php if (isset($meta_description)) { ?>
<meta name="description" content="<?=$meta_description?>">
<?php } ?>
<meta name="robots" content="index,follow">
<?php if (isset($canonical)) { ?>
<link rel="canonical" href="<?=base_url().$canonical;?>">
<?php } ?>
<link rel="alternate" type="application/rss+xml" title="DC Universe Online News and Guides" href="/feed">
<link rel="shortcut icon" href="/favicon.ico">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/global.css">
<?php if (isset($admin_css)) { ?>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/admin.css">
<?php } ?>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.js"></script>
<?php if (isset($jquery_slider)) { ?>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/featured-content.css">
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-easing.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-featured-content.js"></script>
<?php } ?>
<?php if (isset($tab_content)) { ?>
<script type="text/javascript" src="<?=base_url();?>assets/js/tab-content.js"></script>
<?php } ?>
<?php if (isset($edit_avatar)) { ?>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/imgareaselect-default.css">
	<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.imgareaselect.pack.js"></script>
	<script type="text/javascript">
	$(document).ready(function () {
	    $('img#photoselect').imgAreaSelect({
	        handles: true,
			aspectRatio: "1:1",
			onSelectChange: preview
	    });
	
	    $("#save_avatar").click(function() {  
	        var x1 = $("#x1").val();  
	        var y1 = $("#y1").val();  
	        var x2 = $("#x2").val();  
	        var y2 = $("#y2").val();  
	        var w = $("#w").val();  
	        var h = $("#h").val();  
	        if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){  
	            alert("You must make a selection first");  
	            return false;  
	        }else{  
	            return true;  
	        }  
	    });
	
		function preview(img, selection) {  
		    var scaleX = 100 / selection.width;  
		    var scaleY = 100 / selection.height;   

		    $("#photoselect + div > img").css({  
		        width: Math.round(scaleX * img.width) + "px",  
		        height: Math.round(scaleY * img.height) + "px",  
		        marginLeft: "-" + Math.round(scaleX * selection.x1) + "px",  
		        marginTop: "-" + Math.round(scaleY * selection.y1) + "px"  
		    });  
		    $("#x1").val(selection.x1);  
		    $("#y1").val(selection.y1);  
		    $("#x2").val(selection.x2);  
		    $("#y2").val(selection.y2);  
		    $("#w").val(selection.width);  
		    $("#h").val(selection.height);  
		}
	});
	</script>
<?php } ?>
<?php if (isset($tiny_mce)) { ?>
<!-- TinyMCE -->
<script type="text/javascript" src="<?=base_url();?>assets/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php"></script>
<script type="text/javascript">
	tinyMCE.init({
            mode : "textareas",
            theme : "advanced",
            file_browser_callback : "tinyBrowser",
            theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,cut,copy,paste,pastetext,pasteword,undo,redo",
            theme_advanced_buttons2 : "link,unlink,|,outdent,indent,|,anchor,image,cleanup,code,|,forecolor,backcolor,tablecontrols,|,hr,visualaid",
            theme_advanced_buttons3 : "",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left"
        });
</script>
<!-- /TinyMCE -->
<?php } ?>
<?php if (isset($jquery_slider)) { ?>
<script type="text/javascript">
 $(document).ready( function(){	
		var buttons = { previous:$('#featured-story .featured-previous') ,
						next:$('#featured-story .featured-next') };
						
		$obj = $('#featured-story').featuredJSidernews( { interval : 7000,
												direction		: 'opacitys',	
											 	easing			: 'easeInOutExpo',
												duration		: 1200,
												maxItemDisplay  : 3,
												navPosition     : 'horizontal', // horizontal
												navigatorHeight : 29,
												navigatorWidth  : 76,
												mainWidth:1000,
												buttons			: buttons} );	
	});
</script>
<?php } ?>
</head>
<body>

    <div id="container">
        <div id="header">
            <div class="logo">
                <a href="/">DCUO Nexus</a>
            </div>
            <div class="nav">
            	<div class="nav-links">
                    <ul>
                        <li><a href="/"<?php echo ((isset($nav_selected) && $nav_selected == 'home') ? ' class="selected"' : ''); ?>>Home</a></li>
                        <li><a href="/news"<?php echo ((isset($nav_selected) && $nav_selected == 'news') ? ' class="selected"' : ''); ?>>News</a></li>
                        <li><a href="/dev-updates"<?php echo ((isset($nav_selected) && $nav_selected == 'dev-updates') ? ' class="selected"' : ''); ?>>Dev Updates</a></li>
                        <li><a href="/video-guides"<?php echo ((isset($nav_selected) && $nav_selected == 'video-guides') ? ' class="selected"' : ''); ?>>Video Guides</a></li>
                        <!-- <li><a href="/guides"<?php //echo ((isset($nav_selected) && $nav_selected == 'guides') ? ' class="selected"' : ''); ?>>Guides</a></li> -->
                        <!-- <li><a href="/wiki"<?php //echo ((isset($nav_selected) && $nav_selected == 'wiki') ? ' class="selected"' : ''); ?>>Wiki</a></li> -->
                    </ul>
                </div>
                <?php if ($this->session->userdata('username') != false) { ?>
                    <div class="register">
                        <a href="/profile">Profile</a>
                    </div>
                    <div class="login">
                        <a href="/logout">Logout</a>
                    </div>
                    <div class="welcome">
                    	<div class="welcome-avatar">
							<?php if(user_avatar($this->session->userdata('id'),true)):  ?>
                                <?=anchor('profile/'.$this->session->userdata('username'),'<img src="'.base_url().'assets/upload/images/avatars/avatar-'.$this->session->userdata('id').'.jpg">');?>
                            <?php else: ?>
                                <?=anchor('profile/'.$this->session->userdata('username'),'<img src="'.base_url().'assets/images/profile-pic-default.jpg" />');?>
                            <?php endif; ?>
                        </div>
                        <div class="welcome-text">
                    		Welcome, <strong><?php echo $this->session->userdata('display_name'); ?></strong>
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="register">
                        <a href="/register">Register</a>
                    </div>
                    <div class="login">
                        <a href="/login">Login</a>
                    </div>
                <? } ?>
            </div>
        </div>