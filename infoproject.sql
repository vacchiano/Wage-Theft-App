DROP TABLE IF EXISTS Wage;
DROP TABLE IF EXISTS Hours;
DROP TABLE IF EXISTS Job;
DROP TABLE IF EXISTS Employee;
DROP TABLE IF EXISTS Company;
DROP TABLE IF EXISTS NonProfit;
DROP TABLE IF EXISTS NonProfitAccount;

CREATE TABLE Employee(
	email VARCHAR(45) UNIQUE NOT NULL,
	name VARCHAR(45) NOT NULL,
	hashedPass VARCHAR(256) NOT NULL,
	phoneNumber INT NOT NULL,
	address VARCHAR(100) NULL,
	PRIMARY KEY (email)
);

CREATE TABLE Company(
	companyID INT NOT NULL AUTO_INCREMENT,
	parentCompany VARCHAR(100) NULL,
	address VARCHAR(100) NOT NULL,
	PRIMARY KEY (companyID)
);

CREATE TABLE Job(
	jobID INT NOT NULL AUTO_INCREMENT,
	jobTitle VARCHAR(100) NOT NULL,
	hourlyPay INT NOT NULL,
    email VARCHAR(45) NOT NULL, 
    companyID INT NOT NULL,
	PRIMARY KEY (jobID),
	FOREIGN KEY (email) REFERENCES Employee (email) ON DELETE CASCADE,
	FOREIGN KEY (companyID) REFERENCES Company (companyID)
	
);
CREATE TABLE Wage(
	wageID INT NOT NULL AUTO_INCREMENT,
	payCheck INT NOT NULL,
	startDate DATE NOT NULL,
	endDate DATE NOT NULL,
	payDate DATE NOT NULL,
    jobID INT NOT NULL,
	PRIMARY KEY(wageID),
	FOREIGN KEY(jobID) REFERENCES Job(jobID) ON DELETE CASCADE
);

CREATE TABLE Hours(
	hourID INT NOT NULL AUTO_INCREMENT,
	hoursWorked INT NOT NULL,
	startDate DATE NOT NULL,
	endDate DATE NOT NULL,
    jobID INT NOT NULL,
	PRIMARY KEY(hourID),
	FOREIGN KEY(jobID) REFERENCES Job(jobID) ON DELETE CASCADE
);


CREATE TABLE NonProfit(
	nonProfitName VARCHAR(45) UNIQUE NOT NULL,
	nonProfitEmail VARCHAR(45) NOT NULL,
	nonProfitNumber INT(20) NOT NULL,
	PRIMARY KEY (nonProfitName)
);

CREATE TABLE NonProfitAccount(
	email VARCHAR(45) UNIQUE NOT NULL,
	userID INT NOT NULL AUTO_INCREMENT,
	hashedPass VARCHAR(256) NOT NULL,
	PRIMARY KEY (userID)
);

INSERT INTO Company (parentCompany, address) VALUES ('Walmart', '123 Main st');
INSERT INTO Company (parentCompany, address) VALUES ('Home Depot', '123 South st');
INSERT INTO Company (parentCompany, address) VALUES ('Walgreens', '123 North st');
INSERT INTO Company (parentCompany, address) VALUES ('Target', '123 West st');
INSERT INTO Company (parentCompany, address) VALUES ('Bo James', '123 East st');
INSERT INTO Company (parentCompany, address) VALUES ('Kum and Go', '123 Burlington st');
INSERT INTO NonProfitAccount(email, hashedPass) VALUES ('john-doe@uiowa.edu','12345');



