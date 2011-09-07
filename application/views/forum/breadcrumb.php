    <?=anchor('forum','Forum Home')?> &raquo;
    <?php foreach($breadcrumb as $crumb): ?>
    <?php if (isset($crumb[1])) {?><?=anchor($crumb[1],$crumb[0])?> &raquo;<?php } else { ?><?=$crumb[0]?><?php } ?>
    <?php endforeach; ?>