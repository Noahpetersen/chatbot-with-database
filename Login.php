<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel = "stylesheet" href = "login.css">
</head>
<body>
    <main>
        <form class="login">
            <h1 class="heading">Login</h1>
            <div class="input-group">
                <label for="email" class="label">Email</label>
                <input type="email" class="input email" name="email"/>
            </div>
            <div class="input-group">
                <label for="password" class="label">Password</label>
                <input type="password" class="input password" name="password"/>
            </div>
            <button class="login-btn">Login</button>
        </form>
    </main>

    <script>
        const email = document.querySelector('.email');
        const password = document.querySelector('.password');
        const form = document.querySelector('.login');
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
                email: email.value,
                password: password.value
            }
            
            //Send user credentials to the server
                fetch('api/User-Login.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(user)
                })
                .then(
                    res => {
                        if(res.status === 200) {
                            window.location.href = 'index.php';
                        } else {
                            const errormessage = document.createElement('p');
                            errormessage.textContent = 'Please enter valid credentials';
                            password.parentNode.appendChild(errormessage);
                            errormessageShown = true;
                        }
                    }
                )
            }
            
            form.addEventListener('submit', getUserCredentials);

        }
    </script>
</body>
</html>