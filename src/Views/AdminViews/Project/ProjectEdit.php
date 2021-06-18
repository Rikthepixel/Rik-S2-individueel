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

        <div class="edit_item_wrapper edit_form_submit edit_form_submit_wrapper">
            <input class="edit_item_value submit_button edit_form_sumbit_button" type="submit" value="Save changes">
        </div>

    </form>

<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/inc/footer.html";
?>