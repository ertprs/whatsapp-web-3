<?php
namespace WhatsApp; class Constants { const ADMIN_PASSWORD = '$2y$10$sgLDc2MRSh2FYtaBD22kOOU/taJQXI/PF8TSJfms09.fE0iV4vNbm'; const ADMIN_NAME = 'admin'; const ADMIN_ROLE = 'ROLE_ADMIN'; const API_KEY_USER_NAME = '_apiuser'; const API_KEY_ROLE = 'ROLE_API'; const API_KEY_TOKEN_SCHEMA = 'Apikey'; const API_KEY_MIN_LENGTH = 12; const API_KEY_MAX_LENGTH = 128; const CERT_TYPE_EXTERNAL = 'external'; const CERT_SERVER_FILENAME = 'server.cert'; const CERT_WWW_FILENAME = 'www.cert'; const CERT_CA_FILENAME = 'ca.pem'; const CERT_MARKER = '-----BEGIN CERTIFICATE-----'; const CERT_MARKER_END = '-----END CERTIFICATE-----'; const CERT_DIR_INSTALLED = '/var/lib/whatsapp/'; const DB_SQLITE = 'sqlite'; const DB_MYSQL = 'mysql'; const DB_PGSQL = 'pgsql'; const DB_DRIVER_SQLITE= 'pdo_sqlite'; const DB_DRIVER_MYSQL = 'pdo_mysql'; const DB_DRIVER_PGSQL = 'pdo_pgsql'; const JSON_KEY_PAYLOAD= 'payload'; const KEY_ID = 'id'; const KEY_PASSWORD = 'password'; const KEY_ROLES = 'roles'; const KEY_TOKEN = 'token'; const KEY_USERNAME = 'username'; const KEY_CERT = 'cert'; const KEY_CA_CERT = 'ca_cert'; const KEY_HOSTNAME = 'hostname'; const KEY_CERT_TYPE = 'cert_type'; const KEY_WA_ID = 'wa_id'; const KEY_NAME = 'name'; const KEY_JOINED = 'joined'; const KEY_TIMESTAMP = 'timestamp'; const LOCAL_DB_DIR = '/usr/local/waent/data/web/'; const PASSWORD_COMPLEXITY_REGEX = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[%s])[A-Za-z\d%s]{%d,%d}$/'; const MAX_PASSWORD_LENGTH = 64; const MAX_USERNAME_LENGTH = 32; const MIN_PASSWORD_LENGTH = 8; const MIN_USERNAME_LENGTH = 4; const PASSWORD_SPECIAL_CHARS = "!\"#$%&'()*+,-./:;<=>?@[\\]^_`{|}~"; const MEDIA_DIR = '/usr/local/wamedia/'; const MEDIA_SHARED_DIR = self::MEDIA_DIR . 'shared/'; const DEFAULT_DB_PORT = 3306; const DEFAULT_DB_TIMEOUT = 15; const SB_ADMIN_NAME = 'sb_admin'; const SB_MAX_CHECK_CONTACTS = 3; const SB_MAX_GROUP_MEMBERSHIP = 5; const TABLE_CONTACTS = 'contacts'; const TABLE_USERS = 'users'; const TABLE_TOKENS = 'tokens'; const TABLE_CERTS = 'certs'; const TOKEN_FIELD = 'Authorization'; const TOKEN_SCHEMA = 'Bearer'; const USER_ADMIN = 'admin'; const WEB_DB_NAME = 'waweb'; const CLUSTER_DB_NAME = 'clusterStore'; const NUM_PORTS = 4; const MAX_PROFILE_PHOTO_SIZE_BYTES = 5 * 1024 * 1024; const MAX_UPLOADED_MEDIA_SIZE_BYTES = 100 * 1024 * 1024; const RL_MAX_SB_API_REQUESTS = array(256, 86400); const RL_MAX_REQUESTS_TIME = array(256, 3600); const RL_MAX_WRONG_LOGINS = array(30, 3600); const RL_MAX_HEALTH_CHECKS = array(10, 60); const LOCAL_ENDPOINT = 'https://localhost:443/'; const FPM_STATUS_ENDPOINT = self::LOCAL_ENDPOINT . 'fpm-status.status?json'; const SERVER_STATUS_ENDPOINT = self::LOCAL_ENDPOINT . 'server-status?auto'; const DEFAULT_CURL_TIMEOUT = 15; const REQUEST_ID_FIELD = "request_id"; const REQUEST_ID_HTTP_HEADER = "X-Request-ID"; const INTERNAL_REQUEST_IDS_HTTP_HEADER = "X-Internal-Request-IDS"; const REQUEST_PATH = "REQUEST-PATH"; const API_METRICS = "api_metrics"; } 