
document.addEventListener("DOMContentLoaded", () => {
  clickProfilePictureButton();
});


const clickProfilePictureButton = () => {
  const selectorDiv = document.getElementById("profileImageSelection");
  const fileInput = document.getElementById("profilePic");

  selectorDiv.addEventListener("click", () => {
    fileInput.click();
  });
}