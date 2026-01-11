const fetchLinks = function () {
  // Get user_code from the URL (assumes it's the last part of the path)
  const pathParts = window.location.pathname.split("/").filter(Boolean);
  const user_code = pathParts[pathParts.length - 1];

  // Build the API URL dynamically using current protocol and host
  const apiUrl = `${window.location.protocol}//${window.location.host}/api/links?user_code=${user_code}`;

  // Fetch the references data
  fetch(apiUrl)
    .then((response) => {
      if (!response.ok) throw new Error("Network response was not ok");
      return response.json();
    })
    .then((data) => {
      // Get the meta tag
      const metaTemplateNumberLinks = document.querySelector(
        'meta[name="template"]'
      );

      // Read its content
      const metaTemplateNumberContentLinks = metaTemplateNumberLinks
        ? metaTemplateNumberLinks.getAttribute("content")
        : "";

      switch (Number(metaTemplateNumberContentLinks)) {
        case 1:
          populateTemplate1(data);
          break;

        case 2:
          populateTemplate2(data);
          break;

        case 4:
          populateTemplate4(data);
          break;

        case 5:
          populateTemplate5(data);
          break;

        default:
          populateTemplate3(data);
          break;
      }
    })
    .catch((error) => {
      console.error("Error fetching about info:", error);
    });
};

const addLink = function () {
  const username = document.getElementById("username_text").value;
  const platform_id = document.getElementById("platforms_list").value;

  const pathParts = window.location.pathname.split("/").filter(Boolean);
  const user_code = pathParts[pathParts.length - 1];

  fetch("/api/links", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      username: username,
      platform_id: platform_id,
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
      fetchLinks();
    })
    .catch((error) => {
      console.error("Error:", error);
    });
};

const deleteLink = function (linkId) {
  fetch("/api/links", {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      link_id: linkId,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Failed to delete link");
      }
      return response.json();
    })
    .then((data) => {
      alert("Delete successful:");
      fetchLinks();
    })
    .catch((error) => {
      console.error("Error:", error);
    });
};

// Get the meta tag
const metaTemplateNumberLinks = document.querySelector('meta[name="template"]');

// Read its content
const metaTemplateNumberContentLinks = metaTemplateNumberLinks
  ? metaTemplateNumberLinks.getAttribute("content")
  : "";

if (metaTemplateNumberContentLinks == 3) {
  document.addEventListener("click", function (e) {
    if (!e.target.classList.contains("delete-link-button")) return;

    const linkId = e.target.dataset.id;

    deleteLink(linkId);
  });

  document.getElementById("add_link_button").addEventListener("click", addLink);
}

fetchLinks();

const populateTemplate1 = function (data) {
  const links_grid = document.getElementById("links_grid");

  // Clear existing content
  links_grid.innerHTML = "";

  data.forEach((link) => {
    const div = document.createElement("div");

    div.innerHTML = `
        <div class="link-card">
        <img src="${link.icon_url}" alt="Facebook" style="height: 4rem;"/>
          <h3><a href="#" target="_blank">${link.title}</a></h3>
          <a href="${link.url}/${link.username}" target="_blank">${link.username}</a>
        </div>
      `;

    links_grid.appendChild(div);
  });
};

const populateTemplate2 = function (data) {
  const links_grid = document.getElementById("links_grid");

  // Clear existing content
  links_grid.innerHTML = "";

  data.forEach((link) => {
    const div = document.createElement("div");

    div.innerHTML = `
        <div class="link-card">
          <h3>${link.title}</h3>
          <img style="height: 3rem; border-radius: 50%;" src=${link.icon_url} /><br>
          <a href="${link.url}/${link.username}" target="_blank">Visit Site →</a>
        </div>
      `;

    links_grid.appendChild(div);
  });
};

const populateTemplate3 = function (data) {
  const table = document.getElementById("links_table");

  // Clear existing content
  table.innerHTML = "";

  data.forEach((link) => {
    const tr = document.createElement("tr");

    tr.innerHTML = `
            <tr>
              <th>
                <a href="${link.url}/${link.username}" class="link-link" target="_blank">
                  <img src="${link.icon_url}" alt="Facebook" class="link-icon" />
                  <div>${link.url}/${link.username}
                </a>
                <button class="delete-link-button logged-in" style="cursor: pointer;" data-id=${link.id}>delete</button>
              </th>
            </tr>
      `;

    table.appendChild(tr);
  });
};
const populateTemplate4 = function (data) {
  const container = document.getElementById("links_container");

  // Clear existing content
  container.innerHTML = "";

  data.forEach((link) => {
    const div = document.createElement("div");

    div.innerHTML = `
          <div class="link-box">
              <img class="link-icon" style="height: 5rem;" src="${link.icon_url}"/>
              <h3>${link.title}</h3>
              <a href="${link.url}/${link.username}" target="_blank">View Profile</a>
          </div>
      `;

    container.appendChild(div);
  });
};
const populateTemplate5 = function (data) {
  const list = document.getElementById("links_list");

  // Clear existing content
  list.innerHTML = "";

  data.forEach((link) => {
    const li = document.createElement("li");

    li.innerHTML = `
        <li contenteditable="true">
          <a href="#" target="_blank" style="cursor: pointer;"> ${link.title}: ${link.url}/${link.username} </a>
        </li>
      `;

    list.appendChild(li);
  });
};
