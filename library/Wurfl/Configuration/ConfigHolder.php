<?php
namespace Wurfl\Configuration;

/**
 * Copyright (c) 2012 ScientiaMobile, Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * Refer to the COPYING.txt file distributed with this package.
 *
 *
 * @category   WURFL
 * @package    WURFL_Configuration
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */
/**
 * WURFL Configuration holder singleton
 * @package    WURFL_Configuration
 */
class ConfigHolder {
    
    /**
     * @var \Wurfl\Configuration\Config
     */
    private static $_wurflConfig = null;
    
    private function __construct() {}
    private function __clone() {}
    
    /**
     * Returns a Configuration object
     * @return \Wurfl\Configuration\Config
     */
    public static function getWURFLConfig() {
        if (self::$_wurflConfig === null) {
            throw new \Wurfl\Exception("The Configuration Holder is not initialized with a valid WURFLConfig object");
        }
        return self::$_wurflConfig;
    }
    
    /**
     * Sets the Configuration object
     * @param \Wurfl\Configuration\Config $wurflConfig
     */
    public static function setWURFLConfig(\Wurfl\Configuration\Config $wurflConfig) {
        self::$_wurflConfig = $wurflConfig;
    }
}