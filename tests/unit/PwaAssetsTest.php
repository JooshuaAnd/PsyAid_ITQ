<?php

use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class PwaAssetsTest extends TestCase
{
    private string $publicPath;

    protected function setUp(): void
    {
        parent::setUp();
        $this->publicPath = rtrim(PUBLICPATH, '\\/') . DIRECTORY_SEPARATOR;
    }

    public function testManifestContainsInstallabilityRequirements(): void
    {
        $manifestPath = $this->publicPath . 'manifest.webmanifest';

        $this->assertFileExists($manifestPath);

        $manifest = json_decode((string) file_get_contents($manifestPath), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame('PsyAid', $manifest['short_name']);
        $this->assertSame('/', $manifest['start_url']);
        $this->assertSame('/', $manifest['scope']);
        $this->assertSame('standalone', $manifest['display']);
        $this->assertSame('#064e3b', $manifest['theme_color']);
        $this->assertFalse($manifest['prefer_related_applications']);

        $declaredSizes = array_column($manifest['icons'], 'sizes');
        $this->assertContains('192x192', $declaredSizes);
        $this->assertContains('512x512', $declaredSizes);
    }

    /**
     * @dataProvider iconProvider
     */
    public function testPwaIconsHaveExpectedDimensions(string $fileName, int $width, int $height): void
    {
        $iconPath = $this->publicPath . 'icons' . DIRECTORY_SEPARATOR . $fileName;

        $this->assertFileExists($iconPath);
        $dimensions = getimagesize($iconPath);
        $this->assertIsArray($dimensions);
        $this->assertSame($width, $dimensions[0]);
        $this->assertSame($height, $dimensions[1]);
        $this->assertSame('image/png', $dimensions['mime']);
    }

    public static function iconProvider(): array
    {
        return [
            'Apple touch icon' => ['pwa-180x180.png', 180, 180],
            'Small install icon' => ['pwa-192x192.png', 192, 192],
            'Large install icon' => ['pwa-512x512.png', 512, 512],
            'Maskable install icon' => ['pwa-maskable-512x512.png', 512, 512],
        ];
    }

    public function testServiceWorkerUsesPrivacyFirstCachePolicy(): void
    {
        $serviceWorkerPath = $this->publicPath . 'service-worker.js';
        $this->assertFileExists($serviceWorkerPath);

        $serviceWorker = (string) file_get_contents($serviceWorkerPath);

        $this->assertStringContainsString("request.method !== 'GET'", $serviceWorker);
        $this->assertStringContainsString("request.mode === 'navigate'", $serviceWorker);
        $this->assertStringContainsString("cache: 'no-store'", $serviceWorker);
        $this->assertStringContainsString("'/api/'", $serviceWorker);
        $this->assertStringContainsString("'/victim/'", $serviceWorker);
        $this->assertStringContainsString("'/psikolog/'", $serviceWorker);
        $this->assertStringContainsString("caches.match(OFFLINE_URL)", $serviceWorker);
        $this->assertStringContainsString('static-v4', $serviceWorker);
    }

    public function testPwaControlsUseCompactAccessibleLabels(): void
    {
        $pwaScript = (string) file_get_contents($this->publicPath . 'pwa.js');

        $this->assertStringContainsString("innerHTML = iconMarkup('install')", $pwaScript);
        $this->assertStringContainsString("'Pasang aplikasi PsyAid'", $pwaScript);
        $this->assertStringContainsString("online ? 'Online' : 'Offline'", $pwaScript);
        $this->assertStringContainsString('Tambahkan ke Layar Utama', $pwaScript);
    }

    public function testAllPrimaryDocumentTemplatesIncludePwaMetadata(): void
    {
        $templates = [
            APPPATH . 'Views/layouts/main.php',
            APPPATH . 'Views/landing/index.php',
            APPPATH . 'Views/landing/rekrutmen.php',
            APPPATH . 'Views/landing/LaporanMasyarakat.php',
        ];

        foreach ($templates as $template) {
            $this->assertFileExists($template);
            $this->assertStringContainsString(
                "view('components/pwa_head')",
                (string) file_get_contents($template),
                $template . ' belum memuat metadata PWA.',
            );
        }
    }
}
