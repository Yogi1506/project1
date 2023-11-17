use blog;
create table reset_token
(
    id int auto_increment primary key,
    email varchar(255) not null,
    token varchar(100) not null,
    created_at timestamp default now()
)