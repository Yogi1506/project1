CREATE Database blog;
use blog;
create table user1(
    id int auto_increment primary key,
    username varchar(50) not null unique,
    email varchar(50) not null unique,
    password varchar(32) not null,
    avatar varchar(255)
)

