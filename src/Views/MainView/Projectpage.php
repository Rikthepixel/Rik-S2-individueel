<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/inc/header.html";
?>


<div class="project_info">
    <div class="project_info_name_and_image">
        <h1 class="project_name_large">
            <?= $Project["project_info"]->name; ?>
        </h1>
        <img src=<?= $Project["project_icon"]; ?> alt="project_image" class="project_image_medium">
        <a class="project_link" href=<?= $Project["project_info"]->link; ?>> <?= $Project["project_info"]->link; ?> </a>
    </div>
    <div class="project_description"> <?= $Project["project_info"]->description; ?> </div>
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