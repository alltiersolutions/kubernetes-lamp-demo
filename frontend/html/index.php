<?php

// Service defined in Kubernetes manifest https://github.com/alltiersolutions/kubernetes-lamp-demo/deploy/kubernetes-lamp-demo-db-svc.yaml
$dbserver = "kubernetes-lamp-demo-db-svc";
// Environment variables defined in Kubernetes manifest https://github.com/alltiersolutions/kubernetes-lamp-demo/deploy/kubernetes-lamp-demo-db.yaml
$dbname = getenv('MYSQL_DATABASE');
$dbuser = getenv('MYSQL_USER');
$dbpass = getenv('MYSQL_PASSWORD');

// Create connection
$conn = mysqli_connect($dbserver, $dbuser, $dbpass);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo nl2br("Database connection successful!\n\n");
echo "Database host information: " . mysqli_get_host_info($conn);
// Close connection
mysqli_close($conn);

phpinfo();

?>
