<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yiiunit\framework\web;

use yii\web\Request;
use yiiunit\TestCase;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class RequestTest extends TestCase
{
	public function testParseAcceptHeader()
	{
		$request = new Request;

		$this->assertEquals([], $request->parseAcceptHeader(' '));

		$this->assertEquals([
			'audio/basic' => ['q' => 1],
			'audio/*' => ['q' => 0.2],
		], $request->parseAcceptHeader('audio/*; q=0.2, audio/basic'));

		$this->assertEquals([
			'application/json' => ['q' => 1, 'version' => '1.0'],
			'application/xml' => ['q' => 1, 'version' => '2.0', 'x'],
			'text/x-c' => ['q' => 1],
			'text/x-dvi' => ['q' => 0.8],
			'text/plain' => ['q' => 0.5],
		], $request->parseAcceptHeader('text/plain; q=0.5,
			application/json; version=1.0,
			application/xml; version=2.0; x,
			text/x-dvi; q=0.8, text/x-c'));
	}
}
