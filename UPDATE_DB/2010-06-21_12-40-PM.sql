ALTER TABLE outbox ADD outbox_retry TINYINT NOT NULL DEFAULT 0 AFTER outbox_status;

ALTER TABLE `outbox` CHANGE `outbox_status` `outbox_status` ENUM( 'unsent', 'sent', 'failed' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'unsent';
