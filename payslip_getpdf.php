<?php
foreach (glob("pdf/*.php") as $filename) {
include $filename;
}
?>
