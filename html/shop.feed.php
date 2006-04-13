<?php
/**
 * RSS FEED Atom
 *
 */
 
global $mosConfig_offset;

$feedtype = mosgetparam($_REQUEST, 'type', 'rss');

while (@ob_end_clean());

function deleteXML($str) {
    $str = html_entity_decode($str);
    
    $str = str_replace("&", "&amp;", $str);
    $str = str_replace(">", "&gt;", $str);
    $str = str_replace("<", "&lt;", $str);
    
    return $str;
}

if ($feedtype == "rss") {
    header("Content-Type: application/rss+xml");
    echo '<?xml version="1.0" encoding="ISO-8859-1" ?'.'>'."\n";
    echo '<rss version="2.0">
    	<channel>
            <title>PDACafe.de Newsfeed</title>
            <link>http://www.pdacafe.de/rssfeed</link>
            <description>PDACafe News Feed</description>
            <pubDate>'.date('r').'</pubDate>
            <lastBuildDate>'.date('r').'</lastBuildDate>
            <docs>http://blogs.law.harvard.edu/tech/rss</docs>
            <generator>PDACafe News Feed</generator>
            <managingEditor>developer@pdacafe.de</managingEditor>
            <webMaster>developer@pdacafe.de</webMaster>
    ';
}
else {
    header("Content-Type: application/atom+xml");
    echo '<?xml version="1.0" encoding="ISO-8859-1" ?'.'>'."\n";
    echo '<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="de">
        <title>ClanCity Newsfeed</title>
        <link rel="self" href="http://www.pdacafe.de/atomfeed/"/>
        <updated>'.date("Y-m-d").'T'.date("H:i:s").'Z'.'</updated>
        <author>
            <name>ClanCity automatic Newsfeed</name>
        </author>
        <id>http://www.pdacafe.de/atomfeed/</id>
    ';
}

$db =& new ps_DB;
$q  = "SELECT DISTINCT product_sku, #__{vm}_product.product_id, #__{vm}_product.product_name, ";
$q .= "#__{vm}_product.mdate, #__{vm}_product.cdate, ";
$q .= "#__{vm}_product_price.product_price, MIN(#__{vm}_product.mdate) as min_date, ";
$q .= "MAX(#__{vm}_product.cdate) as max_date, #__{vm}_product.product_s_desc, ";
$q .= "#__{vm}_product_type_1.software_palm, #__{vm}_product_type_1.software_pocketpc ";
$q .= "FROM #__{vm}_product, #__{vm}_product_category_xref, ";
$q .= "#__{vm}_category, #__{vm}_product_verify, #__{vm}_product_type_1 ";
$q .= "LEFT JOIN #__{vm}_product_price ON (#__{vm}_product_price.product_id=#__{vm}_product.product_id) ";
$q .= "WHERE ";
$q .= "product_parent_id=''";
$q .= "AND #__{vm}_product.product_id=#__{vm}_product_category_xref.product_id ";
$q .= "AND #__{vm}_category.category_id=#__{vm}_product_category_xref.category_id ";
$q .= "AND #__{vm}_product.product_publish='Y' ";
$q .= "AND #__{vm}_product_verify.product_id=#__{vm}_product.product_id ";
$q .= "AND #__{vm}_product_verify.verified=1 ";
$q .= "AND #__{vm}_product_type_1.product_id=#__{vm}_product.product_id ";
$q .= "GROUP BY #__{vm}_product.product_id ";
$q .= "ORDER BY #__{vm}_product.product_id DESC ";
$q .= "LIMIT 0, 20 ";
$db->query($q);

$items = array();
while ($db->next_record()) {
    $key = $db->f("mdate").'_'.$db->f("product_name");
    $items[$key] = $db->record[$db->row];
}

$now = date( 'Y-m-d H:i:s', time() + $mosConfig_offset * 60 * 60 );
$access = !$mainframe->getCfg( 'shownoauth' );
$query = "SELECT a.*"
		. "\n FROM #__content AS a"
		. "\n WHERE ( a.state = '1' AND a.checked_out = '0' )"
		. "\n AND ( a.publish_up = '0000-00-00 00:00:00' OR a.publish_up <= '". $now ."' )"
		. "\n AND ( a.publish_down = '0000-00-00 00:00:00' OR a.publish_down >= '". $now ."' )"
    	. ( $access ? "\n AND a.access <= '". $my->gid ."'" : '' )
		. "\n ORDER BY a.created DESC LIMIT 20"
		;
