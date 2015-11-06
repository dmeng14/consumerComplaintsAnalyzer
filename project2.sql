CREATE TABLE complaints (
    ComplaintID INT PRIMARY KEY,
    DateReceived VARCHAR(10),
	DateSentToCompany VARCHAR(10),
    Narrative TEXT(1000),
    ComPublicResponse TINYTEXT,
    ComResponseToConsumer VARCHAR(60),
    TimelyResponse VARCHAR(3),
    ConsumerDisputed VARCHAR(3)
	FOREIGN KEY (product) REFERENCES product (id) ON DELETE RESTRICT;
	FOREIGN KEY (issue) REFERENCES issue (issue_id) ON DELETE RESTRICT;
	FOREIGN KEY (company) REFERENCES company (registerNum) ON DELETE RESTRICT;
	FOREIGN KEY (submitVia) REFERENCES submitVia (submitID) ON DELETE RESTRICT;
	FOREIGN KEY (consumer) REFERENCES consumer (consumerID) ON DELETE RESTRICT;
	);

CREATE TABLE product (
id INT PRIMARY KEY, 
name VARCHAR (60),
parentId INT,
FOREIGN KEY (parentId) REFERENCES product (id) 
         ON DELETE RESTRICT
         ON UPDATE CASCADE
);

CREATE TABLE issue (
issue_id INT PRIMARY KEY,
issue VARCHAR (60), 
parent_id INT,
product_id INT,
FOREIGN KEY (parent_id) REFERENCES issue (issue_id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE, 
FOREIGN KEY (product_id) REFERENCES product (id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
);

create table company (
registerNum INT primary key, 
company varchar(60),
yearFound YEAR,
CEO VARCHAR(15)
);

create table submitVia (
submitID CHAR(1) primary key,
submitTypes VARCHAR(15)
);

create table consumer (
consumerID INT primary key,
name VARCHAR(15),
DOB VARCHAR(15),
st CHAR(2),
zip CHAR(5)
);

load data infile 'complaintMain.csv'
into table complaints
fields terminated by ','
enclosed by '"'
lines terminated by '\r\n';


load data infile 'complist_man.csv'
into table company
fields terminated by ','
enclosed by '"'
lines terminated by '\r\n';

load data infile 'submit.csv'
into table submitVia
fields terminated by ','
enclosed by '"'
lines terminated by '\r\n';

load data infile 'consumer.csv'
into table consumer
fields terminated by ','
enclosed by '"'
lines terminated by '\r\n';

load data infile 'product.csv'
into table product
fields terminated by ','
enclosed by '"'
lines terminated by '\r\n';

load data infile 'issue_final.csv'
into table issue
fields terminated by ','
enclosed by '"'
lines terminated by '\r\n';

/*this works after exit mysql*/
 mysqldump -u root company > dump.sql
  mysql -u root company <dump.sql