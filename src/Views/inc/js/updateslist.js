var Headers = document.getElementsByClassName("update_info_header")
var Descriptions = document.getElementsByClassName("update_description")

for (let index = 0; index < Descriptions.length; index++) {
    const updateInfoDescription = Descriptions[index];

    updateInfoDescription.hidden = true
    updateInfoDescription.style.visibility = "hidden"
    updateInfoDescription.style.display = "none"
}


function ExpandUpdate(event) {
    let EventTarget = event.target

    let updateInfo = EventTarget.closest(".update_info")
    let updateInfoHeader = null;
    let updateInfoDescription = null;

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

            updateInfoHeader.style.backgroundColor = null;
        } else {
            updateInfoDescription.hidden = false
            updateInfoDescription.style.visibility = "visible"
            updateInfoDescription.style.display = ""

            updateInfoHeader.style.backgroundColor = "var(--mainColorSelected)";
        }
    }
}