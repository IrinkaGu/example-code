<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<? $APPLICATION->SetAdditionalCSS($componentPath.'/css/style.css'); ?>
<? $APPLICATION->AddHeadScript($componentPath.'/js/script.js');?>

<?$BD_PG = $GLOBALS['BD_PG'];
$JsonConstructor = $GLOBALS['JsonConstructor'];

$data = $BD_PG->getRegionInfo(2, "mr");

$fakt = ($data[0]["fakt_doh"] - $data[0]["fakt_rash"]) * $arResult["UNITS_DIAGRAM"]["KOEF"];
if ($fakt < 0){
	$type_fakt = GetMessage("DEFICIT");
	$class_fakt = "value_pink";
} else {
	$type_fakt = GetMessage("SURPLUS");
	$class_fakt = "value_grey";
}

$plan = ($data[0]["plan_doh"] - $data[0]["plan_rash"]) * $arResult["UNITS_DIAGRAM"]["KOEF"];
if ($plan < 0){
	$type_plan = GetMessage("DEFICIT");
	$class_plan = "value_pink";
} else {
	$type_plan = GetMessage("SURPLUS");
	$class_plan = "value_grey";
}

$jsonData1 = $JsonConstructor->getRegionGeneralRaskh($data);
$jsonData2 = $JsonConstructor->getRegionGeneralDokh($data);
?> 

<script>
	var data1 = <?=$jsonData1?>;
	var data2 = <?=$jsonData2?>;
</script>

<div class="switch_box">
	<h4 class="page__title"><?=GetMessage("MAIN_POK")?> <?=$data[0]["nazvanie_mr"];?> <?=GetMessage("REGION")?> <?=date("d.m.Y", strtotime($data[0]['data_planirovania_r']))?></h4>
	<div class="page__row marg-b marg-t" style="flex-direction: row-reverse;"> 
		<div class="diagram__toggle"> 
        	<div class="switch"> 
				<input id="toggle-on6" class="toggle toggle-left" name="toggle6" value="false" type="radio" checked=""> 
				<label for="toggle-on6" class="switch__btn change_diagram"><?=GetMessage("DIAGRAMM")?></label> 
				<input id="toggle-off6" class="toggle toggle-right" name="toggle6" value="true" type="radio"> 
				<label for="toggle-off6" class="switch__btn change_table"><?=GetMessage("TABLE")?></label> 
			</div>
       		<a class="picture-link btn-download marg-l" href="#"><img src="/budget-execution/the-execution-of-the-budget/images/download_arrow.png" alr="<?=GetMessage('DOWNLOAD')?>"></a> 
		</div>
	</div>
	<div class="diagram_box">
	     <div class="flex flex-between">
		<div class="marg-l-10per" style="float:left;">
			<?$APPLICATION->IncludeComponent(
				"ps-components:graphika.diagram",
				".default",
				Array(
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"DIAGRAM_ID" => "rashod_general_region",
					"WIDTH" => "200",
					"HEIGHT" => "500",
					"AJAX_OPTION_ADDITIONAL" => "",
					"COLOR" => "FFFF00",
					"CAPTION" => GetMessage("INCOME"),
					"LEGENDVALUE" => "#626262",
					"COLORPATH" => "#FBAD82",
					"COLORBACK" => "#D7D7D7",
					"LEGENDFAKT" => "#F68E54",
					"DATA" => "data2",
					"UNITS_DIAGRAM" => $arParams["UNITS_DIAGRAM"],
				)
			);?> 
		</div>
		<div class="prof_def_box">
			<div><?=$type_plan?></div>
			<div class="small"><?=GetMessage("PLAN")?></div>
			<div class="<?=$class_plan?>"><?=number_format(abs($plan), 0, '', ' ')?> <?=$arResult["UNITS_DIAGRAM"]["NAME_SHORT"]?></div>
			<div style="margin: 35px 0 0 0;"><?=$type_fakt?></div>
			<div class="small"><?=GetMessage("FAKT")?></div>
			<div class="<?=$class_fakt?>"><?=$nombre_format_francais = number_format(abs($fakt), 0, '', ' ')?> <?=$arResult["UNITS_DIAGRAM"]["NAME_SHORT"]?></div>
		</div>
		<div class="marg-r-10per" style="float:left;">
			<?$APPLICATION->IncludeComponent(
	"ps-components:graphika.diagram", 
	".default", 
	array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"DIAGRAM_ID" => "dokhod_general_region",
		"WIDTH" => "200",
		"HEIGHT" => "500",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COLOR" => "FFFF00",
		"CAPTION" => GetMessage("COSTS"),
		"LEGENDVALUE" => "#626262",
		"COLORPATH" => "#0072BC",
		"COLORBACK" => "#D7D7D7",
		"LEGENDFAKT" => "#0072BC",
		"DATA" => "data1",
		"UNITS_DIAGRAM" => $arParams["UNITS_DIAGRAM"],
		"COMPONENT_TEMPLATE" => "gist-rev-costs-surplus-def-planact",
		"COLORREVPLAN" => "#FAD9A9",
		"COLORREVACTUAL" => "#F5BA63",
		"COLORCOSTSPLAN" => "#94C0DE",
		"COLORCOSTSACTUAL" => "#529ACB",
		"COLORDEFSURPLAN" => "#F3B3B2",
		"COLORDEFSURACTUAL" => "#F08482",
		"SPACEBETWEEN" => "120",
		"PADDINGLEFT" => "100",
		"PADDINGBOTTOM" => "150",
		"MOVEMOUNTH" => "20",
		"GISTPADDING" => "30"
	),
	false
);?>  
		   </div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div class="table_box" style="display:none;">
   		<span class="date page__subtitle text-right marg-t"><?=GetMessage("UNITS");?> <?=$arResult["UNITS_TABLE"]["NAME_SHORT"]?></span>
    	<div class="tableDiv marg-b">
 			<table id="fixTable" class="table table__custom">
				<thead>
					<tr>
						<th><?=GetMessage("NAME_POK")?></th>
						<th><?=GetMessage("PLAN")?></th>
						<th><?=GetMessage("FAKT")?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?=$BD_PG->getRuName("plan_doh")?></td>
						<td><?=$data[0]["plan_doh"]*$arResult["UNITS_TABLE"]["KOEF"]?></td>
						<td><?=$data[0]["fakt_doh"]*$arResult["UNITS_TABLE"]["KOEF"]?></td>
					</tr>
					<tr>
						<td><?=$BD_PG->getRuName("plan_rash")?></td>
						<td><?=$data[0]["plan_rash"]*$arResult["UNITS_TABLE"]["KOEF"]?></td>
						<td><?=$data[0]["fakt_rash"]*$arResult["UNITS_TABLE"]["KOEF"]?></td>
					</tr>
					<tr>
						<td><?=$BD_PG->getRuName("prof_def")?></td>
						<td><?=($data[0]["plan_doh"] - $data[0]["plan_rash"])*$arResult["UNITS_TABLE"]["KOEF"]?></td>
						<td><?=($data[0]["fakt_doh"] - $data[0]["fakt_rash"])*$arResult["UNITS_TABLE"]["KOEF"]?></td>
					</tr>
				</tbody>
			</table>
    	</div>
	</div>
</div>