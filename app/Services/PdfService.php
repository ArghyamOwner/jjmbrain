<?php

namespace App\Services;

use HeadlessChromium\BrowserFactory;

class PdfService 
{
	public static function render(string $html): string
	{
		$browser = (new BrowserFactory)->createBrowser([
			'windowSize' => [1920, 1080],
			'ignoreCertificateErrors' => true
		]);

		$page = $browser->createPage();

		$page->setHtml($html);

		return base64_decode(
			$page->pdf([
				'printBackground' => true,
				'displayHeaderFooter' => true,
				'headerTemplate'      => '<div></div>',
				'footerTemplate'      => '<div style="font-size: 13px; width: 90px; display: block; margin-left: auto; margin-right: auto;">Page <span class="pageNumber"></span>/<span class="totalPages"></span></div>',
			])->getBase64()
		);
	}

	public static function renderToImage(
		string $html, 
		string $path, 
		int $viewportWidth = null, 
		int $viewportHeight = null
	) {
		$browser = (new BrowserFactory)->createBrowser([
			'windowSize' => [1920, 1080]
		]);

		$page = $browser->createPage();

		$page->setHtml($html);

		if ($viewportWidth && $viewportHeight) {
			$page->setViewport($viewportWidth, $viewportHeight)
				->await(); // wait for the operation to complete
		}

		// take a screenshot
		$screenshot = $page->screenshot([
			'format'  => 'jpeg',  // default to 'png' - possible values: 'png', 'jpeg', 'webp'
			'quality' => 80,      // only when format is 'jpeg' or 'webp' - default 100
			'optimizeForSpeed' => true // default to 'false' - Optimize image encoding for speed, not for resulting size
		]);

		// save the screenshot
		return $screenshot->saveToFile($path);
	}
}