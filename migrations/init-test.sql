CREATE DATABASE snet_test;

\c snet_test

CREATE TABLE if not exists users (
                       user_id UUID PRIMARY KEY NOT NULL,
                       first_name VARCHAR(255) NOT NULL,
                       second_name VARCHAR(255) NOT NULL,
                       birthdate DATE NOT NULL,
                       biography TEXT,
                       city VARCHAR(255) NOT NULL,
                       password VARCHAR(255) NOT NULL
);

INSERT into users (user_id, first_name, second_name, birthdate, biography, city, password) VALUES
    ('01907e60-8a09-75a2-b001-3a040801f6e4','Михаил','Иванов','1990-05-14','Люблю программировать, заниматься спортом и читать книги.','Москва','$2y$10$fgwhAnEJUR51v0JtElgjleLXU0pdxaRZ7oQ2IemShpwfJGOWxqdeC'),
    ('01907e61-0ced-7d0b-8080-0d6512cb1571','Анна','Смирнова','1988-11-22','Интересуюсь искусством, фотографией и путешествиями.','Санкт-Петербург','$2y$10$h6Jm6T8rrJAIebLPQfHcCOAHpdahClf8s2oMtujWvtycZOy7XMWo2'),
    ('01907e61-44f4-787a-a982-6f56bc1792d3','Дмитрий','Кузнецов','1992-07-10','Работаю в IT-сфере, увлекаюсь киберспортом и настольными играми.','Новосибирск','$2y$10$PS/UwizDe.elhZmlba325uK5BXekTRYaKRpQkVLEI5tU6bpBMUQLy'),
    ('01907e61-8c27-7427-af57-36a8ca842b51','Екатерина','Петрова','1995-03-05','Люблю танцевать, слушать музыку и проводить время с друзьями.','Екатеринбург','$2y$10$wfZufzAMo1R19XjUPgg3LOslDwtCq/XB4NwJN/pL6L9QCd6gboKmG'),
    ('01907e61-c4f0-78dd-9558-2e4e96abc226','Алексей','Соколов','1985-09-17','Интересуюсь историей, играю в шахматы и занимаюсь йогой.','Казань','$2y$10$TUbCgoSHDTTZ6OAqhY7XeOzROnUv.Blzu/dfN7vENioWGPtv2k3Uq');
