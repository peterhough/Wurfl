<?php
namespace Wurfl\Handlers;

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
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */

/**
 * FirefoxUserAgentHandler
 *
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */
class FirefoxHandler extends \Wurfl\Handlers\AbstractHandler {
    
    protected $prefix = "FIREFOX";
    
    public static $constantIDs = array(
        'firefox',
    );
    
    public function canHandle($userAgent) {
        if (\Wurfl\Handlers\Utils::isMobileBrowser($userAgent)) return false;
        if (\Wurfl\Handlers\Utils::checkIfContainsAnyOf($userAgent, array('Tablet', 'Sony', 'Novarra', 'Opera'))) return false;
        return \Wurfl\Handlers\Utils::checkIfContains($userAgent, 'Firefox');
    }
    
    public function applyConclusiveMatch($userAgent) {
        return $this->getDeviceIDFromRIS($userAgent, \Wurfl\Handlers\Utils::indexOfOrLength($userAgent, '.'));
    }
    
    public function applyRecoveryMatch($userAgent) {
        return 'firefox';
    }
}