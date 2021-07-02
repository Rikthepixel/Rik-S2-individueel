<?php
$title = "Admin projects";
$selectedHref = "/Admin/Projects";
$ViewController->IncludeView("inc/html/header.php");
?>
    <div class="admin_add_button_wrapper">
        <a class="submit_button admin_add_button" href="/admin/projects/add">
            <div>
                Add new project
            </div>
        </a>
    </div>

    <div class="project_container justify-content-center">
        <?php foreach($Projects as $key=>$Project): ?>

            <div class="project">
                <a class='project_name' href=<?= '/admin/projects/project?id='.$Project['project_info']->id?>>
                    <img class='icon_image' alt='project' src=<?= "'".$Project["project_icon"]."'"; ?>>
                </a>
                <a class='project_name' href=<?= '/admin/projects/project?id='.$Project['project_info']->id?>> <?= $Project["project_info"]->name ?>
                </a>
            </div>
            
        <?php endforeach; ?>
    </div>

    <?php $ViewController->IncludeView("inc/html/footer.html");?>