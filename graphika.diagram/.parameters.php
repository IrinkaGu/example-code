<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["DEFAULT_INFOBLOCK"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch()){
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}
//////////////
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
        	"NAME" => GetMessage("SETTINGS_DIAGRAM")
        ),
		"SETTINGS_BARCHART" => array(
			"NAME" => GetMessage("SETTINGS_NAME_GIST")
		),
        "SETTINGS_GRAF22" => array(
            "NAME" => GetMessage("SETTINGS_DIAGRAM")
        ),
        "COLORS22_CELL_TRUE" => array(
            "NAME" => GetMessage("COLORS_CELL_TRUE")
        ),
		"SETTINGS_GIST25" => array(
			"NAME" => GetMessage("SETTINGS_NAME_GIST")
		),
		"SETTINGS_GRAF26" => array(
			"NAME" => GetMessage("SETTINGS_NAME_GIST")
		),
		"SETTINGS_GRAF27" => array(
			"NAME" => GetMessage("SETTINGS_NAME_GIST")
		),	
		"GRAF27_COLORS_CIRCLE" => array(
			"NAME" => GetMessage("GRAF_COLORS_CIRCLE")
		),
        "SETTINGS_GRAF27_2" => array(
			"NAME" => GetMessage("SETTINGS_NAME_GIST")
		),
		"GRAF27_2_COLORS_CIRCLE" => array(
			"NAME" => GetMessage("GRAF_COLORS_CIRCLE")
		),
        "SETTINGS_GRAF27_PAGER" => array(
			"NAME" => GetMessage("SETTINGS_NAME_GIST")
		),
		"GRAF27_PAGER_COLORS_CIRCLE" => array(
			"NAME" => GetMessage("GRAF_COLORS_CIRCLE")
		),
        "SETTINGS_GRAF28" => array(
            "NAME" => GetMessage("SETTINGS_DIAGRAM")
        ),
        "SETTINGS_GRAF28_COLORS" => array(
            "NAME" => GetMessage("COLORS_COLUMN_SECTOR")
        ),
        "SETTINGS_GRAF28MY" => array(
            "NAME" => GetMessage("SETTINGS_DIAGRAM")
        ),
        "SETTINGS_GRAF29" => array(
            "NAME" => GetMessage("SETTINGS_DIAGRAM")
        ),
        "SETTINGS_GRAF29_COLORS" => array(
            "NAME" => GetMessage("COLORS_COLUMN_SECTOR")
        ),
        "SETTINGS_GRAF30" => array(
			"NAME" => GetMessage("SETTINGS_DIAGRAM")
		),
        "SETTINGS_GRAF35" => array(
			"NAME" => GetMessage("SETTINGS_DIAGRAM")
		),
        "SETTINGS_GRAF36" => array(
			"NAME" => GetMessage("SETTINGS_DIAGRAM")
		),
        "GRAF36_COLORS_STRIPS" => array(
			"NAME" => GetMessage("COLORS_STRIPS36")
		),
        "SETTINGS_GRAF37" => array(
			"NAME" => GetMessage("SETTINGS_DIAGRAM")
		),
        "SETTINGS_GRAF40" => array(
            "NAME" => GetMessage("SETTINGS_DIAGRAM")
        ),
        "SETTINGS_GRAF41" => array(
			"NAME" => GetMessage("SETTINGS_DIAGRAM")
		),
		"GRAF41_COLORS_CIRCLE" => array(
			"NAME" => GetMessage("GRAF_COLORS_CIRCLE")
		),
        "SETTINGS_GRAF42" => array(
            "NAME" => GetMessage("SETTINGS_NAME_GIST")
        ),
        "GRAF42_COLORS_CIRCLE" => array(
            "NAME" => GetMessage("GRAF_COLORS_CIRCLE")
        ),
        "SETTINGS_GRAF43" => array(
            "NAME" => GetMessage("SETTINGS_NAME_GIST")
        ),
        "GRAF43_COLORS_STRIPS" => array(
            "NAME" => GetMessage("COLORS_STRIPS43")
        ),
		"UNITS" => array(
        	"NAME" => GetMessage("UNITS")
     	 )
    ),

	"PARAMETERS" => array(

		"AJAX_MODE" => array(),

		"DATA" => array(
        	"NAME" => GetMessage("DATA"),
        	"TYPE" => "TEXT"
		)

		/*"UNITS_DIAGRAM" => array(
			"PARENT" => "UNITS",
        	"NAME" => GetMessage("UNITS_DIAGRAM"),
        	"TYPE" => "LIST",
			'VALUES' => $arUnits,
		),*/

	)
);


