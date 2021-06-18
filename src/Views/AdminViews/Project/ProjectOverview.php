<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/inc/header.html";
?>
    <div class="admin_add_button_wrapper">
        <a class="submit_button admin_add_button" href="/admin/projects/add">
            <div>
                Add new project
            </div>
        </a>
    </div>
<div class="project_container">
    <?php foreach($Projects as $key=>$Project): ?>
    <div class="project">
        <a class='project_name' href=<?= '/admin/projects/project?id='.$Project['project_info']->id?>>
            <img src=<?= $Project["project_icon"] ?> class='project_image_medium' alt='project'>
        </a>

        <a class='project_name' href=<?= '/admin/projects/project?id='.$Project['project_info']->id ?>> <?= $Project["project_info"]->name ?> 
        </a>
    </div>
    <?php endforeach; ?>
</div>

<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/inc/footer.html";
?>