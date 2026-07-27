<?php

namespace App\Controllers\Bpbd;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class EarthquakeRadarController extends BaseController
{
    private string $bmkgEndpoint = 'https://data.bmkg.go.id/DataMKG/TEWS/gempadirasakan.json';

    public function index()
    {
        $data = [
            'title' => 'Peta Radar Gempa Real-Time — BMKG TEWS',
        ];

        return view('bpbd/EarthquakeRadar', $data);
    }

    /**
     * Endpoint API Proxy untuk mengambil data gempa terkini dari BMKG
     */
    public function fetchBmkgData(): ResponseInterface
    {
        $client = \Config\Services::curlrequest([
            'timeout' => 10,
            'verify'  => false,
        ]);

        try {
            $response = $client->get($this->bmkgEndpoint);
            $statusCode = $response->getStatusCode();

            if ($statusCode === 200) {
                $rawBody = $response->getBody();
                $json = json_decode($rawBody, true);

                if (isset($json['Infogempa']['gempa'])) {
                    $gempaList = $json['Infogempa']['gempa'];

                    // Process and format coordinates & metadata for Leaflet radar map
                    $formattedData = array_map(function ($item) {
                        $coords = explode(',', $item['Coordinates'] ?? '0,0');
                        $lat = isset($coords[0]) ? (float) trim($coords[0]) : 0.0;
                        $lng = isset($coords[1]) ? (float) trim($coords[1]) : 0.0;
                        $magnitude = isset($item['Magnitude']) ? (float) $item['Magnitude'] : 0.0;

                        return [
                            'tanggal'   => $item['Tanggal'] ?? '',
                            'jam'       => $item['Jam'] ?? '',
                            'datetime'  => $item['DateTime'] ?? '',
                            'lat'       => $lat,
                            'lng'       => $lng,
                            'lintang'   => $item['Lintang'] ?? '',
                            'bujur'     => $item['Bujur'] ?? '',
                            'magnitude' => $magnitude,
                            'kedalaman' => $item['Kedalaman'] ?? '',
                            'wilayah'   => $item['Wilayah'] ?? '',
                            'dirasakan' => $item['Dirasakan'] ?? '',
                        ];
                    }, $gempaList);

                    return $this->response->setJSON([
                        'status'    => 'success',
                        'timestamp' => date('Y-m-d H:i:s'),
                        'total'     => count($formattedData),
                        'data'      => $formattedData,
                    ]);
                }
            }

            return $this->response->setStatusCode(502)->setJSON([
                'status'  => 'error',
                'message' => 'Format respons dari BMKG tidak valid.',
            ]);
        } catch (\Exception $e) {
            log_message('error', 'BMKG API Error: ' . $e->getMessage());

            return $this->response->setStatusCode(500)->setJSON([
                'status'  => 'error',
                'message' => 'Gagal mengambil data dari endpoint BMKG: ' . $e->getMessage(),
            ]);
        }
    }
}
