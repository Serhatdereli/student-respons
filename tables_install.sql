DROP TABLE IF EXISTS sr_response;
DROP TABLE IF EXISTS sr_session;
DROP TABLE IF EXISTS sr_profile;
DROP TABLE IF EXISTS sr_user;

CREATE TABLE sr_user(
	user_id INT NOT NULL AUTO_INCREMENT,
	hash_pass VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	registered_on DATETIME NOT NULL DEFAULT NOW(),
	PRIMARY KEY (user_id)
);

CREATE TABLE sr_session (
	session_id INT NOT NULL AUTO_INCREMENT,
	user_id INT NOT NULL,
	created_at DATETIME NOT NULL,
	expires_at DATETIME NOT NULL,
	description VARCHAR(150) NOT NULL,
	PRIMARY KEY (session_id),
	FOREIGN KEY (user_id) REFERENCES sr_user(user_id)
);

CREATE TABLE sr_response (
	response_id INT NOT NULL AUTO_INCREMENT,
	created_at DATETIME NOT NULL,
	feedback TEXT NOT NULL,
	sentiment INT(1) NOT NULL,
	session_id INT NOT NULL,
	PRIMARY KEY (response_id),
	FOREIGN KEY (session_id) REFERENCES sr_session(session_id)
);

CREATE TABLE sr_profile(
	profile_id INT NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(64),
	last_name VARCHAR(64),
	user_id INT NOT NULL,
	PRIMARY KEY (profile_id),
	FOREIGN KEY (user_id) REFERENCES sr_user(user_id)
);