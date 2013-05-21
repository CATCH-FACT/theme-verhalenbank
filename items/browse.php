<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
?>

<h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

<nav class="items-nav navigation" id="secondary-nav">
    <?php echo public_nav_items(); ?>
</nav>

<?php echo pagination_links();
#echo pagination_links(); ?>

<?php if ($total_results > 0): ?>

<?php
$sortLinks[__('Narration Date')] = 'Dublin Core,Date';
$sortLinks[__('Subgenre')] = 'Item Type Metadata,Subgenre';
$sortLinks[__('Identifier')] = 'Dublin Core,Identifier';
?>
<div id="sort-links">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>

<?php endif; ?>

<?php foreach (loop('items') as $item): ?>
<div class="item hentry">
    <h2><?php echo link_to_item(metadata('item', array('Dublin Core', 'Identifier')) . 
                    (metadata('item', array('Dublin Core', 'Title')) ? " - " . metadata('item', array('Dublin Core', 'Title')) : ""), array('class'=>'permalink')); ?></h2>
    
    <div class="item-meta">
    <?php if (metadata('item', 'has thumbnail')): ?>
    <div class="item-img">
        <?php echo link_to_item(item_image('square_thumbnail')); ?>
    </div>
    <?php endif; ?>

    <?php if ($subgenre = metadata('item', array('Item Type Metadata', 'Subgenre'))): ?>
    <div class="item-description">
        <h4 style = "display:inline;"><?php echo $subgenre; ?></h4>
        
        <?php if ($date = metadata('item', array('Dublin Core', 'Date'))): ?>
        <div style = "display:inline-block; float:right;" class="item-date">
            <?php echo $date; ?>
        </div>
        <?php endif; ?>
        
    </div>
    <?php endif; ?>


    <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
    <div class="item-description">
        <?php echo $description; ?>
    </div>
    <?php endif; ?>

    <?php if (metadata('item', 'has tags')): ?>
    <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
        <?php echo tag_string('items'); ?></p>
    </div>
    <?php endif; ?>

    <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>

    </div><!-- end class="item-meta" -->
</div><!-- end class="item hentry" -->
<?php endforeach; ?>

<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
