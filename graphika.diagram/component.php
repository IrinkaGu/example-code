<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentName */
/** @var string $componentPath */
/** @var string $componentTemplate */
/** @var string $parentComponentName */
/** @var string $parentComponentPath */
/** @var string $parentComponentTemplate */
?>


<?if(!CModule::IncludeModule('iblock'))
	return;

	$arParams['DIAGRAM_ID'] = htmlspecialcharsBack($arParams['DIAGRAM_ID']);
	$arParams['WIDTH'] = htmlspecialcharsBack($arParams['WIDTH']);
	$arParams['HEIGHT'] = htmlspecialcharsBack($arParams['HEIGHT']);
	$arParams['CAPTION'] = htmlspecialcharsBack($arParams['CAPTION']);

	$arParams['COLORPATH'] = htmlspecialcharsBack($arParams['COLORPATH']);
	$arParams['COLORBACK'] = htmlspecialcharsBack($arParams['COLORBACK']);
	$arParams['LEGENDVALUE'] = htmlspecialcharsBack($arParams['LEGENDVALUE']);
	$arParams['LEGENDFAKT'] = htmlspecialcharsBack($arParams['LEGENDFAKT']);

	$arParams['DATA'] = htmlspecialcharsBack($arParams['DATA']);

	$arSelect = Array("ID", "IBLOCK_ID", "NAME","PROPERTY_*");
	$arFilter = Array("IBLOCK_ID"=>31, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID"=>$arParams['UNITS_DIAGRAM']);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
	
	while ($ob = $res->GetNextElement()){
		$arProps = $ob->GetProperties();
		$arResult["UNITS_DIAGRAM"]["NAME_SHORT"] = $arProps["NAME_SHORT"]["VALUE"];
		$arResult["UNITS_DIAGRAM"]["KOEF"] = $arProps["KOEF"]["VALUE"];
	
	}
?>

<?$this->IncludeComponentTemplate();?>