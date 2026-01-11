const fetchTitle = function () {
  // Get user_code from the URL (assumes it's the last part of the path)
  const pathParts = window.location.pathname.split("/").filter(Boolean);
  const user_code = pathParts[pathParts.length - 1];

  // Build the API URL dynamically using current protocol and host
  const apiUrl = `${window.location.protocol}//${window.location.host}/api/title?user_code=${user_code}`;

  // Fetch the title data
  fetch(apiUrl)
    .then((response) => {
      if (!response.ok) throw new Error("Network response was not ok");
      return response.json();
    })
    .then((data) => {
      // Put the title text into the paragraph
      const titleElement = document.getElementById("title_text");
      if (titleElement) {
        titleElement.innerHTML = data.title || "Title Goes Here.";
      }

      const logoElement = document.getElementById("logo");
      if (logoElement) {
        logoElement.innerHTML = data.name || "Name Goes Here.";
      }

      const nameElement = document.getElementById("name_text");
      if (nameElement) {
        nameElement.innerHTML = data.name || "Name Goes Here.";
      }

      const imageElement = document.querySelector(".profile_image img");

      if (imageElement && data.profile_picture_url) {
        imageElement.src = `profile_pictures/${data.profile_picture_url}`; // ✅ update image
      }

      const templateIDElement = document.getElementById("current_template_id");

      if (templateIDElement) {
        templateIDElement.innerHTML = data.template_id;
      }

      const phoneElement = document.getElementById("phone_number");
      if (phoneElement) {
        phoneElement.innerHTML = `<a href="tel:+254${data.phone_number}">+254${data.phone_number}</a>`;
      }

      const emailElement = document.getElementById("email");
      if (emailElement) {
        emailElement.innerHTML = `<a href="mailto:${data.email}">${data.email}</a>`;
      }

      const whatsAppElement = document.getElementById("whatsapp");
      if (whatsAppElement) {
        whatsAppElement.innerHTML = `<a href="https://wa.me/+254${data.phone_number}" target="_blank">WhatsApp Me</a>`;
      }
    })
    .catch((error) => {
      console.error("Error fetching title info:", error);
    });
};

const updateTitle = function () {
  // Get input value
  const title = document.getElementById("title_input").value;

  // Extract user_code from URL
  // Example URL: https://example.com/USER_CODE
  const pathParts = window.location.pathname.split("/").filter(Boolean);
  const user_code = pathParts[pathParts.length - 1];

  // Send PUT request
  fetch("/api/title", {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      title: title,
      user_code: user_code,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Failed to update title");
      }
      return response.json();
    })
    .then((data) => {
      alert("Update successful:");
      fetchTitle();
    })
    .catch((error) => {
      console.error("Error:", error);
    });
};

// Get the meta tag
const metaTemplateNumberTitle = document.querySelector('meta[name="template"]');

// Read its content
const metaTemplateNumberContentTitle = metaTemplateNumberTitle
  ? metaTemplateNumberTitle.getAttribute("content")
  : "";

if (metaTemplateNumberContentTitle == 3) {
  const updateTitleButton = document.getElementById("update_title_button");

  updateTitleButton.addEventListener("click", updateTitle);
}
fetchTitle();
