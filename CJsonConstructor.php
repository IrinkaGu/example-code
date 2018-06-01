<?
class CJsonConstructor{

	function __construct() 	{

	}

	function getRegionGeneralRaskh($data, $koef) {
	    if ($koef === null) {
            $koef = 1;
        }
        $postf = '';
        if (isset($data[0]['kod_go'])) {
            $postf = '_go';
        }
		$result = array(
			$data[0]['plan_rash' . $postf] !== null ? $data[0]['plan_rash' . $postf] * $koef : null,
			$data[0]['fakt_rash' . $postf] !== null ? $data[0]['fakt_rash' . $postf] * $koef : null
//			$data[0]['plan_rash'] !== null ? $data[0]['plan_rash'] : null,
//			$data[0]['fakt_rash'] !== null ? $data[0]['fakt_rash'] : null
		);

		return json_encode($result);
	}

	function getRegionGeneralDokh($data, $koef){
        if ($koef === null) {
            $koef = 1;
        }
        $postf = '';
        if (isset($data[0]['kod_go'])) {
            $postf = '_go';
        }
		$result = array(
			$data[0]['plan_doh' . $postf] !== null ? $data[0]['plan_doh' . $postf] * $koef : null,
			$data[0]['fakt_doh' . $postf] !== null ? $data[0]['fakt_doh' . $postf] * $koef : null
//			$data[0]['plan_doh'] !== null ? $data[0]['plan_doh'] : null,
//			$data[0]['fakt_doh'] !== null ? $data[0]['fakt_doh'] : null
		);

		return json_encode($result);
	}

    /**
     * Gets info about region or district (for graf27-2)
     *
     * @param $data
     * @return string
     */
	public function getDataRegionsIncomes($data)
    {
        $result = array();
        foreach ($data as $keyType => $types) {
            $valuesPlan = array();
            $valuesActual = array();
            foreach ($types as $keySubType => $subtypes) {
                if (is_array($subtypes)) {
                    $valuesPlan[] = array(
                        $keySubType => isset($subtypes['plan']) ? $subtypes['plan'] : 0
                    );
                    $valuesActual[] = array(
                        $keySubType => isset($subtypes['actual']) ? $subtypes['actual'] : 0
                    );
                }
            }
            if (count($valuesPlan) && count($valuesActual)) {
                $result['plan'][] = array(
                    'name' => $keyType,
                    'value' => $valuesPlan
                );
                $result['actual'][] = array(
                    'name' => $keyType,
                    'value' => $valuesActual
                );
            }

        }


        return json_encode($result);
    }

    /**
     * Gets info about region or district (for graf27-pager)
     *
     * @param $data
     * @return string
     */
    public function getDataRegionsCosts($data)
    {
        $result = array();
        foreach ($data as $keyType => $types) {
            if (is_array($types)) {
                $result['plan'][] = array(
                    $keyType => isset($types['plan']) ? $types['plan'] : 0
                );
                $result['actual'][] = array(
                    $keyType => isset($types['actual']) ? $types['actual'] : 0
                );
            }
        }


        return json_encode($result);
    }

	public function getRegionalDataRevenues($data, $koef) {

		$result = array();
		if (count($data) === 1 && !count($data[0])) {
			return json_encode($result);
		}
//		pow($koef, 2)
		foreach ($data as $key => $value) {

			array_push($result, array(
					'name' => isset($value['name']) ? $value['name'] : $key,
					'plan_rash' => $value['plan_rash'] !== '' ? $this->convertToMillion($value['plan_rash']) : '',
					'fakt_rash' => $value['fakt_rash'] !== '' ? $this->convertToMillion($value['fakt_rash']) : '',
					'plan_doh' => $value['plan_doh'] !== '' ? $this->convertToMillion($value['plan_doh']) : '',
					'fakt_doh' => $value['fakt_doh'] !== '' ? $this->convertToMillion($value['fakt_doh']) : '',
					'deficit_plan' => $value['deficit_plan'] !== '' ? $this->convertToMillion($value['deficit_plan']) : '',
					'deficit_fakt' => $value['deficit_fakt'] !== '' ? $this->convertToMillion($value['deficit_fakt']) : ''
				)
			);
		}
		return json_encode($result);
	}

