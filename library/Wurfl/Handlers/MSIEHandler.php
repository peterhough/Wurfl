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
 * MSIEAgentHandler
 *
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */
class MSIEHandler extends \Wurfl\Handlers\AbstractHandler {
    
    protected $prefix = "MSIE";
    
    public static $constantIDs = array(
        0     => 'msie',
        4     => 'msie_4',
        5     => 'msie_5',
        '5.5' => 'msie_5_5',
        6     => 'msie_6',
        7     => 'msie_7',
        8     => 'msie_8',
        9     => 'msie_9',
        10    => 'msie_10',
        11    => 'msie_11',
    );
    
    public function canHandle($userAgent) {
        if (\Wurfl\Handlers\Utils::isMobileBrowser($userAgent)) return false;
        if (\Wurfl\Handlers\Utils::checkIfContainsAnyOf($userAgent, array('Opera', 'armv', 'MOTO', 'BREW'))) return false;
        
        // IE 11 signature
        $has_trident_rv = (\Wurfl\Handlers\Utils::checkIfContains($userAgent, 'Trident') && \Wurfl\Handlers\Utils::checkIfContains($userAgent, 'rv:'));
        // IE < 11 signature
        $has_msie = \Wurfl\Handlers\Utils::checkIfContains($userAgent, 'MSIE');
        return ($has_msie || $has_trident_rv);
    }
    
    public function applyConclusiveMatch($userAgent) {
        $matches = array();
        if (preg_match('/^Mozilla\/5\.0 \(.+?Trident.+?; rv:(\d\d)\.(\d+)\)/', $userAgent, $matches)
                || preg_match('/^Mozilla\/[45]\.0 \(compatible; MSIE (\d+)\.(\d+);/', $userAgent, $matches)) {
            
            $major = (int)$matches[1];
            $minor = (int)$matches[2];
                
            // MSIE 5.5 is handled specifically
            if ($major == 5 && $minor == 5) {
                return 'msie_5_5';
            }
                
            // Look for version in constant ID array
            if (array_key_exists($major, self::$constantIDs)) {
                return self::$constantIDs[$major];
            }
        }
        
        return $this->getDeviceIDFromRIS($userAgent, \Wurfl\Handlers\Utils::indexOfOrLength($userAgent, 'Trident'));
    }
    
    public function applyRecoveryMatch($userAgent) {
        if (\Wurfl\Handlers\Utils::checkIfContainsAnyOf($userAgent, array(
            'SLCC1',
            'Media Center PC',
            '.NET CLR',
            'OfficeLiveConnector',
        ))) return \Wurfl\Constants::GENERIC_WEB_BROWSER;
        
        return \Wurfl\Constants::NO_MATCH;
    }
}
