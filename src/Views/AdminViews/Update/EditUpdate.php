<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/inc/header.html";
?>

<form class="edit_form" action=<?= "/admin/projects/updateedit?project_id=".$Update->project_id ?>  method="post" enctype="multipart/form-data">
        <h1>
            Edit update of project: <?= $Project->name ?>
        </h1>
        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Name">Name:</label>
            <input class="edit_item edit_item_value" type="text" name="Name" required Value=<?= $Update->name ?>>
        </div>

        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Description">Description:</label>
            <textarea class="edit_item edit_item_value edit_item_textarea" name="Description" required> <?= $Update->description ?></textarea>
        </div>

        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Link">Version:</label>
            <input class="edit_item edit_item_value" type="text" name="Version" Value=<?= $Update->version ?>>
        </div>

        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Visible">Visible:</label>
            <input type="checkbox" name="Visible" <?php if ($Update->visible) { echo "checked"; } ?>>
        </div>

        <div class="edit_item_wrapper edit_form_submit edit_form_submit_wrapper">
            <input class="edit_item_value submit_button edit_form_sumbit_button" type="submit" value="Add update">
        </div>

        <input type="hidden" name="project_id", Value=<?= $Update->project_id ?>>
        <input type="hidden" name="id", Value=<?= $Update->id ?>>
    </form>

<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/inc/footer.html";
?>