<?php
require './offer-controller.php';


require_once "../conf/config.php";
$controller = new OfferController($conn);
$controller->addOffer();


?>
