<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel = "stylesheet" href = "signup.css">
</head>
<body>
    <main>
        <form class="signup">
            <h1 class="heading">Create new Account</h1>
            <div class="input-group">
                <label for="user-name" class="label">Name</label>
                <input type="text" class="input name" name="user-name"/>
            </div>
            <div class="input-group">
                <label for="email" class="label">Email</label>
                <input type="email" class="input email" name="email"/>
            </div>
            <div class="input-group">
                <label for="password" class="label">Password</label>
                <input type="password" class="input password" name="password"/>
            </div>
            <button class="signup-btn">Sign up</button>
        </form>
    </main>

    <script>
        const email = document.querySelector('.email');
        const password = document.querySelector('.password');
        const userName = document.querySelector('.name');
        const form = document.querySelector('.signup');
        const errormessageShown = false
        
        const getUserCredentials = (event) => {
            event.preventDefault();

            //Check if the user has entered valid credentials
            if(userName.value.trim() === '' || email.value.trim() === '' || password.value.trim() === '' && errormessageShown === false){
                //Error Message for empty input
                const errormessage = document.createElement('p');
                errormessage.textContent = 'Please enter valid credentials';
                password.parentNode.appendChild(errormessage);
                errormessageShown = true;
                return;
            } else {
                //Create a user object
                const user = {
                    userName: userName.value,
                    email: email.value,
                    password: password.value
                }
            
            //Send user credentials to the server
            fetch('api/User-Signup.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(user)
            })
            .then(res => {
                if(res.status === 201) {
                    window.location.href = 'index.php';
                } else if(res.status === 409) {
                    const errormessage = document.createElement('p');
                    errormessage.textContent = 'User already exists';
                    password.parentNode.appendChild(errormessage);
                }
            })
            }
        }

        //Trigger function when the form is submitted
        form.addEventListener('submit', getUserCredentials);

    </script>
</body>
</html>