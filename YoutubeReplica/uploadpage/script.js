function textChange() {
    let title = document.getElementById("titleField").value;
    let desc = document.getElementById("bioField").value;

    document.getElementById("topbar").innerHTML = "<h1>" + title + "</h1>";
    document.getElementById("titel").innerHTML = title;
    document.getElementById("desc").innerHTML = desc;
}

function onlyOne(checkbox) {
    var checkboxes = document.getElementsByName('tag')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })
}

function updateImage() {
  let videoTab = document.getElementById("videoTab");
  document.getElementById("thumbnailField").innerHTML = document.getElementById("thumbnailUpload").value;
  var file = document.getElementById('thumbnailUpload').files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
      videoTab.style.backgroundImage = "url('"+ reader.result +"')";
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}

function updateVideo() {
  document.getElementById("videoField").innerHTML = document.getElementById("videoUpload").value;
}
