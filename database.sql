-- MariaDB dump 10.19-11.2.2-MariaDB, for Linux (x86_64)
--
-- Host: 172.17.0.2    Database: db
-- ------------------------------------------------------
-- Server version	10.11.4-MariaDB-1~deb12u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

--
-- Table structure for table `email_addresses`
--

/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_addresses`
(
    `uuid`      uuid        NOT NULL,
    `user_uuid` uuid        NOT NULL,
    `email`     varchar(50) NOT NULL,
    PRIMARY KEY (`uuid`),
    KEY `user_uuid` (`user_uuid`),
    CONSTRAINT `email_addresses_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `users` (`uuid`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_addresses`
--

INSERT INTO `email_addresses`
VALUES ('d7b318c4-b70d-11ee-8754-0242ac110002', '7e893089-aefb-4265-8f06-16c186b19028', 'nejaky@email.com'),
       ('948ac4b7-b70c-11ee-ad01-0242ac110002', '266d9d61-400f-4cfd-aa33-cf736cf2a761', 'nejaky@email.com'),
       ('9a09d7e0-b70c-11ee-ad01-0242ac110002', '2dc99cb0-c953-4a70-9c05-730f8577116a', 'jan.novak@example.com'),
       ('9f67227d-b70c-11ee-ad01-0242ac110002', 'e349acab-179e-49b8-a25a-a22722ff21ba', 'veronika.hodna@example.com'),
       ('a50663b0-b70c-11ee-ad01-0242ac110002', 'c8f843f0-9a75-4562-b88c-b5c5578bb6f0', 'martin.zrucny@example.com'),
       ('b4859dc6-b70c-11ee-ad01-0242ac110002', '2153fa7d-cc37-424e-b7bc-1398a25b8f04', 'nejaky@email.com');

--
-- Table structure for table `tags`
--

/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags`
(
    `uuid` uuid        NOT NULL,
    `name` varchar(50) NOT NULL,
    PRIMARY KEY (`uuid`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags`
VALUES ('ee94a822-8dd4-4816-ab40-0d1c9cd3e228', 'Etika'),
       ('7ed7b528-da2f-4acc-a522-16cceaee16a8', 'Královská rodina'),
       ('929e9f30-44e7-4911-9730-2bae78f1b49d', 'Cestování'),
       ('553e0830-39b4-4e5d-956f-2c1eecd81d71', 'Osobní rozvoj'),
       ('2bccfd5b-994d-41fc-b490-45374bd771ec', 'Arch'),
       ('f2af0fb7-b9eb-4c15-b7a6-528b846f559a', 'Vzdělávání'),
       ('5be0dac9-debb-4962-95c6-5e2227cd6e3c', 'Psychologie'),
       ('c627ddef-b1d9-4721-baa1-5ea84d7cd75d', 'Náboženství'),
       ('ab68217c-b659-4955-a9dc-792a3dc293e6', 'Anime'),
       ('428a6b3d-d85c-4b6a-9c74-c736491acd03', 'Podnikání'),
       ('703482bc-94b1-4886-98de-c83ce9f1db91', 'Videohry'),
       ('84b33eee-2ee3-42ca-8d7d-d092bc49c008', 'Programování'),
       ('58d6f084-cdfe-4273-a301-dd99955f90d2', 'Komunikace'),
       ('0c32eaac-1f35-4ff3-9930-ebaea1b57f4a', 'Umění'),
       ('4e8ba07a-cf9d-4f41-94ac-faf525f17108', 'Sport'),
       ('d3c7f243-074c-46e6-8deb-fc1e665a8421', 'Management');

--
-- Table structure for table `telephone_numbers`
--

/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telephone_numbers`
(
    `uuid`      uuid        NOT NULL,
    `user_uuid` uuid        NOT NULL,
    `number`    varchar(50) NOT NULL,
    PRIMARY KEY (`uuid`),
    KEY `user_uuid` (`user_uuid`),
    CONSTRAINT `telephone_numbers_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `users` (`uuid`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telephone_numbers`
--

INSERT INTO `telephone_numbers`
VALUES ('d7b2d382-b70d-11ee-8754-0242ac110002', '7e893089-aefb-4265-8f06-16c186b19028', '+420 123 456 789'),
       ('948a9bb7-b70c-11ee-ad01-0242ac110002', '266d9d61-400f-4cfd-aa33-cf736cf2a761', '+420 123 456 789'),
       ('9a09b517-b70c-11ee-ad01-0242ac110002', '2dc99cb0-c953-4a70-9c05-730f8577116a', '+123 777 999 222'),
       ('9f6700f8-b70c-11ee-ad01-0242ac110002', 'e349acab-179e-49b8-a25a-a22722ff21ba', '+421 905 555 111'),
       ('a5064135-b70c-11ee-ad01-0242ac110002', 'c8f843f0-9a75-4562-b88c-b5c5578bb6f0', '+123 777 444 555'),
       ('b4857cd0-b70c-11ee-ad01-0242ac110002', '2153fa7d-cc37-424e-b7bc-1398a25b8f04', '+420 123 456 789');

--
-- Table structure for table `users`
--

/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users`
(
    `uuid`           uuid         NOT NULL,
    `username`       varchar(50)  NOT NULL,
    `password`       varchar(255) NOT NULL,
    `title_before`   varchar(50)  DEFAULT NULL,
    `first_name`     varchar(50)  NOT NULL,
    `middle_name`    varchar(50)  DEFAULT NULL,
    `last_name`      varchar(50)  NOT NULL,
    `title_after`    varchar(50)  DEFAULT NULL,
    `picture_url`    varchar(255) DEFAULT NULL,
    `location`       varchar(100) DEFAULT NULL,
    `claim`          text         DEFAULT NULL,
    `bio`            text         DEFAULT NULL,
    `price_per_hour` int(11)      DEFAULT NULL,
    PRIMARY KEY (`uuid`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

INSERT INTO `users`
VALUES ('2153fa7d-cc37-424e-b7bc-1398a25b8f04', 'kral_alz', 'a', 'Královna', 'Alžběta', 'Alexandra', 'Windsorská', '',
        'https://picsum.photos/200', 'Londýn', 'Královská rodina je nejlepší rodina.',
        'Jsem královna Velké Británie a Severního Irska. Mám ráda čaje, kočky a koruny. Mým koníčkem je sbírání umění a cestování.',
        1000),
       ('7e893089-aefb-4265-8f06-16c186b19028', 'kral_alz', 'a', '', 'Lukáš', '', 'Dihel', '',
        'https://picsum.photos/200', 'Ostrava',
        'Zítra je taky den.',
        'Jsem student <b>SPŠEI Ostrava</b>, kde studuji obor IT. Mám rád programování, ať už jde o backend nebo jiné oblasti. Ve volném čase si rád zahraji šachy nebo se ponořím do světa Zaklínače 3.',
        700),
       ('5f326643-19ab-4cea-b69b-556c8db1c476', '', 'kral_alz', 'a', 'Ježíš', '', 'Kristus', '',
        'https://picsum.photos/200',
        'Jeruzalém', '<b>Posel lásky a míru.</b>',
        'V mém učení se naučíš, jak z vody dělat víno a z kamarádovi holky tvou. Všechno je to o tom, jak se na věci díváš.',
        10000),
       ('2dc99cb0-c953-4a70-9c05-730f8577116a', 'kral_alz', 'a', 'Ing.', 'Jan', '', 'Novák', 'PhD',
        'https://picsum.photos/200', 'Praha',
        'Komunikace je klíčovým prvkem úspěchu.',
        '<i>Ing. Jan Krátký Novák, PhD</i>, je odborník na komunikaci a moderní řízení. Jeho lekce vám přinesou nejen teoretické znalosti, ale také praktické dovednosti v oblasti komunikace a managementu.',
        800),
       ('e349acab-179e-49b8-a25a-a22722ff21ba', 'kral_alz', 'a', 'Ing.', 'Veronika', 'Světlá', 'Hodná', 'PhD',
        'https://picsum.photos/200', 'Bratislava', 'Rozvoj dovedností vede k osobnímu úspěchu.',
        '<i>Ing. Veronika Světlá Hodná, PhD</i>, je lektorkou osobního rozvoje a psychologie. Pomáhá jednotlivcům objevit svůj potenciál a dosáhnout vyššího stupně osobního rozvoje.',
        850),
       ('c8f843f0-9a75-4562-b88c-b5c5578bb6f0', 'kral_alz', 'a', 'PhDr.', 'Martin', 'Karel', 'Zručný', 'MBA',
        'https://picsum.photos/200', 'Brno', 'Vzdělávání je klíčem k otevírání nových možností.',
        '<i>PhDr. Martin Pilný Zručný, MBA</i>, je váš průvodce světem vzdělávání a podnikání. S ním získáte nejen teoretické znalosti, ale i praktické dovednosti pro úspěšný rozvoj a růst.',
        780),
       ('266d9d61-400f-4cfd-aa33-cf736cf2a761', 'kral_alz', 'a', 'Prestižní', 'Tereza', '', 'Pavelková', '',
        'https://picsum.photos/200',
        'Ostrava', 'Dneska je taky den, aby ze mne byl Digitální Dement.',
        'Jsem studentka <b>SPŠEI Ostrava </b>, kde studuji obor IT. Nejradši tvořím věci užitečné pro lidi. Baví mě tvorba frontendu, ale backend mě nezastraší. Mimo jiné si ráda zasportuji, nebo zahraju jak deskovou hru, tak i videohru. Zbytek života trávím na Discordu.',
        720);

--
-- Table structure for table `users_tags`
--

/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_tags`
(
    `user_uuid` uuid NOT NULL,
    `tag_uuid`  uuid NOT NULL,
    PRIMARY KEY (`user_uuid`, `tag_uuid`),
    KEY `tag_uuid` (`tag_uuid`),
    CONSTRAINT `users_tags_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `users` (`uuid`),
    CONSTRAINT `users_tags_ibfk_2` FOREIGN KEY (`tag_uuid`) REFERENCES `tags` (`uuid`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_tags`
--

INSERT INTO `users_tags`
VALUES ('2153fa7d-cc37-424e-b7bc-1398a25b8f04', '7ed7b528-da2f-4acc-a522-16cceaee16a8'),
       ('2153fa7d-cc37-424e-b7bc-1398a25b8f04', '929e9f30-44e7-4911-9730-2bae78f1b49d'),
       ('2153fa7d-cc37-424e-b7bc-1398a25b8f04', '553e0830-39b4-4e5d-956f-2c1eecd81d71'),
       ('2153fa7d-cc37-424e-b7bc-1398a25b8f04', '0c32eaac-1f35-4ff3-9930-ebaea1b57f4a'),
       ('7e893089-aefb-4265-8f06-16c186b19028', '2bccfd5b-994d-41fc-b490-45374bd771ec'),
       ('7e893089-aefb-4265-8f06-16c186b19028', 'ab68217c-b659-4955-a9dc-792a3dc293e6'),
       ('7e893089-aefb-4265-8f06-16c186b19028', '703482bc-94b1-4886-98de-c83ce9f1db91'),
       ('7e893089-aefb-4265-8f06-16c186b19028', '84b33eee-2ee3-42ca-8d7d-d092bc49c008'),
       ('5f326643-19ab-4cea-b69b-556c8db1c476', 'ee94a822-8dd4-4816-ab40-0d1c9cd3e228'),
       ('5f326643-19ab-4cea-b69b-556c8db1c476', '929e9f30-44e7-4911-9730-2bae78f1b49d'),
       ('5f326643-19ab-4cea-b69b-556c8db1c476', '553e0830-39b4-4e5d-956f-2c1eecd81d71'),
       ('5f326643-19ab-4cea-b69b-556c8db1c476', 'c627ddef-b1d9-4721-baa1-5ea84d7cd75d'),
       ('5f326643-19ab-4cea-b69b-556c8db1c476', '428a6b3d-d85c-4b6a-9c74-c736491acd03'),
       ('2dc99cb0-c953-4a70-9c05-730f8577116a', '58d6f084-cdfe-4273-a301-dd99955f90d2'),
       ('2dc99cb0-c953-4a70-9c05-730f8577116a', 'd3c7f243-074c-46e6-8deb-fc1e665a8421'),
       ('e349acab-179e-49b8-a25a-a22722ff21ba', '553e0830-39b4-4e5d-956f-2c1eecd81d71'),
       ('e349acab-179e-49b8-a25a-a22722ff21ba', '5be0dac9-debb-4962-95c6-5e2227cd6e3c'),
       ('c8f843f0-9a75-4562-b88c-b5c5578bb6f0', '553e0830-39b4-4e5d-956f-2c1eecd81d71'),
       ('c8f843f0-9a75-4562-b88c-b5c5578bb6f0', 'f2af0fb7-b9eb-4c15-b7a6-528b846f559a'),
       ('c8f843f0-9a75-4562-b88c-b5c5578bb6f0', '428a6b3d-d85c-4b6a-9c74-c736491acd03'),
       ('266d9d61-400f-4cfd-aa33-cf736cf2a761', '929e9f30-44e7-4911-9730-2bae78f1b49d'),
       ('266d9d61-400f-4cfd-aa33-cf736cf2a761', 'ab68217c-b659-4955-a9dc-792a3dc293e6'),
       ('266d9d61-400f-4cfd-aa33-cf736cf2a761', '703482bc-94b1-4886-98de-c83ce9f1db91'),
       ('266d9d61-400f-4cfd-aa33-cf736cf2a761', '84b33eee-2ee3-42ca-8d7d-d092bc49c008'),
       ('266d9d61-400f-4cfd-aa33-cf736cf2a761', '4e8ba07a-cf9d-4f41-94ac-faf525f17108');

CREATE TABLE `reservations`
(
    `uuid`            uuid         NOT NULL,
    `user_uuid`       uuid         NOT NULL,
    `start_time`      datetime     NOT NULL,
    `end_time`        datetime     NOT NULL,
    `user_first_name` varchar(50)  NOT NULL,
    `user_last_name`  varchar(50)  NOT NULL,
    `user_email`      varchar(255) NOT NULL,
    `user_phone`      varchar(50)  NOT NULL,
    `location`        varchar(255) NOT NULL,
    `note`            text DEFAULT NULL,
    PRIMARY KEY (`uuid`),
    CONSTRAINT `reservations_fk0` FOREIGN KEY (`user_uuid`) REFERENCES `users` (`uuid`)
);

CREATE TABLE `reservation_tags`
(
    `reservation_uuid` uuid NOT NULL,
    `tag_uuid`         uuid NOT NULL,
    PRIMARY KEY (`reservation_uuid`, `tag_uuid`),
    CONSTRAINT `reservation_tags_fk0` FOREIGN KEY (`reservation_uuid`) REFERENCES `reservations` (`uuid`),
    CONSTRAINT `reservation_tags_fk1` FOREIGN KEY (`tag_uuid`) REFERENCES `tags` (`uuid`)
);


/*!40103 SET TIME_ZONE = @OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;

-- Dump completed on 2024-01-19 22:01:44
