--
-- Скрипт сгенерирован Devart dbForge Studio 2020 for MySQL, Версия 9.0.470.0
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 24.03.2021 21:05:52
-- Версия сервера: 8.0.18
-- Версия клиента: 4.1
--


SET NAMES 'compatibility';

INSERT INTO amastytest.cities(id, name) VALUES
(1, 'Minsk'),
(2, 'Gomel'),
(3, 'Hrodna'),
(4, 'Baranovichi'),
(5, 'Brest'),
(6, 'Zhlobin'),
(7, 'Vitebsk'),
(8, 'Krugloe');


INSERT INTO amastytest.persons(id, city_id, fullname) VALUES
(1, 5, 'Ivan Petrov'),
(2, 3, 'Sebastian Haponenka'),
(3, 3, 'Vasil Lutsevich'),
(4, 2, 'Leo Klimovich'),
(5, 7, 'Matea Kezhman'),
(6, 8, 'Alex Marshall'),
(7, 3, 'Bilbo Beggins');


INSERT INTO amastytest.transactions(transaction_id, from_person_id, to_person_id, amount) VALUES
(1, 4, 2, 10),
(2, 2, 3, 7),
(3, 5, 2, 12.54),
(4, 4, 7, 13),
(5, 3, 1, 8.23),
(6, 1, 3, 12.3),
(7, 2, 5, 3.12);