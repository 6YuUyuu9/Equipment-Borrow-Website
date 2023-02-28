CREATE TABLE `user` (
  	`user_id` int(50) NOT NULL,
  	`user_name` varchar(50) NOT NULL,
	`user_firstname` varchar(100) NOT NULL
	`user_lastname` varchar(100) NOT NULL
	`user_pass` varchar(50) NOT NULL
	`user_lev` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `user`
  	ADD PRIMARY KEY (`user_id`),
	ADD KEY `pk_fk_users` (`user_name`);

CREATE TABLE `rent` (
  	`rent_id` int(20) NOT NULL,
  	`user_name` varchar(20) NOT NULL,
	`tool_name` varchar(20) NOT NULL
	`tool_quatity` varchar(10) NOT NULL
	`rent_date` datetime NOT NULL
	`rent_return` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `rent`
  	ADD PRIMARY KEY (`rent_id`),
	ADD KEY `pk_fk_users` (`user_name`),
	ADD KEY `pk_fk_tool` (`tool_name`);

CREATE TABLE `tool` (
  	`tool_id` int(20) NOT NULL,
	`tool_name` varchar(50) NOT NULL
	`tool_quatity` varchar(20) NOT NULL
	`tool_img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `tool`
  	ADD PRIMARY KEY (`tool_id`),
	ADD KEY `pk_fk_tool` (`tool_name`);

