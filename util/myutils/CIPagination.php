<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 6/10/2015
 * Time: 3:19 AM
 */

class CIPagination
{
    protected $current_page;
    /* Default is 10 rows per page */
    protected $num_per_page = 10;
    /* total rows count */
    protected $total_item_rows;
    /* matched rows count */
    protected $total_searched_rows;
    /* matched rows content */
    protected $content;
    /* base url */
    protected $base_url;
    /* num links */
    protected $num_links = 5;
    /* attributes */
    protected $attributes = array('class' => 'btn btn-xs btn-default');

    /* Controller itself */
    protected $CThis;

    /* Paginating data object */
    protected $model;
    /* Final predicates */
    protected $predicates = '';
    /* This predicates is Strict or Loose is depends on the $is_strict_predicate_mode_activate variable */
    protected $append_predicates = '';
    /* This type of predicates will be concat with AND */
    protected $append_strict_predicates = '';
    /* This type of predicates will be concat with OR */
    protected $append_loose_predicates = '';
    protected $fuzzy_query = array();

    /* Search mode */
    public static $FUZZY_SEARCH = false;
    public static $PRECISE_SEARCH = true;
    /* Predicate mode */
    public static $LOOSE_PREDICATE = false;
    public static $STRICT_PREDICATE = true;

    /* Is precise search mode activated */
    protected $is_precise_search_mode_activate = false;
    /* Is strict predicate mode activated */
    protected $is_strict_predicate_mode_activate = false;


    /* DEBUG queries */
    public static $DEBUG_GET_CONTENT_QUERY;

    public function __construct( $initConfig )
    {
        $this->is_precise_search_mode_activate = isset( $initConfig['search_mode'] ) && trim( $initConfig['search_mode'] ) != '' ? $initConfig['search_mode'] : $this->is_precise_search_mode_activate;
        $this->is_strict_predicate_mode_activate = isset( $initConfig['predicate_mode'] ) && trim( $initConfig['predicate_mode'] ) != '' ? $initConfig['predicate_mode'] : $this->is_strict_predicate_mode_activate;

        $paginationLimits = array('per_page');

        /* Initialize base url */
        $this->base_url = $initConfig['base_url'];

        /* Initialize num links */
        $this->num_links = $initConfig['num_links'] != null ? $initConfig['num_links'] : $this->num_links;

        /* Initialize attributes */
        $this->attributes = $initConfig['attributes'] != null ? $initConfig['attributes'] : $this->attributes;

        /* Initialize customized CI Controller */
        $this->CThis = $initConfig['CThis'];

        /* Initialize Model */
        $this->model = new $initConfig['Model'];

        if (isset($_SERVER['QUERY_STRING'])) {
            parse_str($_SERVER['QUERY_STRING'], $_GET);
        }
        if( array_key_exists( 'per_page', $_GET ) )
        {
            $this->current_page = $_GET['per_page'];
        }
        else
        {
            $this->current_page = 1;
        }

        $predicatesIndex = 0;
        /* Default predicates, modifiable later on */
        /* 1. Assign query params to Model fields */
        /* 2. Assign available strict/precise mode predicates */
        foreach( $_GET as $key=>$val )
        {
            /* Ignore fixed pagination limits and specified model fields */
            if( ! in_array( $key, $paginationLimits ) )
            {
                $this->model->$key = $val;

                if( ( ( ! isset( $initConfig['prevented_fields'] ) || empty( $initConfig['prevented_fields'] ) ) ||
                    ! in_array( $key, $initConfig['prevented_fields'] ) ) )
                {
                    /* If not first predicate */
                    if( $predicatesIndex > 0 )
                    {
                        /* If strict predicate mode activated then use AND for concatenation */
                        if( $this->is_strict_predicate_mode_activate )
                        {
                            $this->predicates .= ' AND ';
                        }
                        /* Else is loose predicate mode activated then use OR for concatenation */
                        else
                        {
                            $this->predicates .= ' OR ';
                        }
                    }

                    /* field IS NULL */
                    if( $val == 'NULL' )
                    {
                        $this->predicates .= ' '.$key.' IS NULL ';

                    }

                    /* Else if precise search mode activated then field = value */
                    else if( $this->is_precise_search_mode_activate )
                    {
                        $this->predicates .= ' '.$key.' = \''.$val.'\' ';
                        $predicatesIndex++;
                    }

                    /* Else if fuzzy search mode activated then field like %value% */
                    else
                    {
                        $this->fuzzy_query = array_merge( array( $key => $val  ), $this->fuzzy_query );
//                        $this->predicates .= ' '.$key.' = \''.$val.'\' ';
                    }

                }
            }
        }
    }

