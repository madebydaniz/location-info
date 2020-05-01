<?php
/*
 * (c) Daniel Niazmand <madebydaniz@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace madebydaniz\LocationInfo;

use Curl\Curl;

class LocationInfo
{
    /**
     * Instance
     *
     * @var LocationInfo
     */
    private static $instance = null;

    /**
     * Config
     *
     * @var array
     */
    protected static $config = [];

    /**
     * Initialize Location Info
     *
     * @return void
     */
    private function __construct()
    {
        self::setConfig();
    }

    public static function getInstance()
    {
        if ( is_null( self::$instance ) )
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function search($query = '', $args = array(), $filter = array())
    {
        $defaults = array (
            "q" => "",
            "street" => "",
            "city" => "",
            "county" => "",
            "state" => "",
            "country" => "",
            "postalcode" => "",
            "countrycodes" => "AT",
            "format" => "json",
            "addressdetails" => 0,
            "extratags" => 0,
            "namedetails" =>  0,
            "accept-language" => "de"
        );
        $args = self::parse_args( $args, $defaults );

        if (empty($args['street']) OR
            empty($args['city']) OR
            empty($args['county']) OR
            empty($args['state']) OR
            empty($args['country']) OR
            empty($args['postalcode'])) {
            $args['q'] = $query;
        } else {
            $args['q'] = $query;
        }

        $data = new Curl();
        $data->get(self::$config['osm']['url'], array_filter( $args, 'strlen' ));
        $result = json_decode($data->response, true);

        return self::filterData($result, $filter);
    }

    private function setConfig()
    {
        self::$config = require dirname(__DIR__).'/config/settings.php';
    }

    protected static function parse_args($args, $defaults = '')
    {
        if ( is_object( $args ) ) {
            $parsed_args = get_object_vars( $args );
        } elseif ( is_array( $args ) ) {
            $parsed_args =& $args;
        } else {
            parse_str( $args, $parsed_args );
        }

        if ( is_array( $defaults ) ) {
            return array_merge( $defaults, $parsed_args );
        }
        return $parsed_args;
    }

    protected static function filterData($array, $keys)
    {
        $array = (is_array($array)) ? reset($array) : false;
        if (count($keys)) {
            $result = array();
            foreach ($keys  as $key) {
                if (array_key_exists($key, $array))
                {
                    $result[$key] = $array[$key];
                }
            }
            return $result;
        } else {
            return $array;
        }
    }
}