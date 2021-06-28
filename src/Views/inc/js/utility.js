function GetLineNumber(Element)
{
    var lineNo = Element.value.substr(0, Element.selectionStart).split(/\r?\n|\r/).length;
    var lineText = Element.value.split(/\r?\n|\r/)[lineNo - 1];
    var numOfSpaces = lineText.split(/\s/).length - 1;
    console.log(lineNo, lineText, numOfSpaces);
}

function displayLoadedImage(ImageLoadedEvent)
{
    var Target = ImageLoadedEvent.target;
    var TargetParent = Target.parentNode;
	var imagechildren = $(TargetParent).find("img");

    var image = null;


    for (let index = 0; index < imagechildren.length; index++) {
        image = imagechildren[index];
        break;
    }

    if (image) {
        image.hidden = false;
        image.src = URL.createObjectURL(Target.files[0]);
    }
};