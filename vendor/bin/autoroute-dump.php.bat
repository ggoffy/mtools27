@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../pmjones/auto-route/bin/autoroute-dump.php
php "%BIN_TARGET%" %*
