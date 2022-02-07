<?php

require_once 'inc/db.php';

echo json_encode(getEachMonthSales($conn));