create table 0_migrate_init (
id serial PRIMARY key not null,
file_name VARCHAR (255),
file_name_md5 VARCHAR (100),
create_time integer
);