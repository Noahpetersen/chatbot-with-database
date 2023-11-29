
document.querySelector("#user-message-form").addEventListener("submit", function (e) {
    e.preventDefault();
    const userInput = document.querySelector("#user-message-input");
    const userInputValue = userInput.value.toLowerCase();
    const mail = document.querySelector("#user_mail").value;
    const chatId = document.querySelector("#chat_id").value;
    const messageContainer = document.querySelector(".text-box");

    fetch("../API/chat.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            user_email: mail, 
            chatId: chatId,
            message: userInputValue 
        })
    })
        .then((r) => {
            const loadingHTML = `
                <article class="bot --loading">
                    <section class="chat-message">
                        <div class="loading">
                            <span class="loading-item"></span>
                            <span class="loading-item"></span>
                            <span class="loading-item"></span>
                        </div>
                    </section>
                  
                </article>
            `;
            const user = `
                <article class="user">
                    <section class="user-text">
                        ${userInputValue}
                    </section>
                    <p class="chat-user">You</p>
                </article>
            `;
            messageContainer.innerHTML += user;
            messageContainer.innerHTML += loadingHTML;
            return r.json();
        })
        .then((r) => {
            const bot = `
            <article class="chat-message-container bot">
                <section class="bot-text">
                    ${r}
                </section>
                <p class="chat-user">Chatbot</p>
            </article>
            `;
            
            messageContainer.innerHTML += bot;
            
            userInput.value = ''; 
        })
        .finally(() => {
            const chatbox = document.querySelector(".text-box");
            chatbox.scrollTop = chatbox.scrollHeight;
        });
});
