{"filter":false,"title":"g_app_notifications_chat_001.php","tooltip":"/migrations/g_app_notifications_chat_001.php","undoManager":{"mark":4,"position":4,"stack":[[{"start":{"row":0,"column":0},"end":{"row":24,"column":1},"action":"insert","lines":["<?php","","use core\\app\\Application;","","class h_app_notifications_comments_012 ","{","    public function up()","    {","","        $stmt = Application::$app->db->pdo->prepare( \"","             ALTER TABLE app_notifications_comments   ","            ADD CONSTRAINT dk_app_notification_id","             FOREIGN  KEY (notificationId) REFERENCES  app_notifications(id) ","            ON DELETE CASCADE ON UPDATE CASCADE","        \");","        $stmt->execute();","    }","    public function drop()","    {","        $stmt = Application::$app->db->pdo->prepare(","            \" DROP TABLE IF EXISTS app_notifications_comments\"","        );","        $stmt->execute();","    }","}"],"id":1}],[{"start":{"row":4,"column":6},"end":{"row":4,"column":38},"action":"remove","lines":["h_app_notifications_comments_012"],"id":2},{"start":{"row":4,"column":6},"end":{"row":4,"column":34},"action":"insert","lines":["g_app_notifications_chat_001"]}],[{"start":{"row":10,"column":43},"end":{"row":10,"column":53},"action":"remove","lines":["comments  "],"id":3},{"start":{"row":10,"column":43},"end":{"row":10,"column":44},"action":"insert","lines":["c"]},{"start":{"row":10,"column":44},"end":{"row":10,"column":45},"action":"insert","lines":["h"]},{"start":{"row":10,"column":45},"end":{"row":10,"column":46},"action":"insert","lines":["a"]},{"start":{"row":10,"column":46},"end":{"row":10,"column":47},"action":"insert","lines":["t"]}],[{"start":{"row":11,"column":49},"end":{"row":11,"column":50},"action":"insert","lines":["_"],"id":4},{"start":{"row":11,"column":50},"end":{"row":11,"column":51},"action":"insert","lines":["c"]},{"start":{"row":11,"column":51},"end":{"row":11,"column":52},"action":"insert","lines":["h"]},{"start":{"row":11,"column":52},"end":{"row":11,"column":53},"action":"insert","lines":["a"]},{"start":{"row":11,"column":53},"end":{"row":11,"column":54},"action":"insert","lines":["t"]}],[{"start":{"row":20,"column":35},"end":{"row":20,"column":61},"action":"remove","lines":["app_notifications_comments"],"id":5},{"start":{"row":20,"column":35},"end":{"row":20,"column":57},"action":"insert","lines":["app_notifications_chat"]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":12,"column":55},"end":{"row":12,"column":72},"isBackwards":true},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1671738799090,"hash":"b803ad75aa15932bed5c99616686938a1b8c007a"}