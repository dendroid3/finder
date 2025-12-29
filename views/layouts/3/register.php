<?php
// register.php
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Finder</title>
    <link rel="stylesheet" href="<?= 'resources/layouts/3/css/styles.css' ?>" />
  </head>
  <body>    
    <?php include __DIR__ . '/components/nav.php'; ?>
    <main>
      <h1>User registration</h1>

      <div
        style="
          display: flex;
          justify-content: center;
          height: 105vh;
        "
      >
        <form action="./register" method="POST" enctype="multipart/form-data">
          
          <div class="input-div">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required />
          </div>

          <div class="input-div">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />
          </div>

          <div class="input-div">
            <label for="phone_number">Phone Number:</label>
            <input
              type="tel"
              id="phone_number"
              name="phone_number"
              pattern="[0-9]{10}"
              required
            />
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

          <div class="input-div">
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required />
          </div>

          <div class="input-div">
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>

          <div class="input-div">
            <label>Profile Picture:</label>

            <input
              type="file"
              id="profilePic"
              name="profilePic"
              accept="image/*"
              style="display: none"
              required
            />

            <div
              id="profileImageSelection"
              style="
                height: 3rem;
                border-radius: 0.5rem;
                border: black 0.1rem solid;
                cursor: pointer;
                display: flex;
                align-items: center;
                padding-left: 0.5rem;
              "
            >
              Select Profile Picture
            </div>
          </div>

          <button class="submit-button" type="submit">Register</button>
          <button class="submit-button" type="button">Login</button>
        </form>
      </div>
    </main>

    <footer>
      <p>Contact us at info@email.com</p>
    </footer>

    <script src="<?= 'resources/layouts/3/js/index.js' ?>"></script>
  </body>
</html>