	public function getRegionalRevenues($data)
	{
		$result = array();
		if (count($data) === 1 && !count($data[0])) {
			return json_encode($result);
		}
		foreach ($data as $key => $value) {
			array_push($result, array(
					'name' => $key,
					'plan_doh' => $value['plan_doh'] !== '' ? $value['plan_doh'] * 0.000001 : '',
					'fakt_doh' => $value['fakt_doh'] !== '' ? $value['fakt_doh'] * 0.000001 : ''
				)
			);
		}

		return json_encode($result);
	}

    /**
     * Gets data for graf-26 from info about region or district (only plan values)
     *
     * @param $data
     * @param $nameType
     * @return string
     */
	public function getRevenuesRegionDistrict($data, $nameType)
	{
		$result = array();
		if (count($data) === 1 && !count($data[0]) && !empty($nameType)) {
			return json_encode($result);
		}
		foreach ($data as $key => $value) {
			array_push($result, array(
					'name' => $key,
                    'fact' => $value[$nameType . '_fakt'] * 1000,
                    'plan' => $value[$nameType . '_plan'] * 1000
				)
			);
		}

		return json_encode($result);
	}

    /**
     * Gets regional costs (for graf26)
     *
     * @param $data
     * @param $convertYear - if yes, then converts key (if key - date) to year
     * @return string
     */
    public function getRegionalCosts($data, $convertYear = false)
    {
        $result = array();
        if (count($data) === 1 && !count($data[0])) {
            return json_encode($result);
        }
        foreach ($data as $key => $value) {
            array_push($result, array(
                    'name' => $convertYear ? date('Y', strtotime($key)) : $key,
                    'plan_rash' => $value['plan_rash'] !== '' ? $value['plan_rash'] * 0.000001 : '',
                    'fakt_rash' => $value['fakt_rash'] !== '' ? $value['fakt_rash'] * 0.000001 : ''
                )
            );
        }

        return json_encode($result);
    }

	public function getRegionalRevenuesAutocomplete($data)
	{
		$result = array();
		if (count($data) === 1 && !count($data[0])) {
			return json_encode($result);
		}
		foreach ($data as $key => $value) {
			array_push($result, array(
					'label' => iconv('CP1251', 'UTF-8', $value['naznv_vida_doh']),
					'value' => str_replace(' ', '', $value['kbk_doh'])
				)
			);
		}

		return json_encode($result);
	}

	public function convertToMillion($number)
	{
		$number = floor($number);
		$newNumber = $number * 0.000001;
		$len = iconv_strlen ((string) $number);
		$ost = $newNumber - floor($newNumber);
		if ($ost != 0) {
            if (iconv_strlen((string) abs($newNumber)) < iconv_strlen((string) abs($number))) {
                if (bcmod($number, 10) == 0) {
                    $len++;
                }
                $newNumber = str_pad($newNumber, $len, '0');
            } else {
                if (bcmod($number, 10) == 0) {
                    $len++;
                    $newNumber = str_pad($newNumber, $len, '0');
                }
            }
        }

		return (string) $newNumber;
	}

    public function getMunicipalDebt($data)
    {
        $result = array();
        foreach ($data as $value) {
            array_push($result, array(
                    iconv('CP1251', 'UTF-8', $value['nazv_formi_dolg_obyzat']) => $value['pogasheno']
                )
            );
        }

        return json_encode($result);
    }

	public function getDataComparasionSFD($data)
    {
        $result = array();
        if (count($data) === 1 && !count($data[0])) {
            return json_encode($result);
        }
        foreach ($data as $key => $value) {
            array_push($result, array(
                    'name' => iconv('CP1251', 'UTF-8', $value['nazv_subekta_rf']),
                    'dohodPlan' =>  ( $value['dohodi_subekta_rf'] * 1),
                    'rashodPlan' => ( $value['rashodi_subekta_rf'] * 1),
                    'deficitPlan' => ( $value['deficit_proficit'] * 1)
                )
            );
        }

        return json_encode($result);
    }

