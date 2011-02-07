<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>DC Universe Online Nexus | DCUO Nexus</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<meta name="description" content="Stay up to date with DC Universe Online news, guides, and more.">
<meta name="robots" content="index,follow">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/global.css">
<?php if (isset($jquery_slider)) { ?>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/featured-content.css" />
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-easing.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-featured-content.js"></script>
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
												mainWidth:640,
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
            	<ul>
                	<li><a href="/" class="selected">Home</a></li>
                	<li><a href="/news">News</a></li>
                	<li><a href="/guides">Guides</a></li>
                	<li><a href="/wiki">Wiki</a></li>
                	<li><a href="/dev-updates">Dev Tracker</a></li>
                </ul>
                <?php if ($this->session->userdata('username') != false) { ?>
                    <div class="register">
                        <a href="/logout">Logout</a>
                    </div>
                    <div class="welcome">
                    	Welcome, <strong><?php echo $this->session->userdata('display_name'); ?></strong>
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