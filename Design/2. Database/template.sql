use bookfest;

select * from user where email = 'tranphuc8a@gmail.com';

select * from login where email = 'tranphuc8a@gmail.com';
insert into login values ('tranphuc8a@gmail.com', '123');
update login set tokenid = '123456' where email = 'tranphuc8a@gmail.com';

update profile set 
	name = 'Trần Văn Phúc', 
    avatar = null,
    phone = '0965074220',
    dob = '2001-04-22',
    detail = 'Anh Phúc'
where email = 'tranphuc8a@gmail.com';

update user set hashmk = 'admin', role = 'admin', state = 'normal'
where email = 'tranphuc8a@gmail.com';

insert into login values ('tranphuc8a@gmail.com', '123', '2022-09-19 03:19:19');


drop procedure insertBook;
delimiter /
create procedure insertBook(
	$email varchar(255),
    $cost double,
    $quantity int,
    $sell int
) begin
	insert into BOOK values(null, $email, $cost, $quantity, $sell, now(), "OK");
	select *from BOOK where id=(SELECT LAST_INSERT_ID());
end /
delimiter ;

call insertBook('tranphuc8a@gmail.com', 12, 12, 12);




