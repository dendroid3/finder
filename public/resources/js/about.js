// Get user_code from the URL (assumes it's the last part of the path)
const pathParts = window.location.pathname.split('/').filter(Boolean);
const user_code = pathParts[pathParts.length - 1];

// Build the API URL dynamically using current protocol and host
const apiUrl = `${window.location.protocol}//${window.location.host}/api/about?user_code=${user_code}`;

// Fetch the about data
fetch(apiUrl)
  .then(response => {
    if (!response.ok) throw new Error('Network response was not ok');
    return response.json();
  })
  .then(data => {
    // Put the about text into the paragraph
    const aboutElement = document.getElementById('about_paragraph');
    console.log(data.about)
    if (aboutElement) {
      aboutElement.innerHTML = data.about || 'No about information found.';
    }
  })
  .catch(error => {
    console.error('Error fetching about info:', error);
  });
