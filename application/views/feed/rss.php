<?php
echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
?>
<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/">

    <channel>

    <title><?php echo $feed_name; ?></title>

    <link><?php echo $feed_url; ?></link>
    <description><?php echo $page_description; ?></description>
    <dc:language><?php echo $page_language; ?></dc:language>
    <dc:creator><?php echo $creator_email; ?></dc:creator>

    <dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
    <admin:generatorAgent rdf:resource="http://www.codeigniter.com/" />

    <?php foreach($posts as $entry): ?>
    
		<?php
        if ($entry->category_name == 'video-guides') {
			$entry->post_title .= " Video Guide";
        }
        ?>

        <item>
			
          <title><?php echo xml_convert($entry->post_title); ?></title>
          <link><?php echo site_url($entry->category_name.'/' . $entry->post_seo) ?></link>
          <guid><?php echo site_url($entry->category_name.'/' . $entry->post_seo) ?></guid>

          <description><![CDATA[
      <?=str_replace('/assets/images/', base_url() . 'assets/images/', $entry->post_excerpt); ?>
      ]]></description>
      <pubDate><?php echo date ('r', $entry->posted_on);?></pubDate>
        </item>


    <?php endforeach; ?>

    </channel></rss>