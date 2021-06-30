    
    <?php
        $CurrentDirectory = str_replace($_SERVER['DOCUMENT_ROOT'], '',  str_replace('\\', '/', __DIR__));
        $ParentDirectory = dirname($CurrentDirectory);
    ?>
    
    <link rel="stylesheet" href=<?= $ParentDirectory."/css/style.css" ?>>
    <script src=<?= $ParentDirectory."/js/textStyler.js" ?>></script>

    <div class="textstyler_bar">
        <div class="textstyler_catagory">
            <button type="button" title="Bold" class="textstyler_item">
                <b>
                    B
                </b>
            </button>
            <button type="button" title="Italic" class="textstyler_item">
                <i>
                    I
                </i>
            </button>
            <button type="button" title="Underline" class="textstyler_item">
                <u>
                    U
                </u>
            </button>
            <button type="button" title="Strike" class="textstyler_item">
                <s>
                    S
                </s>
            </button>
            <button type="button" title="Mark" class="textstyler_item">
                <img src=<?= $ParentDirectory."/images/Mark.png" ?> alt="list">
            </button>
        </div>
        <div class="textstyler_catagory">
            <button type="button" title="List" class="textstyler_item">
                <img src=<?= $ParentDirectory."/images/clipboard.png" ?> alt="list">
            </button>
            <button type="button" title="List Item" class="textstyler_item">
                <img src=<?= $ParentDirectory."/images/ListItem.png" ?> alt="list">
            </button>
        </div>
        <div class="textstyler_catagory">
            <div class="textstyler_item textstyler_dropdown">
                <img title="Headers" src=<?= $ParentDirectory."/images/Headers.png" ?> alt="list">

                <div class="textstyler_dropdown_content">
                    <button type="button" title="Header 1" class="textstyler_item">
                        h1
                    </button>
                    <button type="button" title="Header 2" class="textstyler_item">
                        h2
                    </button>
                    <button type="button" title="Header 3" class="textstyler_item">
                        h3
                    </button>
                    <button type="button" title="Header 4" class="textstyler_item">
                        h4
                    </button>
                    <button type="button" title="Header 5" class="textstyler_item">
                        h5
                    </button>
                </div>
            </div>
        </div>

        <div class="textstyler_catagory">
            <button type="button" title="Upload Image" class="textstyler_item" onclick="">
                <div class="textstyler_popup" style="display:none;">
                    <input accept="image/*" type="file" name="Images">

                    <div >
                        <input type="button" value="Cancel" onclick="textStyler.CloseImageUpload(event)">
                        <input type="button" value="Cancel" onclick="textStyler.CloseImageUpload(event)">
                    </div>
                    
                </div>

                
                <img src=<?= $ParentDirectory."/images/Imageupload.png" ?> alt="list">
            </button>

        </div>
    </div>