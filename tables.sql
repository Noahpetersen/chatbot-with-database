
CREATE TABLE Chats (
    chat_id INT PRIMARY KEY,
    email VARCHAR(250) NOT NULL,
    FOREIGN KEY (email) REFERENCES Users(email)
);

ALTER TABLE Chats
ADD COLUMN created_at DATETIME;




CREATE TABLE Answers (
    answer_id INT PRIMARY KEY,
    chat_id INT NOT NULL,
    FOREIGN KEY (chat_id) REFERENCES Chats(chat_id),
    bot_respons VARCHAR(250),
    user_message VARCHAR(250)
);

ALTER TABLE Answers
DROP PRIMARY KEY;

ALTER TABLE Answers
MODIFY COLUMN answer_id INT AUTO_INCREMENT;

ALTER TABLE Answers
ADD PRIMARY KEY (answer_id);


CREATE TABLE Users (
    email VARCHAR(250) PRIMARY KEY,
    password VARCHAR(250) NOT NULL,
    user_name VARCHAR(250) NOT NULL
)
