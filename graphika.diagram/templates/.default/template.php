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

<svg id="<?=$arParams['DIAGRAM_ID']?>" viewbox="0 0 <?=$arParams['WIDTH']?> <?=$arParams['HEIGHT']?>" preserveAspectRatio="xMinYMin meet" 
     width="<?=$arParams['WIDTH']?>" height="<?=$arParams['HEIGHT']?>" style="width: 100%"></svg>

<script>
	$(document).ready(function (){
		prop = {
			"font-size":"15" ,
			"legendValue":"<?=$arParams['LEGENDVALUE']?>",
			"legendFakt":"<?=$arParams['LEGENDFAKT']?>", 
			"colorBack": "<?=$arParams['COLORBACK']?>"  , 
			"colorOverGraph":"<?=$arParams['COLORPATH']?>",
			"units":"<?=$arResult['UNITS_DIAGRAM']['NAME_SHORT']?>"
		}
	
		var svg = d3.select("#<?=$arParams['DIAGRAM_ID']?>"),
		width = +svg.attr("width"),
		height = +svg.attr("height");
	
		var color = d3.scaleOrdinal(prop.colorsLeft);

		radius = 100 ;
		g = svg.append("g")
			.attr("transform", "translate(" + width / 2  + "," + height * 0.3 + ")") 
				.attr("class" , "canvas"); 
		donut = g.append("g")
					.attr("class", "donut");

		showDonut(<?=$arParams['DATA']?>);
        legendDefault(<?=$arParams['DATA']?>);
		percentsAndCaption(<?=$arParams['DATA']?>,"<?=$arParams['CAPTION']?>");
		overGraph(<?=$arParams['DATA']?>);
	});
</script>