    public function getDataComparasionSFDByYears($data, $kodSubject)
    {
        $result = array();
        if (!$data || !count($data)) {
            return json_encode($result);
        }

        foreach ($data as $key => $value) {
            array_push($result, array(
                    'name' => $key,
                    'vol' => array(
                        'name' => iconv('CP1251', 'UTF-8', $value['volgograd']['nazv_subekta_rf']),
                        'dohodPlan' => ( $value['volgograd']['dohodi_subekta_rf'] * 1),
                        'rashodPlan' => ( $value['volgograd']['rashodi_subekta_rf'] * 1),
                        'deficitPlan' => ( $value['volgograd']['deficit_proficit'] * 1)
                    ),
                    'obl' => array(
                        'name' => iconv('CP1251', 'UTF-8', $value['subject_' . $kodSubject]['nazv_subekta_rf']),
                        'dohodPlan' => ( $value['subject_' . $kodSubject]['dohodi_subekta_rf'] * 1),
                        'rashodPlan' => ( $value['subject_' . $kodSubject]['rashodi_subekta_rf'] * 1),
                        'deficitPlan' => ( $value['subject_' . $kodSubject]['deficit_proficit'] * 1)
                    ),
                )
            );
        }

        return json_encode($result);
    }

    public function getAllDataCompareSFDByYears($data)
    {
        $result = array();
        if (!$data || !count($data)) {
            return json_encode($result);
        }

        foreach ($data as $key => $values) {
            $result[$key] = $values;
        }

        foreach ($result as $key => $values) {
            foreach ($values as $index => $value) {
                $result[$key][$index]['nazv_subekta_rf'] = iconv('CP1251', 'UTF-8', $value['nazv_subekta_rf']);
                $result[$key][$index]['deficit_proficit'] = $value['deficit_proficit'] . "";
            }
        }

        return json_encode($result);
    }

    /**
     * Gets data by kod indicator and year
     *
     * @param $data
     * @param $kodIndicator
     * @return string
     */
    public function getDataSocioEcon($data, $kodIndicator)
    {
        $result = array();
        $curYear = date('Y');
        if (!count($data) || !count(current($data)) || !$kodIndicator) {
            return json_encode($result);
        }
        foreach ($data as $year => $values) {
            foreach ($values as $indicator) {
                if ($indicator['kod_pokazat'] === $kodIndicator) {
                    array_push($result, array(
                            'name' => $year,
                            'plan_doh' => $year > $curYear ? $indicator['znach_pokaz_plan']
                                : $indicator['znach_pokaz_plan'],
                            'fakt_doh' => $indicator['znach_pokaz_fact']
                        )
                    );
                }
            }
        }

        return json_encode($result);
    }

    /**
     * Gets all data from array
     *
     * @param $data
     * @return string
     */
    public function getAllDataSocioEcon($data)
    {
        $result = array();
        if (!count($data) || !count(current($data))) {
            return json_encode($result);
        }
        foreach ($data as $year => $values) {
            foreach ($values as $indicator) {
                $indicator['nazv_pokazat'] = iconv('CP1251', 'UTF-8', $indicator['nazv_pokazat']);
                $result[$year][] = $indicator;
            }
        }

        return json_encode($result);
    }

    public function getDataTypesCostsGraf29($data)
    {
        $result = array();
        foreach ($data as $values) {
            $curData = array();
            foreach ($values as $key => $item) {
                if (is_array($item)) {
                    $curData[$key] = $item['sum_actual'];
                } else {
                    $curData[$key] = $item;
                }
            }
            if (count($curData)) {
                $result[] = $curData;
            }
        }

        return json_encode($result);
    }

    public function getDataGRBSGraf29($data)
    {
        $result = array();
        foreach ($data as $values) {
            $curData = array();
            foreach ($values as $key => $item) {
                $newKey = iconv('CP1251', 'UTF-8', $item['name_grbs']);
                if (is_array($item)) {
                    $curData[$newKey] = $item['sum_actual'];
                } else {
                    $curData[$key] = $item;
                }
            }
            if (count($curData)) {
                $result[] = $curData;
            }
        }

        return json_encode($result);
    }

    public function getDataGRBSGraf43($data)
    {
        $result = array();
        foreach ($data as $name => $values) {
            $curData = array();
            foreach ($values as $key => $item) {
                if (is_array($item)) {
                    $curData[] = array(
                        $key => $item['sum_actual'] * 0.001
                    );
                }
            }
            if (count($curData)) {
                $result[] = array(
                    'name' => $name,
                    'vals' => $curData
                );
            }
        }

        return json_encode($result);
    }

