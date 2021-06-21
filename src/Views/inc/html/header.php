<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/Resources/css/style.css">

    <link rel="stylesheet" href="/src/Resources/utility/bootstrap/css/bootstrap.min.css">
    <script src="/src/Resources/utility/bootstrap/js/bootstrap.min.js"></script>

    <script src="/src/Resources/js/jquery-3.6.0.js"></script>
    <title><?php if (isset($title)) { echo $title; echo " - ";}?> Portfolio</title>
    <?php if(!isset($selectedHref)) { $selectedHref = ""; } ?>
</head>

<body>
    <nav class="navbar header navbar-expand-lg" role="navigation">

        <div class="container-fluid">

            <div class="navbar-brand">
                Portfolio website
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header_bar" aria-controls="header_bar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

            <div class="collapse navbar-collapse" id="header_bar">

                <ul class="navbar-nav me-auto">

                    <li class="nav-item header_item">
                        <a <?php if ($selectedHref == "/Projects") { echo "class='header_item_link nav-link header_item_active'"; } 
                                    else { echo "class='header_item_link nav-link'"; } ?> 
                            href="/Projects">

                            Projects

                        </a>
                    </li>

                    <li class="nav-item header_item">
                        <a <?php if ($selectedHref == "/Admin/Projects") { echo "class='header_item_link nav-link header_item_active'"; } 
                                    else { echo "class='header_item_link nav-link'"; } ?> 
                            href="/Admin/Projects">
                        
                            Admin

                        </a>
                    </li>

                </ul>

            </div>


        </div>


    </nav>