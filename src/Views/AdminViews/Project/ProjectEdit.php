<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/inc/header.html";
?>

<form class="edit_form" action=<?= "/admin/projects/edit?id=".$project->id ?> method="post" enctype="multipart/form-data">
        <h1>
            Editing project: <?=  $project->id ?>
        </h1>
        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Name">Name:</label>
            <input class="edit_item edit_item_value" type="text" name="Name" Value=<?= $project->name ?> required>
        </div>

        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Description">Description:</label>
            <textarea class="edit_item edit_item_value edit_item_textarea" name="Description" required><?= $project->description ?></textarea>
        </div>

        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Link">Link:</label>
            <input class="edit_item edit_item_value" type="text" name="Link" Value=<?= $project->link ?>>
        </div>

        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Image">Image:</label>
            <input class="edit_item edit_item_value" type="file" name="Image">
        </div>

        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Visible" >Visible:</label>
            <input type="checkbox" name="Visible" <?php if ($project->visible) { echo "checked"; } ?>>
        </div>

        <input name="id" hidden type="text" Value=<?=$project->id?>>

        <div class="edit_item_wrapper edit_form_submit edit_form_submit_wrapper edit_page_bottom_buttons">
            <input class="edit_item_value submit_button edit_form_sumbit_button" type="submit" value="Save changes">

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
                    <a href=<?= "/admin/projects/editupdate?id=".$Update->id."&project_id=".$Update->project_id ?> class="update_info_item_value hreflink update_info_edit">Edit</a>
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

<script>
    var Headers = document.getElementsByClassName("update_info_header")
    var Descriptions = document.getElementsByClassName("update_description")
    for (let index = 0; index < Headers.length; index++) {
        const updateInfoHeader = Headers[index];
        updateInfoHeader.style.backgroundColor = "var(--mainColorSelected)"
    }

    for (let index = 0; index < Descriptions.length; index++) {
        const updateInfoDescription = Descriptions[index];

        updateInfoDescription.hidden = true
        updateInfoDescription.style.visibility = "hidden"
        updateInfoDescription.style.display = "none"
    }


    function ExpandUpdate(event) {
        var EventTarget = event.target

        var updateInfo = EventTarget.closest(".update_info")
        var updateInfoHeader = null;
        var updateInfoDescription = null;

        for (let index = 0; index < updateInfo.children.length; index++) {
            const element = updateInfo.children[index];
            if (element.className == "update_description") {
                updateInfoDescription = element
            } else if (element.className == "update_info_wrapper update_info_header") {
                updateInfoHeader = element
            }
        }

        if (updateInfoDescription && updateInfoHeader) {
            if (!updateInfoDescription.hidden) {
                updateInfoDescription.hidden = true
                updateInfoDescription.style.visibility = "hidden"
                updateInfoDescription.style.display = "none"

                updateInfoHeader.style.backgroundColor = "var(--mainColorSelected)"
            } else {
                updateInfoDescription.hidden = false
                updateInfoDescription.style.visibility = "visible"
                updateInfoDescription.style.display = ""

                updateInfoHeader.style.backgroundColor = null;
            }
        }
    }
</script>
<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/inc/footer.html";
?>