    /**
     * Gets data for graf26 from array with costs (by costs types or one branches)
     *
     * @param $data
     * @param $kbk
     * @return string
     */
    public function getDataGraf26FromConsolCosts($data, $kbk)
    {
        $result = array();
        foreach ($data as $values) {
            $year = 0;
            $plan = 0;
            $actual = 0;
            $flagExist = false;
            foreach ($values as $key => $item) {
                $pattern = '/000[\d]{4}0000000000' . $kbk .'/';
                if (is_array($item) && preg_match($pattern, $item['kbk'])) {
                    $plan = $item['sum_plan'] * 0.000001;
                    $actual = $item['sum_actual'] * 0.000001;
                    $flagExist = true;
                } else if (!is_array($item)) {
                    $year = $item;
                }
            }
            if ($flagExist && !empty($year)) {
                $result[] = array(
                    'name' => $year,
                    'plan_doh' => $plan,
                    'fakt_doh' => $actual
                );
            }
        }

        return json_encode($result);
    }

    /**
     * Gets data for Graf28 from consolidated costs array or regional costs (if filter by branches) - only actual
     *
     * @param $data
     * @return string
     */
    public function getDataGraf28FromCosts($data)
    {
        $result = array();
        foreach ($data as $key => $values) {

            if (is_array($values)) {
                $result[] = array(
                    $key => $values['sum_plan']
                );
            }
        }

        return json_encode($result);
    }

    /**
     * Gets data for Graf28 from regional costs (if filter by types, because adding grbs) - only actual
     *
     * @param $data
     * @return string
     */
    public function getDataGraf28FromRegCostsBranches($data)
    {
        $result = array();
        foreach ($data as $key => $values) {
            if (is_array($values)) {
                $result[] = array(
                    $key => $values['sum_plan'] * 1
                );
            }
        }

        return json_encode($result);
    }

    /**
     * Gets data for graf-40 from array an institution info (revenues or costs)
     *
     * @param array $data
     * @param string $legendNamePlan - legend name for plan values
     * @param string $legendNameActual - legend name for actual values
     * @return string
     */
    public function getDataGraf40FromDataInst($data, $legendNamePlan, $legendNameActual, $nameField)
    {
        $legendNamePlan = iconv('CP1251', 'UTF-8', $legendNamePlan);
        $legendNameActual = iconv('CP1251', 'UTF-8', $legendNameActual);

        $result = array();

        foreach ($data as $finLevel) {
            $result[] = array(
                'name' => $finLevel[$nameField],
                'vals' => array(
                    array(
                        $legendNamePlan => $finLevel['plan_value']
                    ),
                    array(
                        $legendNameActual => $finLevel['actual_value']
                    )
                )
            );
        }
        return json_encode($result);
    }

    public function convertDataConsolCostsYears($data)
    {
        $result = array();
        foreach ($data as $values) {
            $convertData = array();
            foreach ($values as $key => $item) {
                $keyNew = $key;
                if (is_array($item)) {
                    $keyNew = iconv('CP1251', 'UTF-8', $key);
                }
                $keyNew = $keyNew && is_string($keyNew) ? $keyNew : $key;

                $convertData[$keyNew] = $item;
            }
            $result[] = $convertData;
        }
        return json_encode($result);
    }

    public function getCostsAutocomplete($data)
    {
        $result = array();
        foreach ($data as $key => $values) {
            $keyName = 'nazvanie_vida_rash';
            if (array_key_exists('nazvanie_otrasli', $values)) {
                $keyName = 'nazvanie_otrasli';
                $values[$keyName] = mb_strtoupper($values[$keyName][0], 'CP1251')
                    . substr(mb_strtolower($values[$keyName], 'CP1251'), 1);
            } else if (array_key_exists('naimenovanie_grbs', $values)) {
                $keyName = 'naimenovanie_grbs';
            }
            $kodName = 'kod_vada_rash';
            if (array_key_exists('kod_otrasli', $values)) {
                $kodName = 'kod_otrasli';
            } else if (array_key_exists('kod_grbs', $values)) {
                $kodName = 'kod_grbs';
            }
            array_push($result, array(
                    'label' => iconv('CP1251', 'UTF-8', $values[$keyName]),
                    'value' => str_replace(' ', '', $values[$kodName])
                )
            );
        }
        return json_encode($result);
    }

