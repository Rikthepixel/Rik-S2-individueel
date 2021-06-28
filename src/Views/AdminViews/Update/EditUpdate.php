<?php
$title = "Edit update";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/inc/html/header.php";
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
            <div class="CustomCheck">
                <input type="checkbox" value="None" id="CustomCheck" name="Visible" <?php if ($Update->visible) { echo "checked"; } ?>/>
                <label for="CustomCheck"></label>
            </div>
        </div>

        <div class="edit_item_wrapper edit_form_submit edit_form_submit_wrapper edit_page_bottom_buttons">
            <input class="edit_item_value submit_button submit_button_dark edit_form_sumbit_button" type="submit" value="Save changes">

            <div class="delete_button edit_page_delete_button">
                <a class="hreflink horizontal_Center vertical_Center" href=<?= "/admin/projects/deleteupdate?id=".$Update->id."&project_id=".$Update->project_id ?>>Delete</a>
            </div>
        </div>

        <input type="hidden" name="project_id", Value=<?= $Update->project_id ?>>
        <input type="hidden" name="id", Value=<?= $Update->id ?>>
    </form>

    <script src="/src/Views/inc/js/utility.js"></script>
<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/inc/html/footer.html";
?>