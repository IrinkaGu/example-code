<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arUnits = array();

$arSelect = Array("ID", "IBLOCK_ID", "NAME");
$arFilter = Array("IBLOCK_ID"=>31, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

while ($ob = $res->GetNextElement()){
	$arFields = $ob->GetFields();  

 	$arUnits[$arFields['ID']] = $arFields['NAME'];

}


$arComponentParameters = array(
	"GROUPS" => array(
      "SETTINGS" => array(
         "NAME" => GetMessage("ELEMENTS")
      ),

	  "UNITS" => array(
         "NAME" => GetMessage("UNITS")
      )
    ),

	"PARAMETERS" => array(

		"AJAX_MODE" => array(),

		"IS_DATE" => array(
			"PARENT" => "SETTINGS",
        	"NAME" => GetMessage("IS_DATE"),
        	"TYPE" => "CHECKBOX"
		),

		"IS_PLAN_FAKT" => array(
			"PARENT" => "SETTINGS",
        	"NAME" => GetMessage("IS_PLAN_FAKT"),
        	"TYPE" => "CHECKBOX"
		),

		"IS_SAVE" => array(
			"PARENT" => "SETTINGS",
        	"NAME" => GetMessage("IS_SAVE"),
        	"TYPE" => "CHECKBOX"
		),

		"IS_FILTER" => array(
			"PARENT" => "SETTINGS",
        	"NAME" => GetMessage("IS_FILTER"),
        	"TYPE" => "CHECKBOX"
		),

		"UNITS_DIAGRAM" => array(
			"PARENT" => "UNITS",
        	"NAME" => GetMessage("UNITS_DIAGRAM"),
        	"TYPE" => "LIST",
			'VALUES' => $arUnits,
		),

		"UNITS_TABLE" => array(
			"PARENT" => "UNITS",
        	"NAME" => GetMessage("UNITS_TABLE"),
        	"TYPE" => "LIST",
			'VALUES' => $arUnits,
		),


	)
);

?>