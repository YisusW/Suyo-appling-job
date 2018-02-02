
Create table container (

    Id_container Serial not null Primary key,
    description character varying null

)ENGINE = INNODB ;

Create Table type_ball(
    
    Id_type_ball Serial not null Primary key,
    description character varying null

)ENGINE = INNODB ;

Create Table type_ball_container(
    
    Id_type_ball_container Serial Not Null Primary Key,
    Id_type_ball   int not null,
    Id_container int not null,
    quantity int not null,
    
    
    Constraint id_type_ball_fk Foreign KEY (Id_type_ball) REFERENCES type_ball ( Id_type_ball ) ON UPDATE CASCADE ON DELETE CASCADE,
    Constraint id_container_fk Foreign KEY (Id_container) REFERENCES container ( Id_container ) ON UPDATE CASCADE ON DELETE CASCADE
    

)ENGINE = INNODB ;

Create Table history_type_ball_container(
    
    Id_history_type_ball_container Serial Not Null Primary Key,
    Id_type_ball_container int not null,
    swapping character varying null,
    description character varying null,
    date_swapping date not null ,
    
    Constraint Id_type_ball_container_fk Foreign KEY (Id_type_ball_container) REFERENCES type_ball_container ( Id_type_ball_container ) ON UPDATE CASCADE ON DELETE CASCADE
    
)ENGINE = INNODB  ;

