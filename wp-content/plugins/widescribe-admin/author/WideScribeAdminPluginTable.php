<?php
if (! class_exists('WP_List_Table')) {
    require_once (ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class WideScribeAdminPluginTable extends WP_List_Table
{

    public $data = array();

    function __construct()
    {
        global $status, $page;
        parent::__construct(array(
            'singular' => 'partner',
            'plural' => 'partners',
            'ajax' => false
        ));
    }

    function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'domain':
            case 'logosrc':
            case 'defaultCurrencyCode':
            case 'defaultCost':
                return $item->$column_name;
            case 'wordpressPage':
                return ! empty($item->$column_name) ? 'Yes' : 'No';
            case 'languageId':
                $languages = array(
                    '1' => 'English',
                    '2' => 'Norwegian BM',
                    '3' => 'Norwegian Nynorsk',
                    '4' => 'Swedish',
                    '5' => 'Danish'
                );
                return $languages[$item->$column_name];
            default:
                return print_r($item, true);
        }
    }

    function column_partnerName($item)
    {
        $actions = array(
            'edit' => sprintf('<a href="?page=%s&action=%s&id=%s">Edit</a>', $_REQUEST['page'], 'edit', $item->id),
            'delete' => sprintf('<a href="?page=%s&action=%s&id=%s">Delete</a>', $_REQUEST['page'], 'delete', $item->id)
        );
        
        return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
            /*$1%s*/ $item->partnerName,
            /*$2%s*/ $item->id,
            /*$3%s*/ $this->row_actions($actions));
    }

    function column_cb($item)
    {
        return sprintf('<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  
            /*$2%s*/ $item->id);
    }

    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'partnerName' => 'Name',
            'domain' => 'Domain',
            'languageId' => 'Language',
            'wordpressPage' => 'Wordpress Page',
            'defaultCurrencyCode' => 'Currency',
            'defaultCost' => 'Cost'
        );
        return $columns;
    }

    function get_sortable_columns()
    {
        $sortable_columns = array(
            'partnerName' => array(
                'partnerName',
                false
            ),
            'domain' => array(
                'domain',
                false
            ),
            'defaultCurrencyCode' => array(
                'defaultCurrencyCode',
                false
            )
        );
        return $sortable_columns;
    }

    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action()
    {
        
        if ('delete' === $this->current_action()) {
            wp_die('Items deleted (or they would be if we had items to delete)!');
        }
    }

    function prepare_items()
    {
        $per_page = 5;
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array(
            $columns,
            $hidden,
            $sortable
        );
        //$this->process_bulk_action();
        $data = $this->data;
        function usort_reorder($a, $b)
        {
            $orderby = (! empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'partnerName';
            $order = (! empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc';
            $result = strcmp($a->$orderby, $b->$orderby);
            return ($order === 'asc') ? $result : - $result;
        }
        usort($data, 'usort_reorder');
        
        $current_page = $this->get_pagenum();
        $total_items = count($data);
        $data = array_slice($data, (($current_page - 1) * $per_page), $per_page);
        $this->items = $data;
        $this->set_pagination_args(array(
            'total_items' => $total_items,
            'per_page' => $per_page,
            'total_pages' => ceil($total_items / $per_page)
        ));
    }
}