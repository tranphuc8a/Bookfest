use bookfest;

create table USER(
	email varchar(255) not null primary key,
    hashmk varchar(255) not null,
    role varchar(255) not null,
    state varchar(255) not null,
    time datetime
);


create table LOGIN(
	email varchar(255) not null primary key,
    tokenid varchar(255) not null,
    time datetime
);

create table CODE(
	email varchar(255) not null primary key,
    code varchar(255) not null,
    time datetime
);

create table PROFILE(
	email varchar(255) not null primary key,
    name varchar(255) not null,
    avatar varchar(255),
    phone varchar(255) not null,
    dob date not null,
    detail varchar(1023),
    constraint fk1 foreign key (email) references USER(email)
);


create table FRIEND(
	email1 varchar(255) not null,
    email2 varchar(255) not null,
    time datetime not null,
    constraint primary key (email1, email2),
	constraint fk2 foreign key (email1) references USER(email),
			foreign key (email2) references USER(email)
);


create table CHAT(
	id int not null primary key auto_increment,
    name varchar(255) not null,
    time datetime not null
);


create table CHAT_USER(
	idChat int not null,
    email varchar(255) not null,
    role varchar(255) not null,
    time datetime not null,
    constraint primary key (idChat, email),
	constraint fk3
		foreign key (idChat) references CHAT(id),
        foreign key (email) references USER(email)
);


create table MESSAGE(
	idChat int not null,
    email varchar(255) not null,
    content varchar(1023) not null,
	time datetime not null,
    constraint fk4
		foreign key (idChat) references CHAT(id),
        foreign key (email) references USER(email)
);


create table ANNOUNCEMENT(
	email varchar(255) not null,
    content varchar(1023) not null,
    time datetime not null,
    link varchar(255) not null,
    state varchar(255) not null,
    constraint fk5 foreign key (email) references USER(email)
);


create table BOOK(
	id int not null auto_increment primary key,
    email varchar(255) not null,
    cost double not null,
    quantity int not null,
    sell int not null,
    time datetime,
    state varchar(255) not null,
    constraint fk6 foreign key (email) references USER(email)
);


create table BOOK_INFO(
	id int not null,
    name varchar(255) not null,
    author varchar(255),
    pages int,
    publisher varchar(255),
    detail varchar(9999),
    constraint fk7
		foreign key (id) references BOOK(id)
);

create table BOOK_IMAGE(
	id int not null,
    image1 varchar(255) not null,
    image2 varchar(255) not null,
    image3 varchar(255) not null,
    image4 varchar(255) not null,
    image5 varchar(255) not null,
    constraint fk8 foreign key (id) references BOOK(id)
);


create table BOOK_COMMENT(
	id int not null auto_increment primary key,
	productId int not null,
    email varchar(255) not null,
    star int not null,
    content varchar(1023) not null,
    time datetime not null,
    constraint fk9
		foreign key (productId) references BOOK(id),
		foreign key (email) references USER(email)
);


create table RECEIPT(
	id int not null primary key auto_increment,
    productid int not null,
    quantity int not null,
    cost double not null,
    buyemail varchar(255) not null,
    sellemail varchar(255) not null,
    address varchar(255) character set utf8mb4,
    message varchar(255) character set utf8mb4,
    time datetime,
    during int not null,
    state varchar(255) not null,
    constraint fk10
		foreign key (productid) references BOOK(id),
        foreign key (buyemail) references USER(email),
        foreign key (sellemail) references USER(email)
);


create table CART(
	email varchar(255) not null,
    idbook int not null,
    quantity int not null,
    time datetime not null,
    constraint fk13
		foreign key (email) references USER(email),
        foreign key (idbook) references BOOK(id)
);


