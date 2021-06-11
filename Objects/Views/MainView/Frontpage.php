<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/inc/header.html";
?>

<div class="project_container">
    <?php
        for ($i=0; $i < count($Projects); $i++) { 
            $Project = $Projects[$i];
            
            echo '<div class="project">';
            echo "<img src=".$Project["project_icon"]." class='project_image' alt='project'>";
            echo "<a class='project_name' href='/Project.php?id='".$Project['project_info']->id.">";
            echo $Project["project_info"]->name;
            echo "</a>";
            echo "</div>";
        }
    ?>
</div>

<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/inc/footer.html";
?>