<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Finder</title>
    <link rel="stylesheet" href="./resources/css/styles.css" />
  </head>
  <body>  
    <link rel="stylesheet" href="<?= 'resources/layouts/3/css/styles.css' ?>" />
  <?php include __DIR__ . '/components/nav.php'; ?>
    <main>
      <h1>User login</h1>
      <div
        class=""
        style="
          background-color: ;
          display: flex;
          justify-content: center;
          height: 75vh;
        "
      >
        <form action="./submit" method="POST">
          <div class="input-div">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" title="email" required />
          </div>

          <div class="input-div">
            <label for="password">Password:</label>
            <input
              type="password"
              id="password"
              name="password"
              minlength="8"
              required
            />
          </div>

          <!-- </div> -->

          <button class="submit-button" type="submit">Login</button>
          <button class="submit-button">Register</button>
        </form>
      </div>
    </main>
    <footer>
      <p>Contact us at info@email.com</p>
    </footer>
    <script src="./index.js"></script>
  </body>
</html>
