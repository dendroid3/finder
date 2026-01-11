<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="<?= 'resources/layouts/3/css/styles.css' ?>" />
  <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet" />

  <meta name="template" content="3">
  <link rel="stylesheet" href="resources/templates/3/css/styles.css" />

  <?php
  if (isset($_SESSION['user_id'])) {
    ?>
    <title>Admin</title>
    <style>
      .logged-in {
        display: block;
      }
    </style>`; <?php
  } ?>

  <style>
    .radio-group {
      display: flex;
      gap: 1rem;
      align-items: center;
    }

    .radio-group label {
      cursor: pointer;
      user-select: none;
    }

    .tini-tiny {
      font-size: 1.2rem;
    }
  </style>

</head>

<body>
  <main>
    <div class="views-counter logged-in" id="current_template_id"></div>

    <div class="link-and-template-selector logged-in">
      <div class="link-and-template-selector-link" id="portfolio_link" style="cursor: pointer;">
      </div>
      <div class="radio-group">
        <label>
          <input type="radio" name="rating" value="1"> <span class="tini-tiny">1</span>
        </label>

        <label>
          <input type="radio" name="rating" value="2"> <span class="tini-tiny">2</span>
        </label>

        <label>
          <input type="radio" name="rating" value="3"> <span class="tini-tiny">3</span>
        </label>

        <label>
          <input type="radio" name="rating" value="4"> <span class="tini-tiny">4</span>
        </label>

        <label>
          <input type="radio" name="rating" value="5"> <span class="tini-tiny">5</span>
        </label>

        <button style="cursor: pointer; padding: 0.25rem; border-radius: 5px;"
          onclick="updateTemplate()">change</button>
      </div>

    </div>

    <div>
      <form action="logout" method="post">
        <button class="logout-button-div logged-in" type="submit">Logout</button>
      </form>
    </div>

    <!-- Left side -->
    <section class="left-section">
      <div class="profile_image">
        <img src="resources/templates/3/profile_image.png" alt="Profile Image" />
      </div>
      <input type="file" id="profilePic" name="profilePic" accept="image/*" style="display: none" required />
      <button style="
            padding: 0.5rem 2rem;
            border-radius: 0.5rem;
            background-color: green;
            color: white;
            cursor: pointer;
          " class="logged-in" id="profileImageSelection">
        Change Profile Image
      </button>

      <div id="profile-section">
        <h1 id="name_text"></h1>
        <h4 id="title_text"></h4>
        <div class="logged-in">
          <div>
            <input type="text" style="width: 20rem; padding: 0.75rem;" id="title_input" placeholder="quick pitch">
          </div>
          <div>
            <button style="
            padding: 0.5rem 2rem;
            border-radius: 0.5rem;
            background-color: green;
            color: white;
            cursor: pointer;
          " id="update_title_button">
              Change
            </button>
          </div>
        </div>
        <!-- <h3>Something Else That Should Be In Bold</h3> -->
        <hr />

        <div>
          <table id="links_table">
          </table>
          <br />
          <div class="logged-in">
            <div class="input-div">
              <!-- <label for="gender">Platform:</label> -->
              <select name="gender" id="platforms_list" required style="height: 2.5rem">
              </select>
              <input type="text" id="username_text" style="
                  border-radius: 0.5rem;
                  height: 2.5rem;
                  padding-left: 0.5rem;
                " />
            </div>
            <button id="add_link_button" style="
                margin-top: 0.5rem;
                padding: 0.5rem 2rem;
                border-radius: 0.5rem;
                background-color: green;
                color: white;
                cursor: pointer;
              ">
              Add Links
            </button>
          </div>
          <hr />
        </div>
      </div>

      <nav>
        <ul>
          <li><a href="#about_me">About Me</a></li>
          <li><a href="#my_services">My Services</a></li>
          <li><a href="#my_references">My References</a></li>
          <li><a href="#contact_me">Contact Me</a></li>
        </ul>
      </nav>
    </section>

    <!-- Right side -->
    <section class="right-section">
      <div id="about_me">
        <h1>About Me</h1>
        <p id="about_paragraph">

        </p>
        <div class="logged-in">
          <textarea id="about_input" type="text"
            style="height: 10rem; width: 100%; border-radius: 0.5rem; padding: 0.75rem; resize: vertical;"></textarea>
          <button id="update_about_button" style="
                width: 100%;
                background-color: green;
                border-radius: 0.5rem;
                margin-top: 0.5rem;
                color: white;
                height: 2rem;
                cursor: pointer;
              ">
            Update About Me
          </button>
        </div>
      </div>

      <div id="my_services" class="mt">
        <h1>My Services</h1>
        <ul id="service_list" style="list-style: none;">

        </ul>
        <div class="logged-in">
          <input type="text" style="
                width: 100%;
                border-radius: 0.5rem;
                height: 2.5rem;
                padding-left: 0.5rem;
                border-radius: 0.5rem;
                margin-bottom: 0.5rem;
                margin-top: 1rem;
              " id="service_title_text" placeholder="service title" />
          <textarea name="service-description" id="service_description_text"
            style="height: 10rem; width: 100%; border-radius: 0.5rem; padding: 0.75rem; margin-top: 0.5rem;"
            placeholder="text"></textarea>
          <button id="add_service_button" style="
                width: 100%;
                background-color: green;
                border-radius: 0.5rem;
                margin-top: 0.5rem;
                color: white;
                height: 2rem;
                cursor: pointer;
              ">
            Add Service
          </button>
        </div>
      </div>

      <div id="my_references" class="mt">
        <h1>My References</h1>
        <p>
          Couple of things people I've interacted with say about me
        </p>
        <ul class="reference-list" id="reference_list">

        </ul>
        <div class="logged-in">
          <input type="text" placeholder="referee name" name="" id="referee_name" style="
                width: 100%;
                border-radius: 0.5rem;
                height: 2.5rem;
                padding-left: 0.5rem;
                border-radius: 0.5rem;
                margin-bottom: 0.5rem;
              " />
          <textarea type="text" id="reference_description_text"
            style="height: 10rem; width: 100%; border-radius: 0.5rem; padding: 0.75rem;" placeholder="text"></textarea>
          <button id="add_reference_button" style="
                width: 100%;
                background-color: green;
                border-radius: 0.5rem;
                margin-top: 0.5rem;
                color: white;
                height: 2rem;
                cursor: pointer;
              ">
            Add Reference
          </button>
        </div>
      </div>

      <div id="contact_me" class="mt">
        <h1>Contact Me</h1>
        <p>Let’s connect! I’m open to your ideas, feedback, and support.</p>
        <ol>
          <li id="email"></li>
          <li id="phone_number"></li>
          <li id="whatsapp"></li>
        </ol>

        <div class="logged-in">
          <input type="text" placeholder="contact" name="" id="" style="
                width: 100%;
                border-radius: 0.5rem;
                height: 2.5rem;
                padding-left: 0.5rem;
                border-radius: 0.5rem;
                margin-top: 0.5rem;
              " />
          <button style="
                width: 100%;
                background-color: green;
                border-radius: 0.5rem;
                margin-top: 0.5rem;
                color: white;
                height: 2rem;
              ">
            Add Contact
          </button>
        </div>
      </div>

      <br /><br />
      <p style="text-align: center; font-size: 1.5rem">
        <strong>Something Else That Should Be In Bold</strong>
      </p>
    </section>
  </main>
  <script src="resources/templates/3/js/index.js"></script>
  <script src="resources/js/platforms.js"></script>
  <script src="resources/js/links.js"></script>
  <script src="resources/js/about.js"></script>
  <script src="resources/js/title.js"></script>
  <script src="resources/js/references.js"></script>
  <script src="resources/js/services.js"></script>
  <script>
    const pathParts = window.location.pathname.split("/").filter(Boolean);
    const user_code = pathParts[pathParts.length - 1];

    const portfolioUrl = `${window.location.protocol}//${window.location.host}/${user_code}`
    document.getElementById('portfolio_link').innerHTML = portfolioUrl


    document.getElementById('portfolio_link').addEventListener("click", function () {
      navigator.clipboard.writeText(portfolioUrl)
        .then(() => {
          alert("Copied to clipboard");
        })
        .catch(err => {
          console.error("Failed to copy:", err);
        });
    })

    function updateTemplate() {

      const selected = document.querySelector('input[name="rating"]:checked');

      if (!selected) {
        alert("Please select a template.");
        return;
      }

      if(!confirm(`You are about to change to template ${selected.value}.\nAre you sure about that?\nProceed?`)) return;
      const template_id = selected.value;
      const pathParts = window.location.pathname.split("/").filter(Boolean);
      const user_code = pathParts[pathParts.length - 1];

      fetch('/api/templates', {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          template_id: template_id,
          user_code: user_code
        })
      })
        .then(res => {
          if (!res.ok) throw new Error('Failed to update template');
          return res.json();
        })
        .then(data => {
          alert(`Template updated. Visitors to you portfolio will be seing template ${template_id}`);
          fetchTitle()
        })
        .catch(err => {
          console.error(err);
        });
    }



  </script>
</body>

</html>