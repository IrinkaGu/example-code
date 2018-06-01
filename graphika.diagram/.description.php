<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("GRAPHIKS_DIAGRAM"),
	"DESCRIPTION" => GetMessage("GRAPHIKS_DIAGRAM_DESC"),
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "oep_components",
		"NAME" => GetMessage("PS_COMPONENTS"),
		"CHILD" => array(
			"ID" => "graphiks",
			"NAME" => GetMessage("GRAPHIKS")
		)
	),
);

?>