<?php
// Settings

define('CIPG_PROTOCOL', 'http');
define('CIPG_HOST', 'localhost:8080');
define('CIPG_CONTEXT', 'cipg-payportal');
define('CIPG_MERCHANTID', 'MCH001');
define('CIPG_SERVICEKEY', 'd0f4faaf-6e73-4e29-a141-13af63526cad');

define('CIPG_URL', CIPG_PROTOCOL . '://' . CIPG_HOST . '/' . CIPG_CONTEXT);

define('CIPG_URL_REGISTER_JSON', CIPG_PROTOCOL . '://' . CIPG_HOST . '/' . CIPG_CONTEXT . "/regjtran");

define('CIPG_URL_REGISTER_XML', CIPG_PROTOCOL . '://' . CIPG_HOST . '/' . CIPG_CONTEXT . "/regxtran");

define('CIPG_URL_REGISTER_POST_PARAM', CIPG_PROTOCOL . '://' . CIPG_HOST . '/' . CIPG_CONTEXT . "/regptran");


define('CIPG_URL_PAY', CIPG_PROTOCOL . '://' . CIPG_HOST . '/' . CIPG_CONTEXT . "/paytran");
?>
