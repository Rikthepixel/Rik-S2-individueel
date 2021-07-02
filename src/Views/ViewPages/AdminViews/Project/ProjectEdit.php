<?php
$title = "Edit project";
$ViewController->IncludeView("inc/html/header.php");
?>

<form class="edit_form" action=<?= "/admin/projects/edit?id=".$project->id ?> method="post" enctype="multipart/form-data">
        <h1>
            Editing project: <?=  $project->id ?>
        </h1>
        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Name">Name:</label>
            <input class="edit_item edit_item_value" type="text" name="Name" Value=<?= "'".$project->name."'" ?> required>
        </div>

        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Description">Description:</label>
            <div class="edit_item_value edit_item">
                <textarea class="edit_item_textarea" name="Description" required><?= $project->description ?></textarea>
            </div>
        </div>

        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Link">Link:</label>
            <input class="edit_item edit_item_value" type="text" name="Link" Value=<?= $project->link ?>>
        </div>

        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Image">Image:</label>
            <img id="output" class="icon_image output_image" <?php if (isset($project_icon)) { echo("src='".$project_icon."'"); } else { echo("hidden"); }?>/>
            <input class="edit_item edit_item_value" accept="image/*" type="file" name="Image" onchange="ImageUtility.displayLoadedImage(event)">
        </div>

        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Visible" >Visible:</label>
            <div class="CustomCheck">
                <input type="checkbox" value="None" id="CustomCheck" name="Visible" <?php if ($project->visible) { echo "checked"; } ?>/>
                <label for="CustomCheck"></label>
            </div>
        </div>

        <input name="id" hidden type="text" Value=<?=$project->id?>>

        <div class="edit_item_wrapper edit_form_submit edit_form_submit_wrapper edit_page_bottom_buttons">
            <input class="edit_item_value submit_button_dark submit_button edit_form_sumbit_button" type="submit" value="Save changes">

            <div class="delete_button edit_page_delete_button">
                <a class="hreflink horizontal_Center vertical_Center" href=<?= "/admin/projects/delete?id=".$project->id ?>>Delete</a>
            </div>
        </div>

    </form>

    <div class="admin_add_button_wrapper">
        <a class="submit_button admin_add_button" href=<?= "/admin/projects/addupdate?project_id=".$project->id ?>>
            <div>
                Add new update
            </div>
        </a>
    </div>
<?php if (count($project_updates) > 0) : ?>
<h1 class="project_updates_wrapper project_updates_header"> Updates: </h1>

<div class="project_updates_wrapper">
    <div class="project_updates_container">
        <?php foreach($project_updates as $key=>$Update): ?>
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
                <div class="update_info_wrapper_left update_info_item">
                    <a href=<?= "/admin/projects/editupdate?id=".$Update->id."&project_id=".$Update->project_id ?> class="update_info_item_value hreflink submit_button_dark update_info_edit ">Edit</a>
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

<script src=<?= $ViewController->getRelativeIncludePath("inc/js/updateslist.js") ?>></script>
<?php $ViewController->IncludeView("inc/html/footer.html");?>