    public function convertDataTypesBranchesCosts($data)
    {
        $result = array();
        foreach ($data as $key => $values) {
            if (is_array($values)) {
                $keyName = array_key_exists('nazvanie_vida_rash', $values) ? 'nazvanie_vida_rash' : 'nazvanie_otrasli';
                $kodName = array_key_exists('kod_vada_rash', $values) ? 'kod_vada_rash' : 'kod_otrasli';
                $textValuePlan = array();
                $textValueActual = array();
                $valuesTypes =  array(
                    'id' =>  $values['id'],
                    $keyName =>  iconv('CP1251', 'UTF-8', $values[$keyName]),
                    $kodName =>  $values[$kodName]
                );
                if (isset($values['text_plan'])) {
                    foreach ($values['text_plan'] as $grbs) {
                        $textValuePlan[] = array(
                            'kod_grbs' => $grbs['kod_grbs'],
                            'naimenovanie_grbs' => iconv('CP1251', 'UTF-8', $grbs['naimenovanie_grbs'])
                        );
                    }
                    $valuesTypes = array_merge($valuesTypes, array('text_plan' => $textValuePlan));
                }
                if (isset($values['text_actual'])) {
                    foreach ($values['text_actual'] as $grbs) {
                        $textValueActual[] = array(
                            'kod_grbs' => $grbs['kod_grbs'],
                            'naimenovanie_grbs' => iconv('CP1251', 'UTF-8', $grbs['naimenovanie_grbs'])
                        );
                    }
                    $valuesTypes = array_merge($valuesTypes, array('text_actual' => $textValuePlan));
                }
                $valuesSum = array();
                if (isset($values['sum_plan'])) {
                    $valuesSum['sum_plan'] = $values['sum_plan'];
                }
                if (isset($values['sum_actual'])) {
                    $valuesSum['sum_actual'] = $values['sum_actual'];
                }
                $valuesTypes = count($valuesSum) ? array_merge($valuesTypes, $valuesSum) : $valuesTypes;

                $result[$key] = $valuesTypes;
            } else {
                $result[$key] = $values;
            }
        }
        return json_encode($result);
    }

    public function convertDataListGRBSCosts($data)
    {        
        $result = array();
        foreach ($data as $values) {
            $result[] = array(
                'kod_grbs' => $values['kod_grbs'],
                'naimenovanie_grbs' => iconv('CP1251', 'UTF-8', $values['naimenovanie_grbs'])
            );
        }
        return json_encode($result);
    }

    /**
     * Convert data grbs by years
     *
     * @param $data
     * @return string
     */
    public function convertDataGRBSCosts($data)
    {
        $result = array();
        foreach ($data as $values) {
            $flagExist = false;
            $valuesGRBS = array();
            foreach ($values as $key => $item) {            
                if (is_array($item)) {                    
                    $valuesGRBS[$key] = array(                    
                        //'naimenovanie_grbs' =>  iconv('CP1251', 'UTF-8', $values['naimenovanie_grbs']),
                        'sum_plan' => $item['sum_plan'],
                        'sum_actual' => $item['sum_actual'],
                        'grbs' =>  $item['grbs']
                    );        
                    $flagExist = true;
                } else {
                    $valuesGRBS[$key] = $item;
                }
            }
            if ($flagExist && count($valuesGRBS)) {
                $result[] = $valuesGRBS;
            }
        }
        
        return json_encode($result);
    }

    /**
     * Convert data grbs by date
     *
     * @param $data
     * @return string
     */
    public function convertDataGRBSCostsDate($data)
    {
        $result = array();
        foreach ($data as $key => $values) {
            if (is_array($values)) {
                $result[$key] = array(
                    //'naimenovanie_grbs' =>  iconv('CP1251', 'UTF-8', $values['naimenovanie_grbs']),
                    'sum_plan' => $values['sum_plan'],
                    'sum_actual' => $values['sum_actual'],
                    'grbs' =>  $values['grbs']
                );
            } else {
                $result[$key] = $values;
            }
        }

        return json_encode($result);
    }

