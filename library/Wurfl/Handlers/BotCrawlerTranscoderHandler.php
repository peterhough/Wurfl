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
 * @package	WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license	GNU Affero General Public License
 * @version	$id$
 */

/**
 * BotCrawlerTranscoderUserAgentHandler
 * 
 *
 * @category   WURFL
 * @package	WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license	GNU Affero General Public License
 * @version	$id$
 */
class BotCrawlerTranscoderHandler extends Handler
{
	protected $prefix = 'BOT_CRAWLER_TRANSCODER';
	
	public function canHandle($userAgent)
    {
		foreach ($this->botCrawlerTranscoder as $key) {
			if (Utils::checkIfContainsCaseInsensitive($userAgent, $key)) {
				return true;
			}
		}
		return false;
	}

	private $botCrawlerTranscoder = array(
		'bot',
		'crawler',
		'spider',
		'novarra',
		'transcoder',
		'yahoo! searchmonkey',
		'yahoo! slurp',
		'feedfetcher-google',
		'mowser',
		'mediapartners-google',
		'azureus',
		'inquisitor',
		'baiduspider',
		'baidumobaider',
		'holmes/',
		'libwww-perl',
		'netSprint',
		'yandex',
		'cfnetwork',
		'ineturl',
		'jakarta',
		'lorkyll',
		'microsoft url control',
		'indy library',
		'slurp',
		'crawl',
		'wget',
		'ucweblient',
		'rma',
		'snoopy',
		'untrursted',
		'mozfdsilla',
		'ask jeeves',
		'jeeves/teoma',
		'mechanize',
		'http client',
		'servicemonitor',
		'httpunit',
		'hatena',
		'ichiro'
	);
}