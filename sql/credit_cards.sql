CREATE TABLE `credit_cards` (
  `id` int(11) NOT NULL,
  `type` varchar(8) NOT NULL,
  `name` varchar(64) NOT NULL,
  `number` varchar(16) NOT NULL,
  `exp_month` int(2) NOT NULL,
  `exp_year` int(4) NOT NULL,
  `cvv` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `credit_cards` (`id`, `type`, `name`, `number`, `exp_month`, `exp_year`, `cvv`) VALUES
(1, 'visa', 'Josef Bloggs', '1234567890123456', 2, 2026, 123),
(2, 'mcrd', 'Jirou Bloggs', '2345678901234567', 3, 2027, 234),
(3, 'amex', 'Jamie Bloggs', '3456789012345678', 4, 2028, 345),
(4, 'disc', 'Jamal Bloggs', '4567890123456789', 5, 2029, 456),
(5, 'visa', 'Jeong Bloggs', '5678901234567890', 6, 2026, 567);