    function initialize( $pageConfig )
    {
        $this->paramsBuilder( $pageConfig );

        $this->CThis->load->library('pagination');

        $pageNo = $this->current_page <= 1 ? 1 : $this->current_page;
        // If $pageNo==0 then pageOffset is 0, then start from 0
        // If $pageNo!=0 then pageOffset N*pageSize($pageConfig['per_page'])
        $pageOffset = ($pageNo - 1) * $this->num_per_page;

        $this->predicatesBuilder( $pageConfig );

        if( isset( $pageConfig['distinct'] ) && $pageConfig['distinct'] )
        {
            $this->CThis->db->distinct();
        }
        if( isset( $pageConfig['selectedRows'] ) )
        {
            $this->CThis->db->select($pageConfig['selectedRows']);
        }
        if( isset( $pageConfig['order_by'] ) && $pageConfig['order_by'] != '' )
        {
            $this->CThis->db->order_by( $pageConfig['order_by'] );
        }

        /** If order by another table's field
         */
        if( isset( $pageConfig['order_by_join_table'] ) && $pageConfig['order_by_join_table'] != '' )
        {
            $join_table_order_by = '';
            $join_field_str = '';
            $join_field_assign_to_column_str = '';

            foreach( $pageConfig['order_by_join_table']['order_by'] as $order_by )
            {
                if( $join_table_order_by != '' )
                {
                    $join_table_order_by .= ', ';
                }
                $join_table_order_by .= 't2.' . $order_by['field'] . ' ' . $order_by['sort'];

                if( $join_field_str != '' )
                {
                    $join_field_str .= ', ';
                }
                if( ! isset( $join_table_order_by['is_assign_to_column'] ) || $join_table_order_by['is_assign_to_column'] )
                {
                    if( $join_field_assign_to_column_str != '' )
                    {
                        $join_field_assign_to_column_str .= ', ';
                    }
                }
                $join_field_str .= $order_by['field'];
            }

            if( isset( $pageConfig['order_by_join_table']['field'] ) )
            {
                $predicate = '';
                if( isset( $pageConfig['order_by_join_table']['field_nullable'] ) && ! $pageConfig['order_by_join_table']['field_nullable'] )
                {
                    foreach( $pageConfig['order_by_join_table']['field_nullable'] as $field_nullable )
                    {
                        if( ! $field_nullable['nullable'] )
                        {
                            if( $predicate != '' )
                            {
                                $predicate .= ' AND ';
                            }
                            else
                            {
                                $predicate .= ' WHERE ';
                            }
                            $predicate .= $field_nullable['field'] . ' IS NOT NULL';
                        }
                    }
                }
                if( isset( $pageConfig['order_by_join_table']['join_predicate'] ) )
                {
                    foreach( $pageConfig['order_by_join_table']['join_predicate'] as $join_predicate )
                    {
                        if( $predicate != '' )
                        {
                            $predicate .= ' AND ';
                        }
                        else
                        {
                            $predicate .= ' WHERE ';
                        }

                        $predicate .= $join_predicate['field'] . ' = ' . $join_predicate['value'];
                    }
                }

                $this->CThis->db->join('(SELECT' . ( isset( $pageConfig['order_by_join_table']['distinct'] ) && $pageConfig['order_by_join_table']['distinct'] ? ' DISTINCT' : '' ) . ' ' . $pageConfig['order_by_join_table']['field'] . ', ' . $join_field_str . ' FROM ' . $pageConfig['order_by_join_table']['table'] . ' ' . $predicate . ') t2 ', 't2.' . $pageConfig['order_by_join_table']['field'] . ' = t1.' . $pageConfig['order_by_join_table']['field'] );
            }
            else if( isset( $pageConfig['order_by_join_table']['t1_field'] ) && isset( $pageConfig['order_by_join_table']['t2_field'] ) )
            {
                $extra_fields = '';
                if( isset( $pageConfig['order_by_join_table']['field_extra'] ) )
                {
                    foreach( $pageConfig['order_by_join_table']['field_extra'] as $field_extra )
                    {
                        if( $extra_fields != '' )
                        {
                            $extra_fields .= ', ';
                        }
                        $extra_fields .= $field_extra['field'];
                    }
                }

                $predicate = '';
                if( isset( $pageConfig['order_by_join_table']['field_nullable'] ) )
                {
                    foreach( $pageConfig['order_by_join_table']['field_nullable'] as $field_nullable )
                    {
                        if( ! $field_nullable['nullable'] )
                        {
                            if( $predicate != '' )
                            {
                                $predicate .= ' AND ';
                            }
                            else
                            {
                                $predicate .= ' WHERE ';
                            }
                            $predicate .= $field_nullable['field'] . ' IS NOT NULL';
                        }
                    }
                }
                if( isset( $pageConfig['order_by_join_table']['join_predicate'] ) )
                {
                    foreach( $pageConfig['order_by_join_table']['join_predicate'] as $join_predicate )
                    {
                        if( $predicate != '' )
                        {
                            $predicate .= ' AND ';
                        }
                        else
                        {
                            $predicate .= ' WHERE ';
                        }

                        $predicate .= $join_predicate['field'] . ' = ' . $join_predicate['value'];
                    }
                }
                $group_by = '';
                $group_by_field_assign_to_column = '';
                if( isset( $pageConfig['order_by_join_table']['field_group_by'] ) )
                {
                    foreach( $pageConfig['order_by_join_table']['field_group_by'] as $field_group_by )
                    {
                        if( $group_by != '' )
                        {
                            $group_by .= ', ';
                        }
                        $group_by .= $field_group_by['field'];

                        if( ! isset( $field_group_by['is_assign_to_column'] ) || $field_group_by['is_assign_to_column'] )
                        {
                            if( $group_by_field_assign_to_column != '' )
                            {
                                $group_by_field_assign_to_column .= ', ';
                            }
                            $group_by_field_assign_to_column .= $field_group_by['field'];
                        }
                    }
                }
                $this->CThis->db->join('(SELECT' . ( isset( $pageConfig['order_by_join_table']['distinct'] ) && $pageConfig['order_by_join_table']['distinct'] ? ' DISTINCT' : '' ) . ' ' . $pageConfig['order_by_join_table']['t2_field'] . ', ' . $extra_fields . ( $extra_fields != '' && $join_field_assign_to_column_str != '' ? ', ' . $join_field_assign_to_column_str : $join_field_assign_to_column_str ) . ( ( $extra_fields != '' || $join_field_assign_to_column_str != '' ) && $group_by_field_assign_to_column != '' ? ', ' . $group_by_field_assign_to_column : $group_by_field_assign_to_column ) . ' FROM ' . $pageConfig['order_by_join_table']['table'] . ' ' . $predicate . ' ' . ( $group_by != '' ? ' GROUP BY ' . $group_by : '' ) . ') t2 ', 't2.' . $pageConfig['order_by_join_table']['t2_field'] . ' = t1.' . $pageConfig['order_by_join_table']['t1_field'] );
            }

            $this->CThis->db->order_by( $join_table_order_by );
        }

        /** If join table
         */
        if( isset( $pageConfig['join_tables'] ) && $pageConfig['join_tables'] != '' )
        {
            foreach( $pageConfig['join_tables'] as $index => $join_table )
            {
                $this->CThis->db->join('(SELECT ' . $join_table['join_field'] . ( isset( $join_table['other_join_fields'] ) ? ', ' . $join_table['other_join_fields'] : '' ) . ' FROM ' . $join_table['table'] . ') t' . $index, 't' . $index . '.' . $join_table['join_field'] . ' = t1.' . $join_table['t1_field'] );
            }
        }

        $productModelQuery = $this->CThis->db->get( $pageConfig['table_name'] . ' t1', $this->num_per_page, $pageOffset);

        /* Keep content result query in a variable, for debugging purpose */
        CIPagination::$DEBUG_GET_CONTENT_QUERY = $this->CThis->db->last_query();
        if( $productModelQuery && $productModelQuery->num_rows() > 0 )
        {
            $this->content = $productModelQuery->result_object();
        }

        /* Get total searched row numbers */
        $this->CThis->db->from( $pageConfig['table_name'] );

        $this->predicatesBuilder( $pageConfig );

        $this->total_searched_rows = $productModelQuery ? $this->CThis->db->count_all_results() : 0;
        if( isset($pageConfig['total_item_rows_where_in']) )
        {
            $this->CThis->db->from( $pageConfig['table_name'] );
            foreach( $pageConfig['total_item_rows_where_in'] as $total_item_rows_where_in )
            {
                $this->CThis->db->where_in( $total_item_rows_where_in['field'], $total_item_rows_where_in['values'] );
            }
            $this->total_item_rows = $this->CThis->db->count_all_results();
        }
        else
        {
            $this->total_item_rows = $this->CThis->db->count_all( $pageConfig['table_name'] );
        }

        $config['reuse_query_string'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['use_page_numbers'] = TRUE;
        $config['base_url'] = $this->base_url;
        $config['per_page'] = $this->num_per_page;
        $config['total_rows'] = $this->total_searched_rows;
        $config["num_links"] = $this->num_links;
        $config['next_tag_open'] = '<span>';
        $config['next_tag_close'] = '</span>';
        $config['prev_tag_open'] = '<span>';
        $config['prev_tag_close'] = '</span>';
        $config['first_tag_open'] = '<span>';
        $config['first_tag_close'] = '</span>';
        $config['last_tag_open'] = '<span>';
        $config['last_tag_close'] = '</span>';
        $config['attributes'] = $this->attributes;

        $config['full_tag_open'] = '<p class="page">';
        $config['full_tag_close'] = '</p>';
        $config['first_link'] = '<<';
        $config['last_link'] = '>>';

        $this->CThis->pagination->initialize( $config );
    }

    function paramsBuilder( $pageConfig )
    {
        /* Custom per page rows */
        if( isset( $pageConfig['num_per_page'] ) && trim( $pageConfig['num_per_page'] ) != '' )
        {
            $this->num_per_page = $pageConfig['num_per_page'];
        }
    }

    function appendPredicate( $predicate )
    {
        if( trim( $this->append_predicates ) == '' )
        {
            $this->append_predicates .= ' '.$predicate.' ';
        }
        else
        {
            /* If strict predicate mode activated then use AND for concatenation */
            if( $this->is_strict_predicate_mode_activate )
            {
                $this->append_predicates .= ' AND '.$predicate.' ';
            }
            /* Else is loose predicate mode activated then use OR for concatenation */
            else
            {
                $this->append_predicates .= ' OR '.$predicate.' ';
            }
        }
    }

    function appendStrictPredicate( $strictPredicate )
    {
        if( trim( $this->append_strict_predicates ) == '' )
        {
            $this->append_strict_predicates .= ' '.$strictPredicate.' ';
        }
        else
        {
            $this->append_strict_predicates .= ' AND '.$strictPredicate.' ';
        }
    }

    function appendLoosePredicate( $loosePredicate )
    {
        if( trim( $this->append_loose_predicates ) == '' )
        {
            $this->append_loose_predicates .= ' '.$loosePredicate.' ';
        }
        else
        {
            $this->append_loose_predicates .= ' OR '.$loosePredicate.' ';
        }
    }

    function predicatesBuilder( $pageConfig )
    {
        /* Custom predicates */
        if( isset( $pageConfig['predicates'] ) && trim( $pageConfig['predicates'] ) != '' )
        {
            $this->predicates = $pageConfig['predicates'];
        }

        /* Append predicates */
        if( trim( $this->predicates ) != '' && trim( $this->append_predicates ) != '' )
        {
            /* If strict predicate mode activated then use AND for addendum*/
            if( $this->is_strict_predicate_mode_activate )
            {
                $this->predicates .= ' AND '.$this->append_predicates.' ';
            }
            /* Else is loose predicate mode activated then use OR for addendum*/
            else
            {
                $this->predicates .= ' OR '.$this->append_predicates.' ';
            }
        }
        else if( trim( $this->predicates ) == '' && trim( $this->append_predicates ) != '' )
        {
            $this->predicates .= ' '.$this->append_predicates.' ';
        }

        /* Append Strict predicates */
        if( trim( $this->predicates ) != '' && trim( $this->append_strict_predicates ) != '' )
        {
            $this->predicates .= ' AND '.$this->append_strict_predicates.' ';
        }
        else if( trim( $this->predicates ) == '' && trim( $this->append_strict_predicates ) != '' )
        {
            $this->predicates .= ' '.$this->append_strict_predicates.' ';
        }

        /* Append Loose predicates */
        if( trim( $this->predicates ) != '' && trim( $this->append_loose_predicates ) != '' )
        {
            $this->predicates .= ' OR '.$this->append_loose_predicates.' ';
        }
        else if( trim( $this->predicates ) == '' && trim( $this->append_loose_predicates ) != '' )
        {
            $this->predicates .= ' '.$this->append_loose_predicates.' ';
        }

        /* Build fuzzy predicates */
        if( ! empty( $this->fuzzy_query ) )
        {
            $this->CThis->db->like( $this->fuzzy_query );
        }
        /* Build precise predicates */
        if( trim( $this->predicates ) != '' )
        {
            $this->CThis->db->where( $this->predicates );
        }

        if( isset( $pageConfig['where_in'] ) )
        {
            foreach( $pageConfig['where_in'] as $where_in )
            {
                if( isset( $where_in['field'] ) && isset( $where_in['values'] ) )
                {
                    $this->CThis->db->where_in( $where_in['field'], $where_in['values'] );
                }
            }
        }
    }

    /* SQL helper */

    /* PRIMARY SQL = `$column` BETWEEN '$starts' AND '$ends' */
    function between( $column, $starts, $ends )
    {
        if( $this->model->$starts != null && $this->model->$ends != null )
        {
            $this->appendPredicate( '`'.$column.'` BETWEEN \''.$this->model->$starts.'\' AND \''.$this->model->$ends.'\' ' );
        }
        else if( $this->model->$starts != null )
        {
            $this->appendPredicate( '`'.$column.'` >= \''.$this->model->$starts.'\' ' );
        }
        else if( $this->model->$ends != null )
        {
            $this->appendPredicate( '`'.$column.'` <= \''.$this->model->$ends.'\' ' );
        }
    }

    /* PRIMARY SQL = `$column` IN ('$value 1', '$value 2', '$value N') */
    function in( $column, $values )
    {
        $finalValues = '';
        foreach( $values as $value )
        {
            if( $finalValues != '' )
            {
                $finalValues .= '\', \'';
            }
            $finalValues .= $value;
        }
        $this->appendPredicate( '`'.$column.'` IN (\''.$finalValues.'\') ' );
    }

    /* PRIMARY SQL = `$column` NOT IN ('$value 1', '$value 2', '$value N') */
    function not_in( $column, $values )
    {
        $finalValues = '';
        foreach( $values as $value )
        {
            if( $finalValues != '' )
            {
                $finalValues .= '\', \'';
            }
            $finalValues .= $value;
        }
        $this->appendPredicate( '`'.$column.'` NOT IN (\''.$finalValues.'\') ' );
    }

    function __get($property_name) {
        if (isset($this->$property_name)) {
            return ($this->$property_name);
        } else {
            return NULL;
        }
    }

    function __set($property_name, $value) {
        $this->$property_name = $value;
    }
}