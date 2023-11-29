const mail = document.querySelector("#user_mail").value;
const chatId = document.querySelector("#chat_id").value;
fetch("/API/getChatHistory.php", {
    method: "POST",
    body: JSON.stringify({
        user_email: mail,
        chatId: chatId
    })
}).then( e => e.json()).then(e => {
    console.log(e);

    const messageContainer = document.querySelector(".text-box");
    const userMessage = e.user_message.split(",");
    const botMessage = e.bot_response.split(",");

    userMessage.forEach( message => {
        const user = `
        <article class="user">
            <section class="user-text">
                ${message}
            </section>
            <p class="chat-user">You</p>
        </article>
        `;
        messageContainer.innerHTML += user;
    })

    botMessage.forEach( message => {
        const user = `
        <article class="chat-message-container bot">
            <section class="bot-text">
                ${message}
            </section>
            <p class="chat-user">Chatbot</p>
        </article>
        `;
        messageContainer.innerHTML += user;
    })

});