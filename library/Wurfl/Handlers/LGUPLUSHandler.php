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
 * LGPLUSUserAgentHandler
 *
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */
class LGUPLUSHandler extends \Wurfl\Handlers\AbstractHandler {

    protected $prefix = "LGUPLUS";

    public static $constantIDs = array(
        'generic_lguplus_rexos_facebook_browser',
        'generic_lguplus_rexos_webviewer_browser',
        'generic_lguplus_winmo_facebook_browser',
        'generic_lguplus_android_webkit_browser',
    );

    public function canHandle($userAgent) {
        if (\Wurfl\Handlers\Utils::isDesktopBrowser($userAgent)) return false;
        return \Wurfl\Handlers\Utils::checkIfContainsAnyOf($userAgent, array("LGUPLUS", "lgtelecom"));
    }

    public function applyConclusiveMatch($userAgent) {
        return \Wurfl\Constants::NO_MATCH;
    }

    public function applyRecoveryMatch($userAgent) {
        if (\Wurfl\Handlers\Utils::checkIfContainsAll($userAgent, array('Windows NT 5', 'POLARIS'))) return 'generic_lguplus_rexos_facebook_browser';
        if (\Wurfl\Handlers\Utils::checkIfContains($userAgent, 'Windows NT 5')) return 'generic_lguplus_rexos_webviewer_browser';
        if (\Wurfl\Handlers\Utils::checkIfContainsAll($userAgent, array('Windows CE', 'POLARIS'))) return 'generic_lguplus_winmo_facebook_browser';
        if (\Wurfl\Handlers\Utils::checkIfContainsAll($userAgent, array('Android', 'AppleWebKit'))) return 'generic_lguplus_android_webkit_browser';
        return \Wurfl\Constants::NO_MATCH;
    }
}