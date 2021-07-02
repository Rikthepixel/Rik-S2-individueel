<?php
$title = "Projects";
$selectedHref = "/Projects";

$ViewController->IncludeView("inc/html/header.php");
?>
<div class="project_container justify-content-center"> 

    <?php foreach($Projects as $key=>$Project): ?>

        <div class="project">
            <a class='project_name' href=<?= '/Project?id='.$Project['project_info']->id?>>
                <img class='icon_image' alt='project' src=<?= "'".$Project["project_icon"]."'"; ?>>
            </a>
            <a class='project_name' href=<?= '/Project?id='.$Project['project_info']->id ?>> <?= $Project["project_info"]->name ?>
            </a>
        </div>
        
    <?php endforeach ?>

</div>
<?php $ViewController->IncludeView("inc/html/footer.html");?>