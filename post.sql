use blog;
create table post(
    id int auto_increment primary key,
    user_id int not null,
    title varchar(255) not null,
    content longtext not null,
    banner varchar(255) not null,
    views int default 0,
    created_at datetime default now(),
    updated_at datetime default now()
)