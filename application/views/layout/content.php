        <div id="content">
            <div class="content-inner content-inner-subpage <?php echo (isset($sidebar) ? "content-with-sidebar" : "") ?>">
            
            	<?php if (isset($sidebar)): ?>
                    <div class="left">
                        <?php echo $content; ?>
                    </div>
                    <div class="right">
                        <?php echo $sidebar; ?>
                    </div>
                <?php else: ?>                
                    <div class="full">
                        <?php echo $content; ?>
                    </div>
                <?php endif; ?>
            
            </div>        
        </div>