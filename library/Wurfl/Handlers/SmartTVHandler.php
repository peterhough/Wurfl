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
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */

/**
 * SmartTVUserAgentHandler
 * 
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */
class SmartTVHandler extends \Wurfl\Handlers\AbstractHandler {
    
    protected $prefix = "SMARTTV";
    
    public static $constantIDs = array(
        'generic_smarttv_browser',
        'generic_smarttv_googletv_browser',
        'generic_smarttv_appletv_browser',
        'generic_smarttv_boxeebox_browser',
    );
    
    public function canHandle($userAgent) {
        return \Wurfl\Handlers\Utils::isSmartTV($userAgent);
    }
    
    public function applyConclusiveMatch($userAgent) {
        // TODO: Evaluate effectiveness of matching full-length in Conclusive matcher via RIS VS Exact match
        $tolerance = strlen($userAgent);
        return $this->getDeviceIDFromRIS($userAgent, $tolerance);
    }
    
    public function applyRecoveryMatch($userAgent){
        if (\Wurfl\Handlers\Utils::checkIfContains($userAgent, 'SmartTV')) return 'generic_smarttv_browser';
        if (\Wurfl\Handlers\Utils::checkIfContains($userAgent, 'GoogleTV')) return 'generic_smarttv_googletv_browser';
        if (\Wurfl\Handlers\Utils::checkIfContains($userAgent, 'AppleTV')) return 'generic_smarttv_appletv_browser';
        if (\Wurfl\Handlers\Utils::checkIfContains($userAgent, 'Boxee')) return 'generic_smarttv_boxeebox_browser';
        return 'generic_smarttv_browser';
    }    
}