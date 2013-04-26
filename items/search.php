<?php
$pageTitle = __('Search Items');
echo head(array('title' => $pageTitle,
           'bodyclass' => 'items advanced-search'));
?>

<h1><?php echo $pageTitle; ?></h1>
<?php 

if (!empty($_GET['style'])) {
    $search_style = $_GET['style'];
} else {
    $search_style = "medium";
}
?>

<nav class="items-nav navigation secondary-nav">
    <ul class="navigation">
        <li>
            <a href="search?style=medium"><?php echo __("Advanced Search")?></a>
        </li>
        <li>
            <a href="search?style=advanced"><?php echo __("Very Advanced Search")?></a>
        </li>
    </ul>
</nav>

<!--<nav class="items-nav navigation secondary-nav"> -->
    <?php #echo public_nav_items(); ?>
<!--</nav> -->

<?php 
if ($search_style == "medium"){
    echo $this->partial('items/search-form-medium.php', array('formAttributes' =>
                        array('id'=>'advanced-search-form')));
}
elseif ($search_style == "advanced"){
    echo $this->partial('items/search-form.php', array('formAttributes' =>
                        array('id'=>'advanced-search-form')));
}?>

<?php echo foot(); ?>
