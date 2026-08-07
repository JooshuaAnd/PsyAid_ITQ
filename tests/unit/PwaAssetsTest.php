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
        $this->assertStringContainsString('?v=', $manifest['icons'][0]['src']);
        $this->assertStringContainsString('?v=', $manifest['icons'][1]['src']);
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

    public function testServiceWorkerSupportsScopedSnapshotsAndMutationQueue(): void
    {
        $serviceWorkerPath = $this->publicPath . 'service-worker.js';
        $this->assertFileExists($serviceWorkerPath);

        $serviceWorker = (string) file_get_contents($serviceWorkerPath);

        $this->assertStringContainsString("const DB_NAME = 'psyaid-offline'", $serviceWorker);
        $this->assertStringContainsString("const SYNC_TAG = 'psyaid-sync-mutations'", $serviceWorker);
        $this->assertStringContainsString('networkFirstPage(request)', $serviceWorker);
        $this->assertStringContainsString('networkOrQueue(request)', $serviceWorker);
        $this->assertStringContainsString('replayMutations', $serviceWorker);
        $this->assertStringContainsString('X-PsyAid-Mutation-Id', $serviceWorker);
        $this->assertStringContainsString("message.type === 'WARM_URLS'", $serviceWorker);
        $this->assertStringContainsString('PAGE_CACHE_PREFIX', $serviceWorker);
        $this->assertStringContainsString("const VERSION = 'v6'", $serviceWorker);
        $this->assertStringContainsString('static-${VERSION}', $serviceWorker);
    }

    public function testPwaControlsUseCompactAccessibleLabels(): void
    {
        $pwaScript = (string) file_get_contents($this->publicPath . 'pwa.js');

        $this->assertStringContainsString("innerHTML = iconMarkup('install')", $pwaScript);
        $this->assertStringContainsString("'Pasang aplikasi PsyAid'", $pwaScript);
        $this->assertStringContainsString("label = online ? 'Online' : 'Offline'", $pwaScript);
        $this->assertStringContainsString('Tambahkan ke Layar Utama', $pwaScript);
        $this->assertStringContainsString("type: 'SYNC_MUTATIONS'", $pwaScript);
        $this->assertStringContainsString("type: 'WARM_URLS'", $pwaScript);
        $this->assertStringContainsString('Logout ditunda', $pwaScript);
    }

    public function testOfflineBackendComponentsAreRegistered(): void
    {
        $routes = (string) file_get_contents(APPPATH . 'Config/Routes.php');
        $filters = (string) file_get_contents(APPPATH . 'Config/Filters.php');
        $head = (string) file_get_contents(APPPATH . 'Views/components/pwa_head.php');

        $this->assertStringContainsString("'/offline/bootstrap'", $routes);
        $this->assertStringContainsString('OfflineController::bootstrap', $routes);
        $this->assertStringContainsString('OfflineMutationFilter::class', $filters);
        $this->assertStringContainsString('psyaid-user-scope', $head);
        $this->assertStringContainsString('msapplication-TileImage', $head);
        $this->assertStringContainsString('sizes="192x192"', $head);
        $this->assertFileExists(APPPATH . 'Controllers/OfflineController.php');
        $this->assertFileExists(APPPATH . 'Filters/OfflineMutationFilter.php');
        $this->assertFileExists(APPPATH . 'Database/Migrations/2026-08-07-000001_CreateOfflineMutationReceiptsTable.php');
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
