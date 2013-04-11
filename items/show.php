<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'item show')); ?>

<h1><?php echo metadata('item', array('Dublin Core', 'Identifier')) . (metadata('item', array('Dublin Core', 'Title')) ? " - " . metadata('item', array('Dublin Core', 'Title')) : ""); ?></h1>

<div id="primary">
    
    <?php fire_plugin_hook('public_items_show_top', array('view' => $this, 'item' => $item)); ?>
    
    <?php if (metadata('item', 'Item Type Name') == "2Volksverhaal"): ?>
        <?php ?>
    <?php else: ?>
        <?php echo all_element_texts('item'); ?>

    <?php endif; ?>    

    <?php Null;# echo some_element_texts('item', array("Identifier", "Title", "Description", "Text")); ?>






</div><!-- end primary -->

<aside id="sidebar">

    <!-- To add divs under the collection div. -->
    <?php fire_plugin_hook('public_items_show_sidebar_ultimate_top', array('view' => $this, 'item' => $item)); ?>

    <!-- If the item belongs to a collection, the following creates a link to that collection. -->
    <?php if (metadata('item', 'Collection Name')): ?>
    <div id="collection" class="element">
        <h2><?php echo __('Collection'); ?></h2>
        <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
    </div>
    <?php endif; ?>

    
    <!-- To add divs under the collection div. -->
    <?php fire_plugin_hook('public_items_show_sidebar_top', array('view' => $this, 'item' => $item)); ?>
    
    
    <!-- The following returns all of the files associated with an item. -->
    <?php if (metadata('item', 'has files')): ?>
    <div id="itemfiles" class="element">
        <h2><?php echo __('Files'); ?></h2>
        <?php if (get_theme_option('Item FileGallery') == 1): ?>
        <?php echo item_image_gallery(); ?>
        <?php else: ?>
        <?php echo files_for_item(); ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- The following prints a list of all tags associated with the item -->
    <?php if (metadata('item', 'has tags')): ?>
    <div id="item-tags" class="element">
        <h2><?php echo __('Tags'); ?></h2>
        <div class="element-text"><?php echo tag_string('item'); ?></div>
    </div>
    <?php endif;?>

    <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>

</aside>

<ul class="item-pagination navigation">
    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
</ul>

<?php echo foot(); ?>