    public function getDataMainMap($data)
    {
        $result = array();
        foreach ($data as $level => $list) {
            foreach ($list as $code => $values) {
                $go = isset($values[0]['plan_doh_go']) || isset($values[0]['plan_rash_go']) ? '_go' : '';
                $planRev = isset($values[0]['plan_doh' . $go]) ? $values[0]['plan_doh' . $go] * 1 : 0;
                $actualRev = isset($values[0]['fakt_doh' . $go]) ? $values[0]['fakt_doh' . $go] * 1 : 0;
                $planCosts = isset($values[0]['plan_rash' . $go]) ? $values[0]['plan_rash' . $go] * 1: 0;
                $actualCosts = isset($values[0]['fakt_rash' . $go]) ? $values[0]['fakt_rash' . $go] * 1: 0;
                $defPlan = isset($values[0]['def_plan']) ? $values[0]['def_plan'] * 1: 0;
                $defActual = isset($values[0]['def_fact']) ? $values[0]['def_fact'] * 1: 0;
                $result[$level][$code] = array(
                    $planRev, $actualRev, $planCosts, $actualCosts, $defPlan, $defActual
                );
            }
        }

        return json_encode($result);
    }

    public function getDataInfoRegionsDistricts($data, $getLevel)
    {
        $result = array();
        foreach ($data as $level => $list) {
            foreach ($list as $code => $values) {
                $result[$level][$code] = array(
                    iconv('CP1251', 'UTF-8', $values['center']),
                    $values['naselenie'],
                    $values['territory'],
                    0,
                    iconv('CP1251', 'UTF-8', $values['name'])
                );
            }
        }

        return json_encode($result[$getLevel]);
    }

    public function getDataGraf37FromSocProjectFinSources($data)
    {
        $result = array();
        foreach ($data as $idSource => $projects) {
            foreach ($projects as $values) {
                $result[$idSource][] = array(
                    $values['name'] => array(
                        $values['actual'] * 1,
                        $values['plan'] * 1
                    )
                );
            }
        }
        return json_encode($result);
    }

    public function getDataGraf42FromSocProjectFinSources($data)
    {
        $result = array();
        foreach ($data as $key => $values) {
            foreach ($values as $item) {
                $kodProject = $key === 'projects' ? $item['kod_proekta'] : '';
                $keyNew = iconv('CP1251', 'UTF-8', $item['nazv_istochn_fin']);
                if (!empty($kodProject)) {
                    $result[$key]['plan'][$kodProject][] = array($keyNew => $item['plan_pokaz'] * 1);
                    $result[$key]['actual'][$kodProject][] = array($keyNew => $item['fact_pokaz'] * 1);
                } else {
                    $result[$key]['plan'][] = array($keyNew => $item['plan_pokaz'] * 1);
                    $result[$key]['actual'][] = array($keyNew => $item['fact_pokaz'] * 1);
                }

            }
        }
        return json_encode($result);
    }

    /**
     * Gets data for graf38 from social politic (volumes and structure) on the social politic page
     *
     * @param $data
     * @return string
     */
    public function getDataGraf36FromSocPoliticVolumesStructure($data)
    {
        $result = array();
        foreach ($data as $key => $items) {
            foreach ($items as $code => $values) {
                if (is_array($values)) {
                    $newValues = array(
                        'name' => iconv('CP1251', 'UTF-8', $values['name']),
                        'pic' => $values['icon'],
                        'plan' => $this->rubFormat($values['plan'], true, false, '.'),
                        'fact' => $this->rubFormat($values['actual'], true, false, '.')
                    );
                    if (isset($values['values'])) {
                        foreach ($values['values'] as $el) {
                            $newValues['vals'][] = array(
                                'name' => iconv('CP1251', 'UTF-8', $el['name']),
                                'pic' => $el['icon'],
                                'plan' => $this->rubFormat($el['plan'], true, false, '.'),
                                'fact' => $this->rubFormat($el['actual'], true, false, '.')
                            );
                        }
                    }
                    $result[$key][] = $newValues;
                }
            }
        }
        return json_encode($result);
    }

    function getDataForGist4($data){
        $result = array();
		foreach ($data as $value) {
			array_push($result, array(
					'date' => $value['date'],
					'factIn' => (float) $value['factIn'],
					'planIn' => (float) $value['planIn'],
					'factOut' => (float) $value['factOut'],
					'planOut' => (float) $value['planOut']
				)
			);
		}
		return json_encode($result);

    }


    function rubFormat($number, $flagDiff = true, $space = true, $delimeter = ',') {
        if (empty($number)) {
            $number = 0;
        }
        $diff = $flagDiff ? 0.001 : 1;
        $chSpace = $space ? ' ' : '';
        return number_format(($number * $diff), 1, $delimeter, $chSpace);
    }

    function rubFormat_3($number) {
        if (empty($number)) {
            $number = 0;
        }
        return number_format(($number ), 1, ',', ' ');
    }



}

?>