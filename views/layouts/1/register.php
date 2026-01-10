<?php
// register.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finder</title>
    <link rel="stylesheet" href="<?php echo 'resources/layouts/1/css/styles.css'; ?>">
</head>
<body>
    <?php include __DIR__ . '/components/nav.php'; ?>
    
    <h1>User registration</h1>
    
    <div style="display: flex; justify-content: center; height: 105vh;">
        <form action="./register" method="POST" enctype="multipart/form-data">
            <div class="input-div">
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="input-div">
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="input-div">
                <input type="tel" id="phone_number" name="phone_number" pattern="[0-9]{10}" required>
            </div>
            
            <div class="input-div">
                <input type="password" id="password" name="password" minlength="8" required>
            </div>
            
            <div class="input-div">
                <input type="date" id="dob" name="dob" required>
            </div>
            
            <div class="input-div">
                <select id="gender" name="gender" required>
                    <option value="male">male</option>
                    <option value="female">female</option>
                    <option value="other">other</option>
                </select>
            </div>
            
            <input type="file" id="profilePic" name="profilePic" accept="image/*" required style="display: none;">
            
            <div id="profileImageSelection" style="height: 50px; border-radius: 10px; border: 1px solid black; cursor: pointer; display: flex; align-items: center; padding-left: 10px;">
                Select Profile Picture
            </div>
            
            <button type="submit" class="submit-button">Register</button>
            <button type="button" class="submit-button">Login</button>
        </form>
    </div>
    
    <footer>
        Contact us at info@email.com
    </footer>
    
    <script src="<?php echo 'resources/layouts/1/js/index.js'; ?>"></script>
</body>
</html>