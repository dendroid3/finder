const fetchReferences = function () {
  // Get user_code from the URL (assumes it's the last part of the path)
  const pathParts = window.location.pathname.split("/").filter(Boolean);
  const user_code = pathParts[pathParts.length - 1];

  // Build the API URL dynamically using current protocol and host
  const apiUrl = `${window.location.protocol}//${window.location.host}/api/references?user_code=${user_code}`;

  // Fetch the references data
  fetch(apiUrl)
    .then((response) => {
      if (!response.ok) throw new Error("Network response was not ok");
      return response.json();
    })
    .then((data) => {
      const metaTemplateNumberReferences = document.querySelector(
        'meta[name="template"]'
      );

      // Read its content
      const metaTemplateNumberContentReferences = metaTemplateNumberReferences
        ? metaTemplateNumberReferences.getAttribute("content")
        : "";

      switch (Number(metaTemplateNumberContentReferences)) {
        case 1:
          populateTemplate1References(data);
          break;

        case 2:
          populateTemplate2References(data);
          break;

        case 4:
          populateTemplate4References(data);
          break;

        case 5:
          populateTemplate5References(data);
          break;

        default:
          populateTemplate3References(data);
          break;
      }
    })
    .catch((error) => {
      console.error("Error fetching about info:", error);
    });
};

const populateTemplate1References = function (data) {
  const container = document.querySelector(".testimonials-grid");
  if (!container) return;

  container.innerHTML = "";

  data.forEach((ref) => {
    const div = document.createElement("div");
    div.classList.add("testimonial");

    div.innerHTML = `
      <div class="stars">★★★★★</div>
      <p>"${ref.description}"</p>
      <h4>${ref.referee}</h4>
    `;

    container.appendChild(div);
  });
};

const populateTemplate2References = function (data) {
  const container = document.querySelector(".testimonials-grid");
  if (!container) return;

  container.innerHTML = "";

  data.forEach((ref) => {
    const div = document.createElement("div");
    div.classList.add("testimonial-card");

    div.innerHTML = `
      <p>"${ref.description}"</p>
      <div class="testimonial-author">- ${ref.referee}</div>
    `;

    container.appendChild(div);
  });
};

const populateTemplate3References = function (data) {
  const list = document.getElementById("reference_list");
  if (!list) return;

  list.innerHTML = "";

  data.forEach((ref) => {
    const li = document.createElement("li");

    li.innerHTML = `
      <div class="reference-div">
        <p>${ref.description}</p>

        <p style="
            justify-content: end;
            position: relative;
            display: flex;
        ">
          - ${ref.referee}
        </p>

        <button 
            class="delete-button logged-in"
            data-id="${ref.id}"
        >
            delete
        </button>
      </div>
    `;

    list.appendChild(li);
  });
};

const populateTemplate4References = function (data) {
  const container = document.querySelector(".testimonials-grid");
  if (!container) return;

  container.innerHTML = "";

  data.forEach((ref) => {
    const initials = ref.referee
      ? ref.referee
          .split(" ")
          .map((n) => n[0])
          .join("")
          .toUpperCase()
      : "";

    const div = document.createElement("div");
    div.classList.add("testimonial-box");

    div.innerHTML = `
      <div class="quote-icon">"</div>
      <p class="testimonial-text">${ref.description}</p>

      <div class="testimonial-author">
        <div class="author-avatar">${initials}</div>
        <div class="author-info">
          <h4>${ref.referee}</h4>
        </div>
      </div>
    `;

    container.appendChild(div);
  });
};

const populateTemplate5References = function (data) {
  const container = document.getElementById('testimonials-grid');
  // alert(container)
  if (!container) return;

  container.innerHTML = "";

  data.forEach((ref) => {
    const div = document.createElement("div");
    // div.contentEditable = "true";

    div.innerHTML = `
      <p>"${ref.description}"</p>
      <small>- ${ref.referee}</small>
    `;

    container.appendChild(div);
  });
};

const addReference = function () {
  const referee = document.getElementById("referee_name").value;
  const description = document.getElementById(
    "reference_description_text"
  ).value;

  const pathParts = window.location.pathname.split("/").filter(Boolean);
  const user_code = pathParts[pathParts.length - 1];

  fetch("/api/references", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      referee: referee,
      description: description,
      user_code: user_code,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Failed to add reference");
      }
      return response.json();
    })
    .then((data) => {
      alert("Addition successful:");
      fetchReferences();
    })
    .catch((error) => {
      console.error("Error:", error);
    });
};

const deleteReference = function (referenceId) {
  fetch("/api/references", {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      reference_id: referenceId,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Failed to delete reference");
      }
      return response.json();
    })
    .then((data) => {
      alert("Delete successful:");
      fetchReferences();
    })
    .catch((error) => {
      console.error("Error:", error);
    });
};

// Get the meta tag
const metaTemplateNumberReferences = document.querySelector(
  'meta[name="template"]'
);

// Read its content
const metaTemplateNumberContentReferences = metaTemplateNumberReferences
  ? metaTemplateNumberReferences.getAttribute("content")
  : "";

if (metaTemplateNumberContentReferences == 3) {
  document.addEventListener("click", function (e) {
    if (!e.target.classList.contains("delete-button")) return;

    const referenceId = e.target.dataset.id;

    deleteReference(referenceId);
  });

  document
    .getElementById("add_reference_button")
    .addEventListener("click", addReference);
}
fetchReferences();
