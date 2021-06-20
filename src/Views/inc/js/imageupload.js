function loadFile(event) {
    var Target = event.target;
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