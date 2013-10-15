<?php

function custom_next_previous()
{
    //Starts a conditional statement that determines a search has been run
    if ($search = $_GET['search']) {
        // Sets the current item ID to the variable $current
        $current = item('id');
 
        // Get an array of all the items from the search, and all the IDs
        $list = get_items(array('search'=>$search),total_results());
        foreach ($list as &$value) {
            $itemIds[] = $value->id;
        }
 
        // Find where we currently are in the result set
        $key = array_search($current, $itemIds);
 
        // If we aren't at the beginning, print a Previous link
        if ($key > 0) {
            $previousItem = $list[$key - 1];
            $previousUrl = item_uri('show', $previousItem) . '?' . $_SERVER['QUERY_STRING'];
            echo '<li><a href="' . $previousUrl . '">Previous Item</a></li>';
        }
 
        // If we aren't at the end, print a Next link
        if ($key < count($list) - 1) {
            $nextItem = $list[$key + 1];
            $nextUrl = item_uri('show', $nextItem) . '?' . $_SERVER['QUERY_STRING'];
            echo '<li class="next"><a href="' . $nextUrl . '">Next Item</a></li>';
        }
    } else {
        // If a search was not run, then the normal next/previous navigation is displayed.
        echo '<li>'.link_to_previous_item('Previous Item').'</li>';
        echo '<li class="next">'.link_to_next_item('Next Item').'</li>';
    }
}



/**
 * Create a tag cloud made of divs that follow the hTagcloud microformat
 *
 * @package Omeka\Function\View\Tag
 * @param Omeka_Record_AbstractRecord|array $recordOrTags The record to retrieve 
 * tags from, or the actual array of tags
 * @param string|null $link The URI to use in the link for each tag. If none 
 * given, tags in the cloud will not be given links.
 * @param int $maxClasses
 * @param bool $tagNumber
 * @param string $tagNumberOrder
 * @return string HTML for the tag cloud
 */
function tag_cloud($recordOrTags = null, $link = null, $maxClasses = 9, $tagNumber = false, $tagNumberOrder = null)
{
    if (!$recordOrTags) {
        $tags = array();
    } else if (is_string($recordOrTags)) {
        $tags = get_current_record($recordOrTags)->Tags;
    } else if ($recordOrTags instanceof Omeka_Record_AbstractRecord) {
        $tags = $recordOrTags->Tags;
    } else {
        $tags = $recordOrTags;
    }
    
    if (empty($tags)) {
        return '<p>' . __('No tags are available.') . '</p>';
    }
    
    //Get the largest value in the tags array
    $largest = 0;
    foreach ($tags as $tag) {
        if($tag["tagCount"] > $largest) {
            $largest = $tag['tagCount'];
        }
    }
    $html = '<div class="hTagcloud">';
    $html .= '<ul class="popularity">';
    
    if ($largest < $maxClasses) {
        $maxClasses = $largest;
    }
    
    foreach( $tags as $tag ) {
        $size = (int)(($tag['tagCount'] * $maxClasses) / $largest - 1);
        $class = str_repeat('v', $size) . ($size ? '-' : '') . 'popular';
        $html .= '<li class="' . $class . '">';
        if ($link) {
            $html .= '<a href="' . html_escape(url($link, array('tags' => $tag['name']))) . '">';
        }
        if($tagNumber && $tagNumberOrder == 'before') {
            $html .= ' <span class="count">'.$tag['tagCount'].'</span> ';
        }
        $html .= html_escape($tag['name']);
        if($tagNumber && $tagNumberOrder == 'after') {
            $html .= ' <span class="count">'.$tag['tagCount'].'</span> ';
        }
        if ($link) {
            $html .= '</a>';
        }
        $html .= '</li>' . "\n";
    }
    $html .= '</ul></div>';
    
    return $html;
}

?>