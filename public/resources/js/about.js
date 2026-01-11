const fetchAbout = function () {
  // Get user_code from the URL (assumes it's the last part of the path)
  const pathParts = window.location.pathname.split("/").filter(Boolean);
  const user_code = pathParts[pathParts.length - 1];

  // Build the API URL dynamically using current protocol and host
  const apiUrl = `${window.location.protocol}//${window.location.host}/api/about?user_code=${user_code}`;

  // Fetch the about data
  fetch(apiUrl)
    .then((response) => {
      if (!response.ok) throw new Error("Network response was not ok");
      return response.json();
    })
    .then((data) => {
      // Put the about text into the paragraph
      const aboutElement = document.getElementById("about_paragraph");
      if (aboutElement) {
        aboutElement.innerHTML = data.about || "No about information found.";
      }
    })
    .catch((error) => {
      console.error("Error fetching about info:", error);
    });
};

const updateAbout = function () {
  // Get input value
  const about = document.getElementById("about_input").value;

  // Extract user_code from URL
  // Example URL: https://example.com/USER_CODE
  const pathParts = window.location.pathname.split("/").filter(Boolean);
  const user_code = pathParts[pathParts.length - 1];

  // Send PUT request
  fetch("/api/about", {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      about: about,
      user_code: user_code,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Failed to update about");
      }
      return response.json();
    })
    .then((data) => {
      alert("About Me Updated Succefully.");
      fetchAbout();
    })
    .catch((error) => {
      console.error("Error:", error);
    });
};

// Get the meta tag
const metaTemplateNumber = document.querySelector('meta[name="template"]');

// Read its content
const metaTemplateNumberContent = metaTemplateNumber ? metaTemplateNumber.getAttribute('content') : '';


if (metaTemplateNumberContent == 3) {
  const updateAboutButton = document.getElementById("update_about_button");

  updateAboutButton.addEventListener("click", updateAbout);
}
fetchAbout();
