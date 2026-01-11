const fetchServices = function () {
  // Get user_code from the URL (assumes it's the last part of the path)
  const pathParts = window.location.pathname.split("/").filter(Boolean);
  const user_code = pathParts[pathParts.length - 1];

  // Build the API URL dynamically using current protocol and host
  const apiUrl = `${window.location.protocol}//${window.location.host}/api/services?user_code=${user_code}`;

  // Fetch the services data
  fetch(apiUrl)
    .then((response) => {
      if (!response.ok) throw new Error("Network response was not ok");
      return response.json();
    })
    .then((data) => {
      // Get the meta tag
      const metaTemplateNumberServices = document.querySelector(
        'meta[name="template"]'
      );

      // Read its content
      const metaTemplateNumberContentServices = metaTemplateNumberServices
        ? metaTemplateNumberServices.getAttribute("content")
        : "";

      switch (Number(metaTemplateNumberContentServices)) {
        case 1:
          populateTemplate1Services(data);
          break;

        case 2:
          populateTemplate2Services(data);
          break;

        case 4:
          populateTemplate4Services(data);
          break;

        case 5:
          populateTemplate5Services(data);
          break;

        default:
          populateTemplate3Services(data);
          break;
      }
    })
    .catch((error) => {
      console.error("Error fetching about info:", error);
    });
};

// -----------------------------
// TEMPLATE 1
// -----------------------------
const populateTemplate1Services = function (data) {
  const container = document.querySelector(".services-grid");
  if (!container) return;

  // Clear existing services
  container.innerHTML = "";

  data.forEach((serv) => {
    const div = document.createElement("div");
    div.classList.add("service-card");

    div.innerHTML = `
      <h3>${serv.title}</h3>
      <p>${serv.description}</p>
    `;

    container.appendChild(div);
  });
};

// -----------------------------
// TEMPLATE 2
// -----------------------------
const populateTemplate2Services = function (data) {
  const container = document.querySelector(".services-grid");
  if (!container) return;

  container.innerHTML = "";

  data.forEach((serv) => {
    const div = document.createElement("div");
    div.classList.add("service-card");

    div.innerHTML = `
      <div class="service-icon">${serv.icon || "💻"}</div>
      <h3>${serv.title}</h3>
      <p>${serv.description}</p>
    `;

    container.appendChild(div);
  });
};

// -----------------------------
// TEMPLATE 3
// -----------------------------
const populateTemplate3Services = function (data) {
  const list = document.getElementById("service_list");
  if (!list) return;

  list.innerHTML = "";

  data.forEach((serv) => {
    const li = document.createElement("li");

    li.innerHTML = `
      <div class="service-div">
        <h2>${serv.title}</h2>
        <p>${serv.description}</p>
        <button 
          class="delete-service-button logged-in"
          style="cursor: pointer"
          data-id="${serv.id}"
        >
          delete
        </button>
      </div>
    `;

    list.appendChild(li);
  });
};

// -----------------------------
// TEMPLATE 4
// -----------------------------
const populateTemplate4Services = function (data) {
  const container = document.querySelector(".services-grid");
  if (!container) return;

  container.innerHTML = "";

  data.forEach((serv, index) => {
    const div = document.createElement("div");
    div.classList.add("service-box");

    div.innerHTML = `
      <div class="service-number">${String(index + 1).padStart(2, "0")}</div>
      <h3>${serv.title}</h3>
      <p>${serv.description}</p>
    `;

    container.appendChild(div);
  });
};

// -----------------------------
// TEMPLATE 5
// -----------------------------
const populateTemplate5Services = function (data) {
  const container = document.getElementById("my_services");
  if (!container) return;

  container.innerHTML = "";

  data.forEach((serv) => {
    const div = document.createElement("div");
    div.contentEditable = "true";

    div.innerHTML = `
      <strong>${serv.title}</strong>
      <p>${serv.description}</p>
    `;

    container.appendChild(div);
  });
};

const addService = function () {
  const title = document.getElementById("service_title_text").value;
  const description = document.getElementById("service_description_text").value;

  const pathParts = window.location.pathname.split("/").filter(Boolean);
  const user_code = pathParts[pathParts.length - 1];

  fetch("/api/services", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      title: title,
      description: description,
      user_code: user_code,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Failed to add service");
      }
      return response.json();
    })
    .then((data) => {
      alert("Addition successful:");
      fetchServices();
    })
    .catch((error) => {
      console.error("Error:", error);
    });
};

const deleteService = function (serviceId) {
  fetch("/api/services", {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      service_id: serviceId,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Failed to delete service");
      }
      return response.json();
    })
    .then((data) => {
      alert("Delete successful:");
      fetchServices();
    })
    .catch((error) => {
      console.error("Error:", error);
    });
};

// Get the meta tag
const metaTemplateNumberServices = document.querySelector(
  'meta[name="template"]'
);

// Read its content
const metaTemplateNumberContentServices = metaTemplateNumberServices
  ? metaTemplateNumberServices.getAttribute("content")
  : "";

if (metaTemplateNumberContentServices == 3) {
  document.addEventListener("click", function (e) {
    if (!e.target.classList.contains("delete-service-button")) return;

    const serviceId = e.target.dataset.id;

    deleteService(serviceId);
  });

  document
    .getElementById("add_service_button")
    .addEventListener("click", addService);
}
fetchServices();
