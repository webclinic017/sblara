<?php 
namespace App\Classes;
/**
* SB Full configurable table
*/
class Table
{
	public $columns;
	public $data;

	private $instrument_ids;
	private $settings; 
	private $attibutes;
	private $matrix;

	function __construct($ids = [])
	{
		$this->setInstrumentIds($ids);
	}

    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

	public function serve()
	{
		return $this->generateData();
		
	}


	public function data()
	{
		return $this->getData();
	}

	public function toJson()
	{
		return json_encode($this);
	}

    /**
     * @return mixed
     */
    public function getAttibutes()
    {
        return $this->attibutes;
    }
    /**
     * @return mixed
     */
    public function generateData()
    {
        $matrix = $this->getMatrix();

        $this->setColumns();
        $this->instrument_ids = \App\Instrument::whereNotIn('id', excludedInstruments())->get()->pluck('id');

        foreach ($this->getInstrumentIds() as $instrument_id) {
             if(!isset($matrix[$instrument_id])){continue;}
                $data = new \StdClass;
            foreach ($this->getColumns() as $column) {
                $column = (array) $column;
                @$d = $matrix[$instrument_id]->{$column['field']};
                if($column['field']  == 'trading_code'){
                    $d = "<a class='instrument_hover' data-id='{$matrix[$instrument_id]->instrument_id}' >$d</a>";
                }
                if($column['field']  == 'change' || $column['field'] == 'percent_change' ){
                    if($d < 0){
                        $color = 'red';
                    }else{
                        $color = 'green';
                    }
                    if($column['field'] == 'percent_change'){
                        $d .= "%";
                    }
                    $d = "<span style='color:$color'>$d</span>";
                }
                @$data->{$column['field']} = $d;
            }
            $data->id = $instrument_id;
            $this->data[] = $data;
        }   
        
        return $this;
    }

    /**
     * @return mixed
     */
    public function getColumns()
    {

        if(!$this->columns){
             $this->setColumns();
        }

        return $this->columns;
    }

    /**
     * @param mixed $columns
     *
     * @return self
     */
    public function setColumns()
    {
        if($this->layout){
            $layout = $this->layout;
            foreach (json_decode($layout->config)->columns as $col) {
                $col->sortable  = true;
                    $this->columns[] = $col;
            }
            return $this;
        }
        $this->columns = config('table.columns');
        $i = 0;
        // foreach (\App\Meta::all() as $meta) {
        //     // $i++;
        //     // if($i > 10){break;}
        //     $this->columns[] = ["field" => $meta->meta_key, 'sortable' => true, 'searchable' => true, "title" => $meta->meta_title];
        // }
        // dd($this->columns);
        $this->columns[] = ['field' => 'face_value', 'sortable' => true, 'searchable' => true, 'title' => 'Test title'];
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @param mixed $settings
     *
     * @return self
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInstrumentIds()
    {
        return $this->instrument_ids;
    }

    /**
     * @param mixed $instrument_ids
     *
     * @return self
     */
    public function setInstrumentIds($instrument_ids)
    {
        $this->instrument_ids = $instrument_ids;

        return $this;
    }

    /**
     * @param mixed $attibutes
     *
     * @return self
     */
    public function setAttibutes($attibutes)
    {
        $this->attibutes = $attibutes;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    public function generateMatrix()
    {
    	$query = "
			SELECT 

                instrument_code as trading_code,
				instrument_id,
				LEFT(quote_bases, 1) as category,
				open_price as open,
				high_price as high,
				low_price as low,
				close_price as close,
				yday_close_price as ycp,
				total_trades as trade,
				total_volume as volume,
				total_value as value,

                IF(pub_last_traded_price = 0, spot_last_traded_price, pub_last_traded_price) ltp,
                ROUND(TRUNCATE(( close_price - yday_close_price), 2), 1) as `change`,
                ROUND(TRUNCATE(((close_price - yday_close_price)/yday_close_price ) * 100, 2), 1) as `percent_change`

			FROM instruments 
            
            LEFT JOIN data_banks_intradays intraday on instruments.id = intraday.instrument_id

			WHERE 
                intraday.batch = ".lastBatch()."
                and sector_list_id not in (24, 25, 5, 4)
                and instrument_code is not null

    	";

    	$this->setMatrix(collect(\DB::select($query))->keyBy('instrument_id'))->setFundamentalData();
    	return $this;
    }

    /**
     * @param mixed $matrix
     *
     * @return self
     */
    public function setMatrix($matrix)
    {
        $this->matrix = $matrix;
        return $this;
    }

    /**
     * @param mixed $matrix
     *
     * @return self
     */
    public function setFundamentalData()
    {
        $q = "
               SELECT metas.id, instrument_id, meta_value, meta_key, meta_title
                  FROM fundamentals
                    LEFT JOIN metas ON metas.id = fundamentals.`meta_id`
                WHERE   is_latest = 1 
                    AND meta_key IS NOT NULL
        ";
        $rows = \DB::select($q);
        foreach ($rows as $row) {
            if(!isset($this->matrix[$row->instrument_id])){
                continue;
            }
            if($row->meta_key == 'instrument_id'){continue;}
            $this->matrix[$row->instrument_id]->{$row->meta_key} = $row->meta_value;
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMatrix()
    {
    	if(!$this->matrix){
    		$this->generateMatrix();
    	}
        return $this->matrix;
    }


    public function allColumns()
    {
        $cols = config('table.columns');
        // dd($cols);
        foreach (\App\Meta::where('show_in_table', 1)->get() as $column) {
            $cols[] = ['field' => $column->meta_key, 'title' => $column->meta_title];
        }
        return $cols ;
    }
}