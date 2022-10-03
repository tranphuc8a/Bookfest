
use bookfest;

insert into USER values
	('tranphuc8a@gmail.com', 'admin', 'admin', 'normal', '2022-09-14'),
    ('tranphuc8b@gmail.com', 'admin', 'provider', 'normal', '2022-09-14'),
    ('tranphuc8c@gmail.com', 'admin', 'customer', 'normal', '2022-09-14'),
    ('tranphuc8d@gmail.com', 'admin', 'customer', 'block', '2022-09-14');

insert into PROFILE values
	('tranphuc8a@gmail.com', 'Trần Văn Phúc', null, '0965074220', '2001-04-22', 'Đệp trâi'),
    ('tranphuc8b@gmail.com', 'Trần Trung Thiệp', null, '0965074220', '2001-04-22', 'Đệp trâi'),
    ('tranphuc8c@gmail.com', 'Trần Thành Long', null, '0965074220', '2001-04-22', 'Đệp trâi'),
    ('tranphuc8d@gmail.com', 'Trịnh Đức Tiệp', null, '0965074220', '2001-04-22', 'Đệp trâi');

insert into FRIEND values
	('tranphuc8a@gmail.com', 'tranphuc8b@gmail.com', '2022-09-14'),
    ('tranphuc8a@gmail.com', 'tranphuc8c@gmail.com', '2022-09-14'),
    ('tranphuc8a@gmail.com', 'tranphuc8d@gmail.com', '2022-09-14');
    

insert into CHAT value (null, 'Phúc chat', '2022-09-14');

insert into CHAT_USER values
	('1', 'tranphuc8a@gmail.com', 'admin', '2022-09-14'),
    ('1', 'tranphuc8b@gmail.com', 'memeber', '2022-09-14'),
    ('1', 'tranphuc8c@gmail.com', 'memeber', '2022-09-14'),
    ('1', 'tranphuc8d@gmail.com', 'memeber', '2022-09-14');

insert into MESSAGE values
	('1', 'tranphuc8a@gmail.com', 'Alo mọi người', '2022-09-14'),
    ('1', 'tranphuc8a@gmail.com', 'Alo mọi người', '2022-09-14'),
    ('1', 'tranphuc8b@gmail.com', 'Alo mọi người', '2022-09-14'),
    ('1', 'tranphuc8d@gmail.com', 'Alo mọi người', '2022-09-14');


insert into ANNOUNCEMENT values
	('tranphuc8a@gmail.com', 'Welcom to Bookfest', '2022-09-14', '#', 'unread'),
    ('tranphuc8b@gmail.com', 'Welcom to Bookfest', '2022-09-14', '#', 'unread'),
    ('tranphuc8c@gmail.com', 'Welcom to Bookfest', '2022-09-14', '#', 'unread'),
    ('tranphuc8d@gmail.com', 'Welcom to Bookfest', '2022-09-14', '#', 'unread');

insert into BOOK values
	(null, 'tranphuc8b@gmail.com', '100000', '10', '5', '2022-09-14', 'OK');




