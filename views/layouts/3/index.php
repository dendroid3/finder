<?php

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Match routes starting with @
if (str_starts_with($uri, '@')) {
  $username = substr($uri, 1);

  // Simple validation
  if ($username !== '') {
    // echo "Profile page for: " . htmlspecialchars($username);

  }
} else {

  // Fallback route
  // echo "404 Not Found";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Finder</title>
  <link rel="stylesheet" href="<?= 'resources/layouts/3/css/styles.css' ?>" />

  <style>
    h1,
    h2 {
      color: #333;
    }

    .step {
      margin-bottom: 1.5rem;
      padding: 1rem;
      border-left: 4px solid #007bff;
      background-color: #f9f9f9;
    }

    ul {
      margin-top: 0.5rem;
    }
  </style>
</head>

<body>

  <?php include __DIR__ . '/components/nav.php'; ?>

  <main style="margin-left: 15rem; margin-right: 15rem">
    <section>
      <article>
        <h2>About Our Project</h2>
        <p>
          Our class project is a portfolio builder application designed to
          help users create professional, visually appealing portfolios with
          ease. The platform features five unique templates, each designed
          and contributed by a different group member, ensuring diversity in
          layout, style, and user experience. This collaborative approach
          allows users to choose a template that best matches their
          personality, career goals, and industry requirements. The portfolio
          builder focuses on simplicity, flexibility, and accessibility.
          Users can easily input their personal information, skills, projects,
          education, and contact details through a guided interface, and
          instantly see their content reflected in the selected template. Each
          template is fully customizable, allowing adjustments to colors,
          sections, and content order without requiring technical knowledge.
          The system is intended for students, creatives, and early-career
          professionals who need a fast and effective way to showcase their
          work online. By offering multiple templates within a single
          platform, the project demonstrates teamwork, design variation, and
          practical application of web development concepts such as responsive
          design, modular components, and user-centered design. Overall, the
          portfolio builder highlights how collaborative development can
          produce a flexible tool that meets diverse user needs while
          maintaining a consistent and professional standard.
        </p>
      </article>
    </section>
    <aside>
      <h2>Templates</h2>
      <div class="image-grid">
        <a href="./templates/1/index.html">
          <img src="./resources/previews/1.png" alt="Template 1" />
        </a>
        <a href="./portfolio2/index.html">
          <img src="./resources/previews/2.png" alt="Template 2" />
        </a>
        <a href="./templates/3/index.html">
          <img src="./resources/previews/3.png" alt="Template 3" />
        </a>
        <a href="./portfolio4/index.html">
          <img src="./resources/previews/4.png" alt="Template 4" />
        </a>
        <a href="./portfolio5/index.html">
          <img src="./resources/previews/5.png" alt="Template 5" />
        </a>
      </div>
    </aside>
    <section>
      <h1>How to Use the Portfolio Builder</h1>
      <p>
        The portfolio builder allows you to create a professional online
        portfolio quickly and easily using one of our pre-designed templates.
      </p>

      <div class="step">
        <h2>Step 1: Choose a Template</h2>
        <p>
          Browse through the available portfolio templates and select the one
          that best suits your style and career goals. Each template offers a
          unique layout and design.
        </p>
      </div>

      <div class="step">
        <h2>Step 2: Enter Your Details</h2>
        <p>
          Fill in your personal information using the provided form fields.
          This includes:
        </p>
        <ul>
          <li>Your name and profile image</li>
          <li>About section or biography</li>
          <li>Skills and competencies</li>
          <li>Projects or work experience</li>
          <li>Contact information</li>
        </ul>
      </div>

      <div class="step">
        <h2>Step 3: Preview Your Portfolio</h2>
        <p>
          As you enter your information, your portfolio updates automatically.
          Review how your content looks in the selected template and make
          adjustments if necessary.
        </p>
      </div>

      <div class="step">
        <h2>Step 4: Save or Use</h2>
        <p>
          Once you are satisfied with your portfolio, save your work or export
          it for sharing online as part of job applications, internships, or
          academic submissions.
        </p>
      </div>

      <p>
        With just a few steps, you can create a polished portfolio that
        showcases your skills, projects, and achievements effectively.
      </p>
    </section>
  </main>
  <footer>
    <p>Contact us at info@email.com</p>
  </footer>
</body>

</html>