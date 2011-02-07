<div id="home">
    <ul>
    <?php foreach ($categories as $category): ?>
    <li><?=anchor($category->category_name,$category->category_display);?></li>
    <?php endforeach; ?>
    </ul>
</div>