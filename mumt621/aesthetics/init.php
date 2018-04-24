<?

$vcap_services = json_decode($_ENV["VCAP_SERVICES"]);

$db_url = $vcap_services->{'elephantsql-n/a'}[0]->credentials->uri;

$db_params = parse_url($db_url);

$db_name = substr($db_params['path'], 1);

$connect_string = <<<CONNECT
host=${db_params['postgres://irokefea:ed3f37N-Jv6XTE_xQcYLm3G9jLb6HLzo@elmer.db.elephantsql.com']}
port=${db_params['5432']}
user=${db_params['irokefea']}
password=${db_params['ed3f37N-Jv6XTE_xQcYLm3G9jLb6HLzo']}
dbname=${irokefea}
CONNECT;

$db_conn = pg_connect($connect_string) or die('Could not connect: ' . pg_last_error());

$query = 'SELECT id, name, genre FROM artist';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

?>
