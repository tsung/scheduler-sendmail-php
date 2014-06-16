Scheduler Send Mail
====================

use php set schedule to send email.

預約寄信: (假設都是 0:00 要收到)

* 準時寄出 (約 0:00:04 會收到)
  * 設定 0 0 * * * cd scheduler_sendmail/; ./scheduler_sendmail.php

* 準時收到 (0:00:00 會收到)
  * 設定前一分鐘 59 23 * * * cd scheduler_sendmail/; ./scheduler_sendmail.php


註1: Gmail 若有設定兩階段認證, 需要另外產生兩階段認證用的密碼.

註2: Gmail 就算提前幾秒, 還是會算寄出去的那分鐘為準, 所以收件者是 Gmail 的話, 建議使用準時寄出即可.
