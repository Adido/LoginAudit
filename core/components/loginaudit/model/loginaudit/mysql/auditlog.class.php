<?php
/**
 * @package loginaudit
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/auditlog.class.php');
class auditLog_mysql extends auditLog {}