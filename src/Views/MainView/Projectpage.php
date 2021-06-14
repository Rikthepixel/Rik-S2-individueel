<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/inc/header.html";
?>


    <div class="project_info">
        <div class="project_info_name_and_image">
            <img src=<?= $Project["project_icon"]; ?> alt="project_image" class="project_image_medium">
            <div class="project_name_large">
                <?= $Project["project_info"]->name; ?>
            </div>
        </div>
        <div class="project_description">
            <?= $Project["project_info"]->description; ?>
        </div>
    </div>

    <div class="project_updates_wrapper project_updates_header">
        Updates: 
    </div>

    <div class="project_updates_wrapper">
        <div class="project_updates_container">
            <?php
                for ($i=0; $i < count($Project["project_updates"]); $i++) { 
                    $Update = $Project["project_updates"][$i];
                    
                    echo '<div class="update_info">';
                    echo '<div class="update_info_wrapper update_info_header" onclick="ExpandUpdate(event)">';
                    echo '<div class="update_info_wrapper update_info_item">';
                    echo '<label class="update_info_item_label">Name:</label>';
                    echo '<div class="update_info_item_value">'.$Update->name.'</div>';
                    echo "</div>";
                    echo '<div class="update_info_wrapper update_info_item">';
                    echo '<label class="update_info_item_label">Version:</label>';
                    echo '<div class="update_info_item_value">'.$Update->version.'</div>';
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='update_description'>".$Update->description."</div>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>

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


        function ExpandUpdate(event)
        {
            var EventTarget = event.target
            
            var updateInfo = EventTarget.closest(".update_info")
            var updateInfoHeader = null;
            var updateInfoDescription = null;

            for (let index = 0; index < updateInfo.children.length; index++) {
                const element = updateInfo.children[index];
                if (element.className == "update_description") {
                    updateInfoDescription = element
                }
                else if (element.className == "update_info_wrapper update_info_header") {
                    updateInfoHeader = element
                }
            }

            if (updateInfoDescription && updateInfoHeader) {
                if (!updateInfoDescription.hidden) {
                    updateInfoDescription.hidden = true
                    updateInfoDescription.style.visibility = "hidden"
                    updateInfoDescription.style.display = "none"

                    updateInfoHeader.style.backgroundColor = "var(--mainColorSelected)"
                }
                else {
                    updateInfoDescription.hidden = false
                    updateInfoDescription.style.visibility = "visible"
                    updateInfoDescription.style.display = "initial"

                    updateInfoHeader.style.backgroundColor = null;
                }
            }
        }
    </script>

<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/inc/footer.html";
?>