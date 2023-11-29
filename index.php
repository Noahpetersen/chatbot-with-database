<?php
session_start();
include("db.php");

$botname = "Chatbot 0.1 alpha";
$chatId = rand();

if(!isset($_GET["chatId"])) {
    header("Location: ?chatId=$chatId");
    exit();
}else{
    $chatId = $_GET["chatId"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="apple-touch-icon" sizes="57x57" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="https://www.intastellarsolutions.com/assets/icons/fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://www.intastellarsolutions.com/assets/icons/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="https://www.intastellarsolutions.com/assets/icons/fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://www.intastellarsolutions.com/assets/icons/fav/favicon-16x16.png">
</head>

<body class="container">
    <header>
        <section class="header">
            <div>
                <h1>Chat-bot 2.0</h1>
            </div>
            <div class="burger-menu">
                <div class="burger-icon" id="burger-icon">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
            </div>
        </section>
    </header>

    <main>
        <section class="side-bar">
            <article>
                <div class="chat-history">
                    <div class="chat">
                        <h2>History</h2>
                        <h3 class="month">Today</h3>


                        <div class="chat-line"> <span class="material-symbols-outlined chat-bubble">
                                mode_comment
                            </span>
                            <p>hello how are you</p>
                        </div>
                        <h3 class="month">Yesterday</h3>
                        <div class="chat-line"> <span class="material-symbols-outlined chat-bubble">
                                mode_comment
                            </span>
                            <p>hello how are you</p>
                        </div>
                        <h3 class="month">2 days ago</h3>
                        <div class="chat-line"> <span class="material-symbols-outlined chat-bubble">
                                mode_comment
                            </span>
                            <p>hello how are you</p>
                        </div>
                        <h3 class="month">1 week ago</h3>
                        <div class="chat-line"> <span class="material-symbols-outlined chat-bubble">
                                mode_comment
                            </span>
                            <p>hello how are you</p>
                        </div>


                    </div>
                </div>
            </article>
            <article>
                <div class="extras">
                    <div class="logout">
                        <span class="material-symbols-outlined">
                            logout
                        </span>
                        <button>Log out</button>

                    </div>
                    <div class="Upgrade">
                        <span class="material-symbols-outlined">
                            card_membership
                        </span>
                        <button>Upgrade to plus</button>
                    </div>
                    <div class="dark-mode">
                        <span class="material-symbols-outlined">
                            dark_mode
                        </span>
                        <button id="dark-mode-toggle">Dark mode - (coming soon )</button>
                    </div>
                </div>
            </article>
            <article>
                <div class="new-chat">
                    <button><span>+</span> New chat</button>
                </div>
            </article>
        </section>
        <section class="chat-container">
            <article>
                <div class="text-box">
                    <div class="user">
                        <div class="user-text">
                            <p>hell</p>
                        </div>
                        <span class="material-symbols-outlined person">
                            person
                        </span>
                    </div>
                    <div class="bot">
                        <div class="bot-text">
                            <p>hello</p>
                        </div>

                    </div>
                </div>

            </article>
        </section>
        <section class="chat-input">
            <form id="user-message-form" method="POST" action="">
                <input class="send" type="text" id="user-message-input" name="user_input" value="" placeholder="What are you thinking?" maxlength="100" />
                <input type="hidden" id="user_mail" value="<?php echo $_SESSION["email"];?>">
                <input type="hidden" id="chat_id" value="<?php echo $chatId;?>">
                <input class="submit" type="submit" value="Send" />
            </form>
        </section>
    </main>
    <script src="/js/getChats.js"></script>
    <script src="/js/submitChat.js"></script>
</body>

</html>