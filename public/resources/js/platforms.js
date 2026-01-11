const fetchPlatforms = function () {
  // Fetch the references data
  fetch("/api/platforms")
    .then((response) => {
      if (!response.ok) throw new Error("Network response was not ok");
      return response.json();
    })
    .then((data) => {
      const select = document.getElementById("platforms_list");

      // Clear existing content
      select.innerHTML = "";

      data.forEach((platform) => {
        const option = document.createElement("option");

        option.value = platform.id; // ✅ numeric ID
        option.textContent = platform.title; // ✅ visible label

        select.appendChild(option);
      });
    })
    .catch((error) => {
      console.error("Error fetching about info:", error);
    });
};

fetchPlatforms();
