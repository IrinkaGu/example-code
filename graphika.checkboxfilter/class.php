<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;

class GraphikaCheckboxFilter extends \CBitrixComponent
{
    const IBLOCK_ID = 31;

    public function onPrepareComponentParams($arParams)
    {
        return $arParams;
    }

    public function executeComponent()
    {
        if (!Loader::includeModule('iblock')) {
            return;
        }

        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
        $arFilter = Array(
            "IBLOCK_ID"   => self::IBLOCK_ID,
            "ACTIVE_DATE" => "Y",
            "ACTIVE"      => "Y",
            "ID"          => $this->arParams['UNITS_DIAGRAM'],
        );

        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNextElement()) {
            $arProps = $ob->GetProperties();
            $this->arResult["UNITS_DIAGRAM"]["NAME_SHORT"] = $arProps["NAME_SHORT"]["VALUE"];
            $this->arResult["UNITS_DIAGRAM"]["KOEF"] = $arProps["KOEF"]["VALUE"];

        }

        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
        $arFilter = Array(
            "IBLOCK_ID"   => self::IBLOCK_ID,
            "ACTIVE_DATE" => "Y",
            "ACTIVE"      => "Y",
            "ID"          => $this->arParams['UNITS_TABLE'],
        );
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while ($ob = $res->GetNextElement()) {
            $arProps = $ob->GetProperties();
            $this->arResult["UNITS_TABLE"]["NAME_SHORT"] = $arProps["NAME_SHORT"]["VALUE"];
            $this->arResult["UNITS_TABLE"]["KOEF"] = $arProps["KOEF"]["VALUE"];
        }

        $this->includeComponentTemplate();
    }

    public static function getScheduleBudget($typeSchedule)
    {
        $result = array(
            'DATA_DIAGRAM'     => array(),
            'DATA_DESCRIPTION' => array(),
        );

        if (strlen($typeSchedule) > 0) {
            $BD_PG = $GLOBALS['BD_PG'];
            $months = array(
                'january',
                'february',
                'march',
                'april',
                'may',
                'june',
                'july',
                'august',
                'september',
                'october',
                'november',
                'december',
            );

            $data = $BD_PG->getSheduleBudget($typeSchedule);

            $dataDiagram = array();
            $dataDescription = array();
            $names = array();
            foreach ($data as $item) {
                $name = iconv('CP1251', 'UTF-8', $item['naimenovanie']);
                $vals = array();
                if (!in_array($name, $names)) {
                    foreach ($item as $key => $value) {
                        if (in_array($key, $months)) {
                            $vals[] = $value == 't' ? 1 : 0;
                        }
                    }
                    $dataDiagram[] = array(
                        'name' => $name,
                        'order' => $item['id'],
                        'vals' => $vals,
                    );
                }
                $names[] = $name;

                $dataDescription[$item['id']]['name'] = $item['naimenovanie'];
                $dataDescription[$item['id']]['id_name'] = 'point_' . $item['id'];
                $dataDescription[$item['id']]['description'] = nl2br($item['opisanie']);

                $dataDescription[$item['id']]['participants'][] = $item['uchastnik'];
            }

            $result = array(
                'DATA_DIAGRAM'     => $dataDiagram,
                'DATA_DESCRIPTION' => $dataDescription,
            );
        }

        return $result;
    }
}