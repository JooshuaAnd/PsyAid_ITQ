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
            'Browser favicon' => ['favicon-32x32.png', 32, 32],
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
        $this->assertStringContainsString("const VERSION = 'v11'", $serviceWorker);
        $this->assertStringContainsString('static-${VERSION}', $serviceWorker);
        $this->assertStringContainsString('ignoreVary: true', $serviceWorker);
        $this->assertStringContainsString('cacheVersion: VERSION', $serviceWorker);
        $this->assertStringContainsString('snapshotComplete', $serviceWorker);
        $this->assertStringContainsString("'/login'", $serviceWorker);
        $this->assertStringContainsString("'/register'", $serviceWorker);
        $this->assertStringContainsString("'/forbidden'", $serviceWorker);
        $this->assertStringContainsString('networkOnly(request)', $serviceWorker);
        $this->assertStringContainsString('if (response.status > 0)', $serviceWorker);
        $this->assertStringContainsString('never mislabel a server error as an offline device', $serviceWorker);
        $this->assertStringContainsString('fetchPageWithTransientRetry(request)', $serviceWorker);
        $this->assertStringContainsString('waitForNavigationRetry(200)', $serviceWorker);
        $this->assertStringNotContainsString("response.status >= 500 || request.mode === 'navigate'", $serviceWorker);
        $this->assertStringContainsString('const snapshotRuns = new Map()', $serviceWorker);
        $this->assertStringContainsString('snapshotRuns.delete(safeScope)', $serviceWorker);
        $this->assertMatchesRegularExpression(
            "/if \(activeScope === safeScope\).*setActiveScope\('public'\).*caches\.delete/s",
            $serviceWorker,
        );
        $this->assertStringContainsString('deleteMeta(`snapshot:${safeScope}`)', $serviceWorker);
        $this->assertStringContainsString('`snapshot:${snapshotScope}`', $serviceWorker);
        $this->assertStringContainsString('staleContext: true', $serviceWorker);
        $this->assertStringContainsString("state: 'cancelled', scope: snapshotScope", $serviceWorker);
        $this->assertStringContainsString("type: 'SYNC_CANCELLED'", $serviceWorker);
        $this->assertStringContainsString('replayScope !== activeScope', $serviceWorker);
        $this->assertStringContainsString('matchesConfiguredPath', $serviceWorker);
        $this->assertStringContainsString('Promise.allSettled(PRECACHE_URLS.map', $serviceWorker);
        $this->assertStringNotContainsString('cache.addAll(PRECACHE_URLS)', $serviceWorker);
    }

    public function testPwaControlsUseCompactAccessibleLabels(): void
    {
        $pwaScript = (string) file_get_contents($this->publicPath . 'pwa.js');
        $pwaStyles = (string) file_get_contents($this->publicPath . 'pwa.css');

        $this->assertStringContainsString("controlToggle.id = 'pwa-control-toggle'", $pwaScript);
        $this->assertStringContainsString("controlPanel.id = 'pwa-control-panel'", $pwaScript);
        $this->assertStringContainsString('controlPanel.hidden = true', $pwaScript);
        $this->assertStringContainsString('if (!iosDevice)', $pwaScript);
        $this->assertStringContainsString("['/', '/landing'].includes(normalizedPath)", $pwaScript);
        $this->assertStringContainsString("'Pasang aplikasi PsyAid'", $pwaScript);
        $this->assertStringContainsString("label = online ? 'Online' : 'Offline'", $pwaScript);
        $this->assertStringNotContainsString('showIosInstallGuide', $pwaScript);
        $this->assertStringContainsString('.pwa-control-panel', $pwaStyles);
        $this->assertStringContainsString('inset 3px 3px 7px', $pwaStyles);
        $this->assertStringContainsString('@supports (-webkit-touch-callout: none)', $pwaStyles);
        $this->assertStringContainsString('bottom: calc(0.75rem + env(safe-area-inset-bottom))', $pwaStyles);
        $this->assertStringContainsString("type: 'SYNC_MUTATIONS'", $pwaScript);
        $this->assertStringContainsString("type: 'WARM_URLS'", $pwaScript);
        $this->assertStringContainsString('Logout ditunda', $pwaScript);
        $this->assertStringContainsString('SERVICE_WORKER_RELEASE', $pwaScript);
        $this->assertStringContainsString('snapshot.version === status.cacheVersion', $pwaScript);
        $this->assertStringContainsString("addEventListener('controllerchange'", $pwaScript);
        $this->assertStringContainsString('findCachedNavigation', $pwaScript);
        $this->assertStringContainsString('renderCachedNavigation', $pwaScript);
        $this->assertStringContainsString('psyaidOfflineNavigation', $pwaScript);
        $this->assertStringContainsString('data-psyaid-offline-source', $pwaScript);
        $this->assertStringContainsString("new DOMParser().parseFromString", $pwaScript);
        $this->assertStringContainsString("['complete', 'cancelled'].includes(message.state)", $pwaScript);
        $this->assertStringContainsString('warmRequest.ok !== true', $pwaScript);
        $this->assertStringContainsString("reason: 'before-logout', scope: userScope", $pwaScript);

        $pwaHead = file_get_contents(APPPATH . 'Views/components/pwa_head.php');
        $this->assertIsString($pwaHead);
        $this->assertStringContainsString('$pwaRuntimeVersion = \'20260808-8\'', $pwaHead);
        $this->assertStringContainsString("base_url('pwa.css') . '?v=' . \$pwaRuntimeVersion", $pwaHead);
        $this->assertStringContainsString("base_url('pwa.js') . '?v=' . \$pwaRuntimeVersion", $pwaHead);
    }

    public function testSafariFaviconUsesValidVersionedPsyAidAssets(): void
    {
        $favicon = (string) file_get_contents($this->publicPath . 'favicon.ico');
        $head = (string) file_get_contents(APPPATH . 'Views/components/pwa_head.php');

        $this->assertSame("\x00\x00\x01\x00", substr($favicon, 0, 4));
        $this->assertStringContainsString("base_url('favicon.ico') . '?v=' . \$pwaIconVersion", $head);
        $this->assertStringContainsString("base_url('icons/favicon-32x32.png') . '?v=' . \$pwaIconVersion", $head);
        $this->assertStringContainsString('apple-touch-icon-precomposed', $head);
        $this->assertStringContainsString('$pwaIconVersion = \'20260808-2\'', $head);
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

    public function testVolunteerAccountSwitchHasRoleSafeFallbacks(): void
    {
        $authController = (string) file_get_contents(APPPATH . 'Controllers/Auth/AuthController.php');
        $relawanController = (string) file_get_contents(APPPATH . 'Controllers/Relawan/RelawanController.php');
        $poskoController = (string) file_get_contents(APPPATH . 'Controllers/Relawan/PoskoController.php');
        $offlineController = (string) file_get_contents(APPPATH . 'Controllers/OfflineController.php');
        $routes = (string) file_get_contents(APPPATH . 'Config/Routes.php');
        $fallbackView = (string) file_get_contents(APPPATH . 'Views/relawan/PoskoUnavailable.php');
        $offlinePage = (string) file_get_contents($this->publicPath . 'offline.html');

        $this->assertStringContainsString("redirect()->to('/relawan/posko-tidak-tersedia')", $authController);
        $this->assertStringContainsString("return redirect()->to('/posko/' . \$poskoId);", $authController);
        $this->assertStringNotContainsString('$targetPosko = $poskoId ?? 1', $authController);
        $this->assertStringContainsString('session()->set(\'posko_id\', $freshPoskoId)', $relawanController);
        $this->assertStringContainsString("join('regencies', 'regencies.id = posko.regency_id', 'left')", $poskoController);
        $this->assertStringContainsString("join('provinces', 'provinces.id = regencies.province_id', 'left')", $poskoController);
        $this->assertStringContainsString("'relawan' => redirect()->to('/relawan/posko-tidak-tersedia')", $poskoController);
        $this->assertStringContainsString("'/relawan/posko-tidak-tersedia'", $offlineController);
        $this->assertStringContainsString("'/relawan/posko-tidak-tersedia'", $routes);
        $this->assertStringContainsString("'role:relawan'", $routes);
        $this->assertStringContainsString('Kondisi ini bukan masalah koneksi perangkat.', $fallbackView);
        $this->assertStringContainsString("fetch('/login?psyaid_online_probe='", $offlinePage);
        $this->assertStringContainsString('if (response.ok)', $offlinePage);
        $this->assertStringContainsString('window.location.replace(target.href)', $offlinePage);
        $this->assertStringNotContainsString('window.location.reload()', $offlinePage);
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
            $contents = (string) file_get_contents($template);
            $this->assertStringContainsString(
                "view('components/pwa_head')",
                $contents,
                $template . ' belum memuat metadata PWA.',
            );
            $this->assertStringContainsString(
                'viewport-fit=cover',
                $contents,
                $template . ' belum mengaktifkan safe area viewport iOS.',
            );
        }
    }
}
