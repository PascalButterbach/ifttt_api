CREATE TABLE `command`
(
    `id`          int(11) NOT NULL,
    `createdAt`   datetime    NOT NULL DEFAULT current_timestamp(),
    `command`     varchar(64) NOT NULL,
    `value`       int(3) NOT NULL,
    `retrieved`   tinyint(1) NOT NULL DEFAULT 0
    `processedAt` timestamp   NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp (),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `command`
    ADD PRIMARY KEY (`id`);


ALTER TABLE `command`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;