$database->setQuery( $query );
$rows = $database->loadObjectList();

foreach ( $rows as $row ) {
    $date = explode(" ", $row->created);
    $time = explode(":", $date[1]);
    $date = explode("-", $date[0]);
    $key = mktime($time[0], $time[1], $time[2], $date[1], $date[2], $date[0]);
    $row->mdate = $key;
    $items[$key] = $row;
}

krsort($items);

require_once(CLASSPATH . 'ps_product.php');
$ps_product = new ps_product();

$counter = 0;
foreach ($items as $item) {
    $counter++;
    if ($feedtype == "rss") {
        echo '
        <item>';
        if (isset($item->product_name)) {
            // Produkt
            if ($item->mdate == $item->cdate) {
                echo '
                <title>'.deleteXML($item->product_name).'</title>';
            }
            else {
                echo '
                <title>[UPDATE] '.deleteXML($item->product_name).'</title>';
            }
            $desc = "";
            $desc .= "Preis: ".trim(eregi_replace("(<)([^>]+)(>)", "", $ps_product->show_price($item->product_id, true)))."\n";
            $system = trim(str_replace(",", ", ", $item->software_palm.' '.$item->software_pocketpc));
            $desc .= $item->product_s_desc;
            
            echo '
                <description>'.deleteXML($desc).'</description>
                <link>http://www.pdacafe.de/'.$item->product_id.'</link>
                <guid>http://www.pdacafe.de/'.$item->product_id.'</guid>
                ';

        }
        else {
            // News
            echo '
            <title>[NEWS] '.deleteXML($item->title).'</title>
            <description>'.deleteXML( substr($item->fulltext, 0, 300 )).'</description>
            <link>http://www.pdacafe.de/index.php?option=com_content&amp;task=view&amp;id='.$item->id.'</link>
            <guid>http://www.pdacafe.de/index.php?option=com_content&amp;task=view&amp;id='.$item->id.'</guid>';
        }
        echo '
                <pubDate>'.date("r", $item->mdate).'</pubDate>
        </item>
        ';
    }
    else {
        echo '
        <entry>';
        if (isset($item->product_name)) {
            // Produkt
            if ($item->mdate == $item->cdate) {
                echo '
                <title>'.deleteXML($item->product_name).'</title>';
            }
            else {
                echo '
                <title>[UPDATE] '.deleteXML($item->product_name).'</title>';
            }
            $desc = "";
            $desc .= "Preis: ".trim(eregi_replace("(<)([^>]+)(>)", "", $ps_product->show_price($item->product_id, true)))."\n";
            $system = trim(str_replace(",", ", ", $item->software_palm.' '.$item->software_pocketpc));
            $desc .= $item->product_s_desc;
            
            echo '
                <summary>'.deleteXML($desc).'</summary>
                <link href="http://www.pdacafe.de/'.$item->product_id.'"/>
                <id>http://www.pdacafe.de/'.$item->product_id.'</id>
                ';

        }
        else {
            // News
            echo '
            <title>[NEWS] '.deleteXML($item->title).'</title>
            <summary>'.deleteXML( substr($item->fulltext, 0, 300 )).'</summary>
            <link href="http://www.pdacafe.de/index.php?option=com_content&amp;task=view&amp;id='.$item->id.'"/>
            <id>http://www.pdacafe.de/index.php?option=com_content&amp;task=view&amp;id='.$item->id.'</id>';
        }
        echo '
                <updated>'.date("Y-m-d", $item->mdate).'T'.date("H:i:s", $item->mdate).'Z'.'</updated>
        </entry>
        ';
    }
    
    if ($counter == 20) break;
}

if ($feedtype == "rss") {
echo '
    </channel>
</rss>';
}
else {
echo '</feed>';
}

//echo str_replace("#__{vm}_", "mos_vm_", $q);

//print_r($items);
exit;
?>