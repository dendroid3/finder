// index.js

document.addEventListener('DOMContentLoaded', function() {
    clickProfilePictureButton();
});

const clickProfilePictureButton = () => {
    const profileImageSelection = document.getElementById('profileImageSelection');
    const fileInput = document.getElementById('profilePic');
    
    profileImageSelection.addEventListener('click', function() {
        fileInput.click();
    });
};