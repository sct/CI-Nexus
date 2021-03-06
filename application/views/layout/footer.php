        <div id="footer">
        	<div class="footer-nav">
                <ul>
                    <li class="col-header">Sections</li>
                    <li><?=anchor("/","Home");?></li>
                    <li><?=anchor("/news","News");?></li>
                    <li><?=anchor("/dev-updates","Dev Updates"); ?></li>
                    <!-- <li><? // echo anchor("/guides","Guides"); ?></li> -->
                    <li><?=anchor("/video-guides","Video Guides");?></li>
                </ul>
                <ul>
                    <li class="col-header">About</li>
                	<?php if ($this->session->userdata('username') == false) { ?>
                    <li><?=anchor("/register","Register");?></li>
                    <li><?=anchor("/login","Login");?></li>
                    <?php } ?>
                    <li><?=anchor("/about-us","About");?></li>
                    <li><?=anchor("/contact-us","Contact Us");?></li>
                    <li><?=anchor("/privacy-policy","Privacy Policy");?></li>
                </ul>
                <ul>
                    <li class="col-header">Community</li>
                    <li><?=anchor("http://www.facebook.com/pages/DCUO-Nexus/192452260784181","Facebook");?></li>
                    <li><?=anchor("http://twitter.com/dcuonexus","Twitter");?></li>
                    <li><?=anchor("/feed","RSS");?></li>
                </ul>
                <div class="footer-logo">
                	<img src="/assets/images/footer-logo.png" alt="DC Universe Nexus">
                </div>
            </div>
            <div class="copyright">
            	<p>Copyright © 2011 DCUO Nexus. All rights reserved. DCUO Nexus is a fansite. For official content, visit the <?=anchor("http://www.dcuniverseonline.com","DC Universe Online website");?>.<br>The DC logo is copyright DC Comics and all game assets are property of Sony Online Entertainment.</p>
            </div>
        </div>
    </div>
    
	<script type="text/javascript">
    
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-9313003-10']);
      _gaq.push(['_trackPageview']);
    
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    
    </script>

</body>
</html>