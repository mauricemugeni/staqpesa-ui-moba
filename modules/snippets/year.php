<?php
$currentYear = date('Y');
foreach (range($currentYear, 1950) as $value) {
    echo "<option value=" . $value . ">" . $value . "</option>";
}
?>