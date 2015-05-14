
CREATE DATABASE `timesheets`;

USE `timesheets`;

CREATE TABLE `geolocations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `accuracty` int(11) DEFAULT NULL,
  `altitude` float DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `speed` float DEFAULT NULL,
  `heading` int(11) DEFAULT NULL,
  `source` char(4) DEFAULT NULL COMMENT 'gps, wifi, cell',
  `device_identifier` char(40) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `jobcode_assignments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `job_code_id` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `jobcodes` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `short_code` varchar(250) DEFAULT NULL,
  `type` char(7) DEFAULT NULL COMMENT 'regular,pto',
  `billable` tinyint(1) DEFAULT NULL,
  `billable_rate` float DEFAULT NULL,
  `has_children` tinyint(1) DEFAULT NULL,
  `assigned_to_all` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `last_api_query` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `timesheets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `jobcode_id` int(11) DEFAULT NULL,
  `locked` int(11) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `customfields` varchar(500) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `type` char(7) DEFAULT NULL COMMENT 'regular or manual',
  `on_the_clock` tinyint(1) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `date` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL COMMENT 'seconds',
  PRIMARY KEY (`id`)
);

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `first_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `manager_of_group_ids` varchar(100) DEFAULT NULL,
  `employee_number` int(11) DEFAULT NULL,
  `salaried` tinyint(1) DEFAULT NULL,
  `exempt` tinyint(1) DEFAULT NULL,
  `payroll_id` int(11) DEFAULT NULL,
  `client_url` varchar(250) DEFAULT NULL,
  `mobile_number` char(10) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `term_date` date DEFAULT NULL,
  `last_active` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `require_password_change` tinyint(1) DEFAULT NULL,
  `approved_to` date DEFAULT NULL,
  `submitted_to` date DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `permissions` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
