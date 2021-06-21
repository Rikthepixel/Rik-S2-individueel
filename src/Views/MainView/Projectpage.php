<?php
$title = $Project["project_info"]->name;
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/inc/html/header.php";
?>

<div class="container project-info">
    <div class="row text-center">
        <h1 class="project_name_large"><?= $Project["project_info"]->name; ?></h1>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="d-flex flex-wrap justify-content-center text-center">
                <img alt="project icon" class="icon_image" src=<?= "'".$Project["project_icon"]."'"; ?>>
                <label class="project_link_label" for="link">Link:</label>
                <a class="project_link" href=<?= $Project["project_info"]->link; ?>> <?= $Project["project_info"]->link; ?> </a>
            </div>
        </div>
        <div class="col">
            <div class="project_description_col">
                <div class="project_description"><?= $Project["project_info"]->description ?></div>
            </div>
        </div>
    </div>
</div>

<?php if (count($Project["project_updates"]) > 0) : ?>
<h1 class="project_updates_wrapper project_updates_header"> Updates: </h1>

<div class="project_updates_wrapper">
    <div class="project_updates_container">
        <?php foreach($Project["project_updates"] as $key=>$Update): ?>
        <div class="update_info">
            <div class="update_info_wrapper update_info_header" onclick="ExpandUpdate(event)">
                <div class="update_info_wrapper_left update_info_item">
                    <label class="update_info_item_label">Name:</label>
                    <div class="update_info_item_value"> <?= $Update->name ?> </div>
                </div>
                <div class="update_info_wrapper_left update_info_item">
                    <label class="update_info_item_label">Version:</label>
                    <div class="update_info_item_value"><?= $Update->version ?></div>
                </div>
            </div>

            <div class='update_description'>
                <div class='update_description_label'>Description: </div>
                <div class='update_description_value'><?= $Update->description ?></div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>

<?php endif ?>

<script src="/src/Views/inc/js/updateslist.js"></script>
<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/inc/html/footer.html";
?>