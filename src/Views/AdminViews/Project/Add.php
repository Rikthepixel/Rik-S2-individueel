<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/inc/header.html";
?>

<form class="edit_form" action="/admin/projects/addnew" method="post" enctype="multipart/form-data">
        <h1>
            Add project
        </h1>
        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Name">Name:</label>
            <input class="edit_item edit_item_value" type="text" name="Name" required>
        </div>

        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Description">Description:</label>
            <textarea class="edit_item edit_item_value edit_item_textarea" name="Description" required></textarea>
        </div>

        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Link">Link:</label>
            <input class="edit_item edit_item_value" type="text" name="Link">
        </div>

        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Image">Image:</label>
            <input class="edit_item edit_item_value" type="file" name="Image">
        </div>

        <div class="edit_item_wrapper">
            <label class="edit_item_label" for="Visible">Visible:</label>
            <input type="checkbox" name="Visible" checked>
        </div>

        <div class="edit_item_wrapper edit_form_submit edit_form_submit_wrapper">
            <input class="edit_item_value submit_button edit_form_sumbit_button" type="submit" value="Add project">
        </div>

    </form>

<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/inc/footer.html";
?>