if (isset($arCurrentValues['SETTINGS_DIAGRAM']) && $arCurrentValues['SETTINGS_DIAGRAM'] == 'Y') {
	$arComponentParameters['PARAMETERS']['DIAGRAM_ID'] = array(
		"PARENT" => "SETTINGS",
		"NAME" => GetMessage("DIAGRAM_ID"),
		"TYPE" => "TEXT"
	);

	$arComponentParameters['PARAMETERS']['WIDTH'] = array(
		"PARENT" => "SETTINGS",
		"NAME" => GetMessage("WIDTH"),
		"TYPE" => "TEXT"
	);

	$arComponentParameters['PARAMETERS']['HEIGHT'] = array(
		"PARENT" => "SETTINGS",
		"NAME" => GetMessage("HEIGHT"),
		"TYPE" => "TEXT"
	);

	$arComponentParameters['PARAMETERS']['CAPTION'] = array(
		"PARENT" => "SETTINGS",
		"NAME" => GetMessage("CAPTION"),
		"TYPE" => "TEXT"
	);

	$arComponentParameters['PARAMETERS']['COLORPATH']  = array(
		"PARENT" => "SETTINGS",
		"NAME" => GetMessage("COLORPATH"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => '#FFFF00'
	);

	$arComponentParameters['PARAMETERS']['COLORBACK'] = array(
		"PARENT" => "SETTINGS",
		"NAME" => GetMessage("COLORBACK"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => '#FFFFFF'
	);

	$arComponentParameters['PARAMETERS']['LEGENDVALUE'] = array(
		"PARENT" => "SETTINGS",
		"NAME" => GetMessage("LEGENDVALUE"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => '#FFFF00'
	);

	$arComponentParameters['PARAMETERS']['LEGENDFAKT']  = array(
		"PARENT" => "SETTINGS",
		"NAME" => GetMessage("LEGENDFAKT"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => '#FFFF00'
	);
	$arComponentParameters['PARAMETERS']['COLORTEXTPATH']  = array(
		"PARENT" => "SETTINGS",
		"NAME" => GetMessage("COLORTEXTPATH"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => '#000000'
	);
}

if (isset($arCurrentValues['SETTINGS_BARCHART']) && $arCurrentValues['SETTINGS_BARCHART'] == 'Y') {
	$arComponentParameters['PARAMETERS']['DIAGRAM_ID'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("DIAGRAM_ID"),
		"TYPE" => "TEXT"
	);

	$arComponentParameters['PARAMETERS']['WIDTH'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("WIDTH"),
		"TYPE" => "TEXT"
	);

	$arComponentParameters['PARAMETERS']['HEIGHT'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("HEIGHT"),
		"TYPE" => "TEXT"
	);

	$arComponentParameters['PARAMETERS']['CAPTION'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("CAPTION"),
		"TYPE" => "TEXT"
	);

	$arComponentParameters['PARAMETERS']['COLORREVPLAN'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("COLORREVPLAN"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#FAD9A9"
	);

	$arComponentParameters['PARAMETERS']['COLORREVACTUAL'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("COLORREVACTUAL"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#F5BA63"
	);

	$arComponentParameters['PARAMETERS']['COLORCOSTSPLAN'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("COLORCOSTSPLAN"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#94C0DE"
	);

	$arComponentParameters['PARAMETERS']['COLORCOSTSACTUAL'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("COLORCOSTSACTUAL"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#529ACB"
	);

	$arComponentParameters['PARAMETERS']['COLORDEFSURPLAN'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("COLORDEFSURPLAN"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#F3B3B2"
	);

	$arComponentParameters['PARAMETERS']['COLORDEFSURACTUAL'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("COLORDEFSURACTUAL"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#F08482"
	);
	$arComponentParameters['PARAMETERS']['COLORLEGEND'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("COLORLEGEND"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#323232"
	);

	$arComponentParameters['PARAMETERS']['PLANGISTLABEL'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("PLANGISTLABEL"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#999999"
	);

	$arComponentParameters['PARAMETERS']['FACTGISTLABEL'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("FACTGISTLABEL"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#333333"
	);

	$arComponentParameters['PARAMETERS']['SPACEBETWEEN'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("SPACEBETWEEN"),
		"TYPE" => "TEXT",
		"DEFAULT" => "120"
	);

	$arComponentParameters['PARAMETERS']['PADDINGLEFT'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("PADDINGLEFT"),
		"TYPE" => "TEXT",
		"DEFAULT" => "100"
	);

	$arComponentParameters['PARAMETERS']['PADDINGBOTTOM'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("PADDINGBOTTOM"),
		"TYPE" => "TEXT",
		"DEFAULT" => "150"
	);

	$arComponentParameters['PARAMETERS']['MOVEMOUNTH'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("MOVEMOUNTH"),
		"TYPE" => "TEXT",
		"DEFAULT" => "20"
	);

	$arComponentParameters['PARAMETERS']['GISTPADDING'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("GISTPADDING"),
		"TYPE" => "TEXT",
		"DEFAULT" => "30"
	);

	$arComponentParameters['PARAMETERS']['GISTPADDING_G'] = array(
		"PARENT" => "SETTINGS_BARCHART",
		"NAME" => GetMessage("GISTPADDING_G"),
		"TYPE" => "TEXT",
		"DEFAULT" => "10"
	);
}

if (isset($arCurrentValues['SETTINGS_GIST25']) && $arCurrentValues['SETTINGS_GIST25'] == 'Y') {
	$arComponentParameters['PARAMETERS']['DIAGRAM_ID'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("DIAGRAM_ID"),
		"TYPE" => "TEXT"
	);

	$arComponentParameters['PARAMETERS']['WIDTH'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("WIDTH"),
		"TYPE" => "TEXT"
	);

	$arComponentParameters['PARAMETERS']['HEIGHT'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("HEIGHT"),
		"TYPE" => "TEXT"
	);

	$arComponentParameters['PARAMETERS']['COLORFACTOUT'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("COLORFACTOUT"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#8F7F92"
	);

	$arComponentParameters['PARAMETERS']['COLORPLANOUT'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("COLORPLANOUT"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#D2B9D7"
	);

	$arComponentParameters['PARAMETERS']['COLORFACTIN'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("COLORFACTIN"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#D2B9D7"
	);

	$arComponentParameters['PARAMETERS']['COLORPLANIN'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("COLORPLANIN"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#C7E7CD"
	);

	$arComponentParameters['PARAMETERS']['COLORSALDO'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("COLORSALDO"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#4F5D90"
	);
	$arComponentParameters['PARAMETERS']['FACTGISTLABEL25'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("FACTGISTLABEL25"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#323232"
	);
	$arComponentParameters['PARAMETERS']['PLANGISTLABEL25'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("PLANGISTLABEL25"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#999"
	);

	$arComponentParameters['PARAMETERS']['SPACEBETWEEN_GIST25'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("SPACEBETWEEN_GIST25"),
		"TYPE" => "TEXT",
		"DEFAULT" => "80"
	);

	$arComponentParameters['PARAMETERS']['PADDINGLEFT'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("PADDINGLEFT"),
		"TYPE" => "TEXT",
		"DEFAULT" => "100"
	);

	$arComponentParameters['PARAMETERS']['BARSIZE'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("BARSIZE"),
		"TYPE" => "TEXT",
		"DEFAULT" => "90"
	);

	$arComponentParameters['PARAMETERS']['BACKCOLOR'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("BACKCOLOR"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#F8F9FA"
	);

	$arComponentParameters['PARAMETERS']['PADDINGBOTTOM'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("PADDINGBOTTOM"),
		"TYPE" => "TEXT",
		"DEFAULT" => "150"
	);

	$arComponentParameters['PARAMETERS']['MOVEMOUNTH'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("MOVEMOUNTH"),
		"TYPE" => "TEXT",
		"DEFAULT" => "30"
	);

	$arComponentParameters['PARAMETERS']['GISTPADDING'] = array(
		"PARENT" => "SETTINGS_GIST25",
		"NAME" => GetMessage("GISTPADDING"),
		"TYPE" => "TEXT",
		"DEFAULT" => "30"
	);
}

if (isset($arCurrentValues['SETTINGS_GRAF26']) && $arCurrentValues['SETTINGS_GRAF26'] == 'Y') {
	$arComponentParameters['PARAMETERS']['COLORPLAN_GRAF26'] = array(
		"PARENT" => "SETTINGS_GRAF26",
		"NAME" => GetMessage("COLORPLAN_GRAF26"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#009cff"
	);

	$arComponentParameters['PARAMETERS']['COLORFACT_GRAF26'] = array(
		"PARENT" => "SETTINGS_GRAF26",
		"NAME" => GetMessage("COLORFACT_GRAF26"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#f6bd68"
	);

	$arComponentParameters['PARAMETERS']['BARSIZE'] = array(
		"PARENT" => "SETTINGS_GRAF26",
		"NAME" => GetMessage("BARSIZE"),
		"TYPE" => "TEXT",
		"DEFAULT" => "30"
	);

	$arComponentParameters['PARAMETERS']['BACKCOLOR'] = array(
		"PARENT" => "SETTINGS_GRAF26",
		"NAME" => GetMessage("BACKCOLOR"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#F8F9FA"
	);
}

if (isset($arCurrentValues['SETTINGS_GRAF27']) && $arCurrentValues['SETTINGS_GRAF27'] == 'Y') {

    $arComponentParameters['PARAMETERS']['DIAGRAM_ID'] = array(
        "PARENT" => "SETTINGS_GRAF27",
        "NAME" => GetMessage("DIAGRAM_ID"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['WIDTH'] = array(
        "PARENT" => "SETTINGS_GRAF27",
        "NAME" => GetMessage("WIDTH"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['HEIGHT'] = array(
        "PARENT" => "SETTINGS_GRAF27",
        "NAME" => GetMessage("HEIGHT"),
        "TYPE" => "TEXT"
    );

	$arComponentParameters['PARAMETERS']['MIDDLE_CIRCLE'] = array(
		"PARENT" => "SETTINGS_GRAF27",
		"NAME" => GetMessage("MIDDLE_CIRCLE"),
		"TYPE" => "TEXT",
		"DEFAULT" => "40"
	);

	$arComponentParameters['PARAMETERS']['CIRCLE_RADIUS'] = array(
		"PARENT" => "SETTINGS_GRAF27",
		"NAME" => GetMessage("CIRCLE_RADIUS"),
		"TYPE" => "TEXT",
		"DEFAULT" => "135"
	);

	$arComponentParameters['PARAMETERS']['SCALLOP_RADIUS'] = array(
		"PARENT" => "SETTINGS_GRAF27",
		"NAME" => GetMessage("SCALLOP_RADIUS"),
		"TYPE" => "TEXT",
		"DEFAULT" => "50"
	);

	$arComponentParameters['PARAMETERS']['SCALLOP_LEGEND_RADIUS'] = array(
		"PARENT" => "SETTINGS_GRAF27",
		"NAME" => GetMessage("SCALLOP_LEGEND_RADIUS"),
		"TYPE" => "TEXT",
		"DEFAULT" => "100"
	);

	$arComponentParameters['PARAMETERS']['SECTOR1'] = array(
		"PARENT" => "GRAF27_COLORS_CIRCLE",
		"NAME" => GetMessage("SECTOR1"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#4693CA"
	);

	$arComponentParameters['PARAMETERS']['SECTOR2'] = array(
		"PARENT" => "GRAF27_COLORS_CIRCLE",
		"NAME" => GetMessage("SECTOR2"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#C2BEC3"
	);

	$arComponentParameters['PARAMETERS']['SECTOR3'] = array(
		"PARENT" => "GRAF27_COLORS_CIRCLE",
		"NAME" => GetMessage("SECTOR3"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#8BC33C"
	);

}

if (isset($arCurrentValues['SETTINGS_GRAF27_2']) && $arCurrentValues['SETTINGS_GRAF27_2'] == 'Y') {

    $arComponentParameters['PARAMETERS']['DIAGRAM_ID'] = array(
        "PARENT" => "SETTINGS_GRAF27_2",
        "NAME" => GetMessage("DIAGRAM_ID"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['WIDTH'] = array(
        "PARENT" => "SETTINGS_GRAF27_2",
        "NAME" => GetMessage("WIDTH"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['HEIGHT'] = array(
        "PARENT" => "SETTINGS_GRAF27_2",
        "NAME" => GetMessage("HEIGHT"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['MIDDLE_CIRCLE'] = array(
        "PARENT" => "SETTINGS_GRAF27_2",
        "NAME" => GetMessage("MIDDLE_CIRCLE"),
        "TYPE" => "TEXT",
        "DEFAULT" => "40"
    );

    $arComponentParameters['PARAMETERS']['CIRCLE_RADIUS'] = array(
        "PARENT" => "SETTINGS_GRAF27_2",
        "NAME" => GetMessage("CIRCLE_RADIUS"),
        "TYPE" => "TEXT",
        "DEFAULT" => "135"
    );

    $arComponentParameters['PARAMETERS']['SCALLOP_RADIUS'] = array(
        "PARENT" => "SETTINGS_GRAF27_2",
        "NAME" => GetMessage("SCALLOP_RADIUS"),
        "TYPE" => "TEXT",
        "DEFAULT" => "50"
    );

    $arComponentParameters['PARAMETERS']['SCALLOP_LEGEND_RADIUS'] = array(
        "PARENT" => "SETTINGS_GRAF27_2",
        "NAME" => GetMessage("SCALLOP_LEGEND_RADIUS"),
        "TYPE" => "TEXT",
        "DEFAULT" => "100"
    );

    $arComponentParameters['PARAMETERS']['SECTOR1'] = array(
        "PARENT" => "GRAF27_2_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR1"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#4693CA"
    );

    $arComponentParameters['PARAMETERS']['SECTOR2'] = array(
        "PARENT" => "GRAF27_2_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR2"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#C2BEC3"
    );

    $arComponentParameters['PARAMETERS']['SECTOR3'] = array(
        "PARENT" => "GRAF27_2_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR3"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#8BC33C"
    );

    $arComponentParameters['PARAMETERS']['SECTOR4'] = array(
        "PARENT" => "GRAF27_2_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR4"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#8BC33C"
    );

    $arComponentParameters['PARAMETERS']['SECTOR5'] = array(
        "PARENT" => "GRAF27_2_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR5"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#8BC33C"
    );

    $arComponentParameters['PARAMETERS']['SECTOR6'] = array(
        "PARENT" => "GRAF27_2_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR6"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#8BC33C"
    );

    $arComponentParameters['PARAMETERS']['SECTOR7'] = array(
        "PARENT" => "GRAF27_2_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR7"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#8BC33C"
    );

}


if (isset($arCurrentValues['SETTINGS_GRAF27_PAGER']) && $arCurrentValues['SETTINGS_GRAF27_PAGER'] == 'Y') {

    $arComponentParameters['PARAMETERS']['DIAGRAM_ID'] = array(
        "PARENT" => "SETTINGS_GRAF27_PAGER",
        "NAME" => GetMessage("DIAGRAM_ID"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['WIDTH'] = array(
        "PARENT" => "SETTINGS_GRAF27_PAGER",
        "NAME" => GetMessage("WIDTH"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['HEIGHT'] = array(
        "PARENT" => "SETTINGS_GRAF27_PAGER",
        "NAME" => GetMessage("HEIGHT"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['CIRCLE_RADIUS'] = array(
        "PARENT" => "SETTINGS_GRAF27_PAGER",
        "NAME" => GetMessage("CIRCLE_RADIUS"),
        "TYPE" => "TEXT",
        "DEFAULT" => "150"
    );

    $arComponentParameters['PARAMETERS']['PAGE_SIZE'] = array(
        "PARENT" => "SETTINGS_GRAF27_PAGER",
        "NAME" => GetMessage("PAGE_SIZE"),
        "TYPE" => "TEXT",
        "DEFAULT" => "150"
    );

    $arComponentParameters['PARAMETERS']['SECTOR1'] = array(
        "PARENT" => "GRAF27_PAGER_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR1"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#4693CA"
    );

    $arComponentParameters['PARAMETERS']['SECTOR2'] = array(
        "PARENT" => "GRAF27_PAGER_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR2"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#C2BEC3"
    );

    $arComponentParameters['PARAMETERS']['SECTOR3'] = array(
        "PARENT" => "GRAF27_PAGER_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR3"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#8BC33C"
    );

    $arComponentParameters['PARAMETERS']['SECTOR4'] = array(
        "PARENT" => "GRAF27_PAGER_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR4"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#8BC33C"
    );

    $arComponentParameters['PARAMETERS']['SECTOR5'] = array(
        "PARENT" => "GRAF27_PAGER_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR5"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#8BC33C"
    );

    $arComponentParameters['PARAMETERS']['SECTOR6'] = array(
        "PARENT" => "GRAF27_PAGER_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR6"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#8BC33C"
    );

    $arComponentParameters['PARAMETERS']['SECTOR7'] = array(
        "PARENT" => "GRAF27_PAGER_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR7"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#8BC33C"
    );

    $arComponentParameters['PARAMETERS']['SECTOR8'] = array(
        "PARENT" => "GRAF27_PAGER_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR8"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#E8908F"
    );

    $arComponentParameters['PARAMETERS']['SECTOR9'] = array(
        "PARENT" => "GRAF27_PAGER_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR9"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#807FC3"
    );

    $arComponentParameters['PARAMETERS']['SECTOR10'] = array(
        "PARENT" => "GRAF27_PAGER_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR10"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#9ECEAA"
    );

    $arComponentParameters['PARAMETERS']['SECTOR11'] = array(
        "PARENT" => "GRAF27_PAGER_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR11"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#C7C3C8"
    );

    $arComponentParameters['PARAMETERS']['SECTOR12'] = array(
        "PARENT" => "GRAF27_PAGER_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR12"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#C7C3C8"
    );

    $arComponentParameters['PARAMETERS']['SECTOR13'] = array(
        "PARENT" => "GRAF27_PAGER_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR13"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#C7C3C8"
    );

    $arComponentParameters['PARAMETERS']['SECTOR14'] = array(
        "PARENT" => "GRAF27_PAGER_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR14"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#C7C3C8"
    );

    $arComponentParameters['PARAMETERS']['SECTOR15'] = array(
        "PARENT" => "GRAF27_PAGER_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR15"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#C7C3C8"
    );
}

if (isset($arCurrentValues['SETTINGS_GRAF41']) && $arCurrentValues['SETTINGS_GRAF41'] == 'Y') {
	$arComponentParameters['PARAMETERS']['CIRCLE_RADIUS'] = array(
		"PARENT" => "SETTINGS_GRAF41",
		"NAME" => GetMessage("CIRCLE_RADIUS"),
		"TYPE" => "TEXT",
		"DEFAULT" => "100"
	);

	$arComponentParameters['PARAMETERS']['SECTOR1'] = array(
		"PARENT" => "GRAF41_COLORS_CIRCLE",
		"NAME" => GetMessage("SECTOR1"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#4693CA"
	);

	$arComponentParameters['PARAMETERS']['SECTOR2'] = array(
		"PARENT" => "GRAF41_COLORS_CIRCLE",
		"NAME" => GetMessage("SECTOR2"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#C2BEC3"
	);
}

if (isset($arCurrentValues['SETTINGS_GRAF22']) && $arCurrentValues['SETTINGS_GRAF22'] == 'Y') {

	$arComponentParameters['PARAMETERS']['WIDTH'] = array(
		"PARENT" => "SETTINGS",
		"NAME" => GetMessage("WIDTH"),
		"TYPE" => "TEXT"
	);

	$arComponentParameters['PARAMETERS']['HEIGHT'] = array(
		"PARENT" => "SETTINGS",
		"NAME" => GetMessage("HEIGHT"),
		"TYPE" => "TEXT"
	);

	$arComponentParameters['PARAMETERS']['BARSIZE'] = array(
		"PARENT" => "SETTINGS_GRAF22",
		"NAME" => GetMessage("BARSIZE"),
		"TYPE" => "TEXT",
		"DEFAULT" => "50"
	);

	$arComponentParameters['PARAMETERS']['BARHEIGHT'] = array(
		"PARENT" => "SETTINGS_GRAF22",
		"NAME" => GetMessage("BARHEIGHT"),
		"TYPE" => "TEXT",
		"DEFAULT" => "40"
	);

	$arComponentParameters['PARAMETERS']['COLORS_CELL_FALSE'] = array(
		"PARENT" => "SETTINGS_GRAF22",
		"NAME" => GetMessage("COLORS_CELL_FALSE"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#DADFE6"
	);
	

	$arComponentParameters['PARAMETERS']['LINE1'] = array(
		"PARENT" => "COLORS22_CELL_TRUE",
		"NAME" => GetMessage("LINE1"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#C2BEC3"
	);

	$arComponentParameters['PARAMETERS']['LINE2'] = array(
		"PARENT" => "COLORS22_CELL_TRUE",
		"NAME" => GetMessage("LINE2"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#C2BEC3"
	);

	$arComponentParameters['PARAMETERS']['LINE3'] = array(
		"PARENT" => "COLORS22_CELL_TRUE",
		"NAME" => GetMessage("LINE3"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#C2BEC3"
	);

	$arComponentParameters['PARAMETERS']['LINE4'] = array(
		"PARENT" => "COLORS22_CELL_TRUE",
		"NAME" => GetMessage("LINE4"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#C2BEC3"
	);

	$arComponentParameters['PARAMETERS']['LINE5'] = array(
		"PARENT" => "COLORS22_CELL_TRUE",
		"NAME" => GetMessage("LINE5"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#C2BEC3"
	);

	$arComponentParameters['PARAMETERS']['LINE6'] = array(
		"PARENT" => "COLORS22_CELL_TRUE",
		"NAME" => GetMessage("LINE6"),
		"TYPE" => "COLORPICKER",
		"DEFAULT" => "#C2BEC3"
	);
}

if (isset($arCurrentValues['SETTINGS_GRAF30']) && $arCurrentValues['SETTINGS_GRAF30'] == 'Y') {
    $arComponentParameters['PARAMETERS']['WIDTH'] = array(
        "PARENT" => "SETTINGS",
        "NAME" => GetMessage("WIDTH"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['HEIGHT'] = array(
        "PARENT" => "SETTINGS",
        "NAME" => GetMessage("HEIGHT"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['COLORREVENUES'] = array(
        "PARENT" => "SETTINGS_GRAF30",
        "NAME" => GetMessage("COLORREVENUES"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#4783AF"
    );

    $arComponentParameters['PARAMETERS']['COLORCOSTS'] = array(
        "PARENT" => "SETTINGS_GRAF30",
        "NAME" => GetMessage("COLORCOSTS"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#DFBBA4"
    );

    $arComponentParameters['PARAMETERS']['COLORDEFSUR'] = array(
        "PARENT" => "SETTINGS_GRAF30",
        "NAME" => GetMessage("COLORDEFSUR"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#CF748D"
    );
}

if (isset($arCurrentValues['SETTINGS_GRAF35']) && $arCurrentValues['SETTINGS_GRAF35'] == 'Y') {
    $arComponentParameters['PARAMETERS']['WIDTH'] = array(
        "PARENT" => "SETTINGS_GRAF35",
        "NAME" => GetMessage("WIDTH"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['HEIGHT'] = array(
        "PARENT" => "SETTINGS_GRAF35",
        "NAME" => GetMessage("HEIGHT"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['BARSIZE'] = array(
        "PARENT" => "SETTINGS_GRAF35",
        "NAME" => GetMessage("BARSIZE"),
        "TYPE" => "TEXT",
        "DEFAULT" => "100"
    );

    $arComponentParameters['PARAMETERS']['SPACEBETWEEN'] = array(
        "PARENT" => "SETTINGS_GRAF35",
        "NAME" => GetMessage("SPACEBETWEEN"),
        "TYPE" => "TEXT",
        "DEFAULT" => "50"
    );

    $arComponentParameters['PARAMETERS']['COLORPLAN_GRAF35'] = array(
        "PARENT" => "SETTINGS_GRAF35",
        "NAME" => GetMessage("COLORPLAN_GRAF35"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#3481B5"
    );

    $arComponentParameters['PARAMETERS']['COLORFACT_GRAF35'] = array(
        "PARENT" => "SETTINGS_GRAF35",
        "NAME" => GetMessage("COLORFACT_GRAF35"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#EBC4A7"
    );
}

if (isset($arCurrentValues['SETTINGS_GRAF36']) && $arCurrentValues['SETTINGS_GRAF36'] == 'Y') {
    $arComponentParameters['PARAMETERS']['WIDTH'] = array(
        "PARENT" => "SETTINGS_GRAF36",
        "NAME" => GetMessage("WIDTH"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['HEIGHT'] = array(
        "PARENT" => "SETTINGS_GRAF36",
        "NAME" => GetMessage("HEIGHT"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['STRIPSIZE_36'] = array(
        "PARENT" => "SETTINGS_GRAF36",
        "NAME" => GetMessage("STRIPSIZE_36"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['COLORBACK_CENTER36'] = array(
        "PARENT" => "SETTINGS_GRAF36",
        "NAME" => GetMessage("COLORBACK_CENTER36"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#DADFE6"
    );

    $arComponentParameters['PARAMETERS']['COLOR_STRIP1'] = array(
        "PARENT" => "GRAF36_COLORS_STRIPS",
        "NAME" => GetMessage("COLOR_STRIP1"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#037CD3"
    );

    $arComponentParameters['PARAMETERS']['COLOR_STRIP2'] = array(
        "PARENT" => "GRAF36_COLORS_STRIPS",
        "NAME" => GetMessage("COLOR_STRIP2"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#5EB4D7"
    );

    $arComponentParameters['PARAMETERS']['COLOR_STRIP3'] = array(
        "PARENT" => "GRAF36_COLORS_STRIPS",
        "NAME" => GetMessage("COLOR_STRIP3"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#F69D32"
    );

    $arComponentParameters['PARAMETERS']['COLOR_STRIP4'] = array(
        "PARENT" => "GRAF36_COLORS_STRIPS",
        "NAME" => GetMessage("COLOR_STRIP4"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#93CFA2"
    );

    $arComponentParameters['PARAMETERS']['COLOR_STRIP5'] = array(
        "PARENT" => "GRAF36_COLORS_STRIPS",
        "NAME" => GetMessage("COLOR_STRIP5"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#59797F"
    );

    $arComponentParameters['PARAMETERS']['COLOR_STRIP6'] = array(
        "PARENT" => "GRAF36_COLORS_STRIPS",
        "NAME" => GetMessage("COLOR_STRIP6"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#F08482"
    );

    $arComponentParameters['PARAMETERS']['COLOR_STRIP7'] = array(
        "PARENT" => "GRAF36_COLORS_STRIPS",
        "NAME" => GetMessage("COLOR_STRIP7"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#8DC2D7"
    );
}

if (isset($arCurrentValues['SETTINGS_GRAF37']) && $arCurrentValues['SETTINGS_GRAF37'] == 'Y') {
    $arComponentParameters['PARAMETERS']['WIDTH'] = array(
        "PARENT" => "SETTINGS_GRAF37",
        "NAME" => GetMessage("WIDTH"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['HEIGHT'] = array(
        "PARENT" => "SETTINGS_GRAF37",
        "NAME" => GetMessage("HEIGHT"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['BARSIZE_37'] = array(
        "PARENT" => "SETTINGS_GRAF37",
        "NAME" => GetMessage("BARSIZE_37"),
        "TYPE" => "TEXT",
        "DEFAULT" => "400"
    );

    $arComponentParameters['PARAMETERS']['BARHEIGHT_37'] = array(
        "PARENT" => "SETTINGS_GRAF37",
        "NAME" => GetMessage("BARHEIGHT_37"),
        "TYPE" => "TEXT",
        "DEFAULT" => "40"
    );

    $arComponentParameters['PARAMETERS']['COLORPLAN_GRAF37'] = array(
        "PARENT" => "SETTINGS_GRAF37",
        "NAME" => GetMessage("COLORPLAN_GRAF37"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#DADFE6"
    );

    $arComponentParameters['PARAMETERS']['COLORFACT_GRAF37'] = array(
        "PARENT" => "SETTINGS_GRAF37",
        "NAME" => GetMessage("COLORFACT_GRAF37"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#206DB"
    );
}

if (isset($arCurrentValues['SETTINGS_GRAF40']) && $arCurrentValues['SETTINGS_GRAF40'] == 'Y') {
    $arComponentParameters['PARAMETERS']['WIDTH'] = array(
        "PARENT" => "SETTINGS_GRAF40",
        "NAME" => GetMessage("WIDTH"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['HEIGHT'] = array(
        "PARENT" => "SETTINGS_GRAF40",
        "NAME" => GetMessage("HEIGHT"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['BARSIZE'] = array(
        "PARENT" => "SETTINGS_GRAF40",
        "NAME" => GetMessage("BARSIZE"),
        "TYPE" => "TEXT",
        "DEFAULT" => "70"
    );

    $arComponentParameters['PARAMETERS']['SPACEBETWEEN'] = array(
        "PARENT" => "SETTINGS_GRAF40",
        "NAME" => GetMessage("SPACEBETWEEN"),
        "TYPE" => "TEXT",
        "DEFAULT" => "120"
    );

    $arComponentParameters['PARAMETERS']['PADDINGTOP'] = array(
        "PARENT" => "SETTINGS_GRAF40",
        "NAME" => GetMessage("PADDINGTOP"),
        "TYPE" => "TEXT",
        "DEFAULT" => "80"
    );

    $arComponentParameters['PARAMETERS']['COLORPLAN_GRAF40'] = array(
        "PARENT" => "SETTINGS_GRAF40",
        "NAME" => GetMessage("COLORPLAN_GRAF40"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#F2BC6C"
    );

    $arComponentParameters['PARAMETERS']['COLORFACT_GRAF40'] = array(
        "PARENT" => "SETTINGS_GRAF40",
        "NAME" => GetMessage("COLORFACT_GRAF40"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#FAE4C4"
    );
}

if (isset($arCurrentValues['SETTINGS_GRAF42']) && $arCurrentValues['SETTINGS_GRAF42'] == 'Y') {
    $arComponentParameters['PARAMETERS']['WIDTH'] = array(
        "PARENT" => "SETTINGS_GRAF42",
        "NAME" => GetMessage("WIDTH"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['HEIGHT'] = array(
        "PARENT" => "SETTINGS_GRAF42",
        "NAME" => GetMessage("HEIGHT"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['CIRCLE_RADIUS'] = array(
        "PARENT" => "SETTINGS_GRAF42",
        "NAME" => GetMessage("CIRCLE_RADIUS"),
        "TYPE" => "TEXT",
        "DEFAULT" => "150"
    );

    $arComponentParameters['PARAMETERS']['SECTOR1'] = array(
        "PARENT" => "GRAF42_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR1"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#DCBDA8"
    );

    $arComponentParameters['PARAMETERS']['SECTOR2'] = array(
        "PARENT" => "GRAF42_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR2"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#3189C8"
    );

    $arComponentParameters['PARAMETERS']['SECTOR3'] = array(
        "PARENT" => "GRAF42_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR3"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#8BC33CC"
    );

    $arComponentParameters['PARAMETERS']['SECTOR4'] = array(
        "PARENT" => "GRAF42_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR4"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#66977B"
    );

    $arComponentParameters['PARAMETERS']['SECTOR5'] = array(
        "PARENT" => "GRAF42_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR5"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#828BC4"
    );

    $arComponentParameters['PARAMETERS']['SECTOR6'] = array(
        "PARENT" => "GRAF42_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR6"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#828BC4"
    );

    $arComponentParameters['PARAMETERS']['SECTOR7'] = array(
        "PARENT" => "GRAF42_COLORS_CIRCLE",
        "NAME" => GetMessage("SECTOR7"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#8DC2D7"
    );
}

if (isset($arCurrentValues['SETTINGS_GRAF43']) && $arCurrentValues['SETTINGS_GRAF43'] == 'Y') {
    $arComponentParameters['PARAMETERS']['WIDTH'] = array(
        "PARENT" => "SETTINGS_GRAF43",
        "NAME" => GetMessage("WIDTH"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['HEIGHT'] = array(
        "PARENT" => "SETTINGS_GRAF43",
        "NAME" => GetMessage("HEIGHT"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['STRIPSIZE_43'] = array(
        "PARENT" => "SETTINGS_GRAF43",
        "NAME" => GetMessage("STRIPSIZE_43"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['STRIPHEIGHT_43'] = array(
        "PARENT" => "SETTINGS_GRAF43",
        "NAME" => GetMessage("STRIPHEIGHT_43"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['COLOR_STRIP1'] = array(
        "PARENT" => "GRAF43_COLORS_STRIPS",
        "NAME" => GetMessage("COLOR_STRIP1"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#3E73A4"
    );

    $arComponentParameters['PARAMETERS']['COLOR_STRIP2'] = array(
        "PARENT" => "GRAF43_COLORS_STRIPS",
        "NAME" => GetMessage("COLOR_STRIP2"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#67A1C9"
    );

    $arComponentParameters['PARAMETERS']['COLOR_STRIP3'] = array(
        "PARENT" => "GRAF43_COLORS_STRIPS",
        "NAME" => GetMessage("COLOR_STRIP3"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#58BDEC"
    );

    $arComponentParameters['PARAMETERS']['COLOR_STRIP4'] = array(
        "PARENT" => "GRAF43_COLORS_STRIPS",
        "NAME" => GetMessage("COLOR_STRIP4"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#6F6EC1"
    );

    $arComponentParameters['PARAMETERS']['COLOR_STRIP5'] = array(
        "PARENT" => "GRAF43_COLORS_STRIPS",
        "NAME" => GetMessage("COLOR_STRIP5"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#037CD3"
    );
}

if (isset($arCurrentValues['SETTINGS_GRAF28']) && $arCurrentValues['SETTINGS_GRAF28'] == 'Y') {
    $arComponentParameters['PARAMETERS']['WIDTH'] = array(
        "PARENT" => "SETTINGS_GRAF28",
        "NAME" => GetMessage("WIDTH"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['HEIGHT'] = array(
        "PARENT" => "SETTINGS_GRAF28",
        "NAME" => GetMessage("HEIGHT"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['CIRCLE_RADIUS'] = array(
        "PARENT" => "SETTINGS_GRAF28",
        "NAME" => GetMessage("CIRCLE_RADIUS"),
        "TYPE" => "TEXT",
        "DEFAULT" => "150"
    );

    $arComponentParameters['PARAMETERS']['SECTOR1'] = array(
        "PARENT" => "SETTINGS_GRAF28_COLORS",
        "NAME" => GetMessage("SECTOR1"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#73ADD5"
    );

    $arComponentParameters['PARAMETERS']['SECTOR2'] = array(
        "PARENT" => "SETTINGS_GRAF28_COLORS",
        "NAME" => GetMessage("SECTOR2"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#F3C37E"
    );

    $arComponentParameters['PARAMETERS']['SECTOR3'] = array(
        "PARENT" => "SETTINGS_GRAF28_COLORS",
        "NAME" => GetMessage("SECTOR3"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#508FB9"
    );

    $arComponentParameters['PARAMETERS']['SECTOR4'] = array(
        "PARENT" => "SETTINGS_GRAF28_COLORS",
        "NAME" => GetMessage("SECTOR4"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#939BC9"
    );

    $arComponentParameters['PARAMETERS']['SECTOR5'] = array(
        "PARENT" => "SETTINGS_GRAF28_COLORS",
        "NAME" => GetMessage("SECTOR5"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#F2AD5E"
    );

    $arComponentParameters['PARAMETERS']['SECTOR6'] = array(
        "PARENT" => "SETTINGS_GRAF28_COLORS",
        "NAME" => GetMessage("SECTOR6"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#9FCC5F"
    );

    $arComponentParameters['PARAMETERS']['SECTOR7'] = array(
        "PARENT" => "SETTINGS_GRAF28_COLORS",
        "NAME" => GetMessage("SECTOR7"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#7BA38C"
    );

    $arComponentParameters['PARAMETERS']['SECTOR8'] = array(
        "PARENT" => "SETTINGS_GRAF28_COLORS",
        "NAME" => GetMessage("SECTOR8"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#E8908F"
    );

    $arComponentParameters['PARAMETERS']['SECTOR9'] = array(
        "PARENT" => "SETTINGS_GRAF28_COLORS",
        "NAME" => GetMessage("SECTOR9"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#807FC3"
    );

    $arComponentParameters['PARAMETERS']['SECTOR10'] = array(
        "PARENT" => "SETTINGS_GRAF28_COLORS",
        "NAME" => GetMessage("SECTOR10"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#9ECEAA"
    );

    $arComponentParameters['PARAMETERS']['SECTOR11'] = array(
        "PARENT" => "SETTINGS_GRAF28_COLORS",
        "NAME" => GetMessage("SECTOR11"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#C7C3C8"
    );

    $arComponentParameters['PARAMETERS']['SECTOR12'] = array(
        "PARENT" => "SETTINGS_GRAF28_COLORS",
        "NAME" => GetMessage("SECTOR12"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#C7C3C8"
    );

    $arComponentParameters['PARAMETERS']['SECTOR13'] = array(
        "PARENT" => "SETTINGS_GRAF28_COLORS",
        "NAME" => GetMessage("SECTOR13"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#C7C3C8"
    );

    $arComponentParameters['PARAMETERS']['SECTOR14'] = array(
        "PARENT" => "SETTINGS_GRAF28_COLORS",
        "NAME" => GetMessage("SECTOR14"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#C7C3C8"
    );

    $arComponentParameters['PARAMETERS']['SECTOR15'] = array(
        "PARENT" => "SETTINGS_GRAF28_COLORS",
        "NAME" => GetMessage("SECTOR15"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#C7C3C8"
    );
}

if (isset($arCurrentValues['SETTINGS_GRAF28MY']) && $arCurrentValues['SETTINGS_GRAF28MY'] == 'Y') {
    $arComponentParameters['PARAMETERS']['LEGEND_WIDTH'] = array(
        "PARENT" => "SETTINGS_GRAF28",
        "NAME" => GetMessage("LEGEND_WIDTH"),
        "TYPE" => "TEXT",
        "DEFAULT" => "200"
    );

    $arComponentParameters['PARAMETERS']['PARAM_INDENT'] = array(
        "PARENT" => "SETTINGS_GRAF28",
        "NAME" => GetMessage("PARAM_INDENT"),
        "TYPE" => "TEXT",
        "DEFAULT" => "230"
    );
}

if (isset($arCurrentValues['SETTINGS_GRAF29']) && $arCurrentValues['SETTINGS_GRAF29'] == 'Y') {
    $arComponentParameters['PARAMETERS']['WIDTH'] = array(
        "PARENT" => "SETTINGS_GRAF29",
        "NAME" => GetMessage("WIDTH"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['HEIGHT'] = array(
        "PARENT" => "SETTINGS_GRAF29",
        "NAME" => GetMessage("HEIGHT"),
        "TYPE" => "TEXT"
    );

    $arComponentParameters['PARAMETERS']['CIRCLE_EXT_LINE'] = array(
        "PARENT" => "SETTINGS_GRAF29",
        "NAME" => GetMessage("CIRCLE_EXT_LINE"),
        "TYPE" => "TEXT",
        "DEFAULT" => "4"
    );

    $arComponentParameters['PARAMETERS']['SPACEBETWEEN_COLUMNS'] = array(
        "PARENT" => "SETTINGS_GRAF29",
        "NAME" => GetMessage("SPACEBETWEEN_GIST25"),
        "TYPE" => "TEXT",
        "DEFAULT" => "80"
    );

    $arComponentParameters['PARAMETERS']['PADDINGLEFT'] = array(
        "PARENT" => "SETTINGS_GRAF29",
        "NAME" => GetMessage("PADDINGLEFT"),
        "TYPE" => "TEXT",
        "DEFAULT" => "150"
    );

    $arComponentParameters['PARAMETERS']['SECTOR1'] = array(
        "PARENT" => "SETTINGS_GRAF29_COLORS",
        "NAME" => GetMessage("SECTOR1"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#73ADD5"
    );

    $arComponentParameters['PARAMETERS']['SECTOR2'] = array(
        "PARENT" => "SETTINGS_GRAF29_COLORS",
        "NAME" => GetMessage("SECTOR2"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#F3C37E"
    );

    $arComponentParameters['PARAMETERS']['SECTOR3'] = array(
        "PARENT" => "SETTINGS_GRAF29_COLORS",
        "NAME" => GetMessage("SECTOR3"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#508FB9"
    );

    $arComponentParameters['PARAMETERS']['SECTOR4'] = array(
        "PARENT" => "SETTINGS_GRAF29_COLORS",
        "NAME" => GetMessage("SECTOR4"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#939BC9"
    );

    $arComponentParameters['PARAMETERS']['SECTOR5'] = array(
        "PARENT" => "SETTINGS_GRAF29_COLORS",
        "NAME" => GetMessage("SECTOR5"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#F2AD5E"
    );

    $arComponentParameters['PARAMETERS']['SECTOR6'] = array(
        "PARENT" => "SETTINGS_GRAF29_COLORS",
        "NAME" => GetMessage("SECTOR6"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#9FCC5F"
    );

    $arComponentParameters['PARAMETERS']['SECTOR7'] = array(
        "PARENT" => "SETTINGS_GRAF29_COLORS",
        "NAME" => GetMessage("SECTOR7"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#7BA38C"
    );

    $arComponentParameters['PARAMETERS']['SECTOR8'] = array(
        "PARENT" => "SETTINGS_GRAF29_COLORS",
        "NAME" => GetMessage("SECTOR8"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#E8908F"
    );

    $arComponentParameters['PARAMETERS']['SECTOR9'] = array(
        "PARENT" => "SETTINGS_GRAF29_COLORS",
        "NAME" => GetMessage("SECTOR9"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#807FC3"
    );

    $arComponentParameters['PARAMETERS']['SECTOR10'] = array(
        "PARENT" => "SETTINGS_GRAF29_COLORS",
        "NAME" => GetMessage("SECTOR10"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#9ECEAA"
    );

    $arComponentParameters['PARAMETERS']['SECTOR11'] = array(
        "PARENT" => "SETTINGS_GRAF29_COLORS",
        "NAME" => GetMessage("SECTOR11"),
        "TYPE" => "COLORPICKER",
        "DEFAULT" => "#C7C3C8"
    );
}


?>