<?php

namespace App\Controllers\Psikolog;

use App\Controllers\BaseController;
use App\Models\ClinicalActionModel;
use App\Models\ItqAnswersModel;
use App\Models\ItqResultModel;
use App\Models\LongitudinalFollowupModel;
use App\Models\VictimModel;
use App\Services\ItqScoringService;
use CodeIgniter\Controller;

class ItqController extends Controller
{
    /**
     * Display Official 18-Item ITQ Assessment Form (SEGMEN 12)
     */
    public function form($victimId)
    {
        $victimModel = new VictimModel();
        $victim      = $victimModel->find($victimId);

        if (! $victim) {
            return redirect()->to('/psikolog/dashboard')->with('error', 'Penyintas tidak ditemukan.');
        }

        $itqModel  = new ItqAnswersModel();
        $existing  = $itqModel->getByVictimId((int) $victimId);

        // Official ITQ Questions (Exact wording)
        $itqQuestions = [
            'section_a' => [
                'title' => 'A. Gejala PTSD (Post-Traumatic Stress Disorder)',
                'groups' => [
                    [
                        'name' => 'Re-experiencing (Mengalami Kembali Trauma)',
                        'items' => [
                            1 => 'Mimpi buruk atau ingatan yang mengganggu tentang kejadian trauma.',
                            2 => 'Sensasi kilas balik (flashback) seolah-olah kejadian buruk tersebut terjadi kembali saat ini.',
                        ]
                    ],
                    [
                        'name' => 'Avoidance (Penghindaran)',
                        'items' => [
                            3 => 'Menghindari pikiran, perasaan, atau kenangan internal tentang kejadian trauma.',
                            4 => 'Menghindari orang, tempat, percakapan, atau situasi eksternal yang mengingatkan pada kejadian.',
                        ]
                    ],
                    [
                        'name' => 'Sense of Threat (Perasaan Terancam)',
                        'items' => [
                            5 => 'Selalu merasa waspada, curiga, atau dalam bahaya (hypervigilance).',
                            6 => 'Mudah terkejut, kaget, atau memiliki respon gugup berlebihan.',
                        ]
                    ],
                    [
                        'name' => 'Functional Impairment (Dampak Gangguan Fungsi)',
                        'items' => [
                            7 => 'Gejala PTSD di atas mengganggu hubungan keluarga atau kehidupan pribadi Anda.',
                            8 => 'Gejala PTSD di atas mengganggu kemampuan bekerja atau aktivitas sehari-hari.',
                            9 => 'Gejala PTSD di atas mengganggu kehidupan sosial atau interaksi dengan orang lain.',
                        ]
                    ]
                ]
            ],
            'section_b' => [
                'title' => 'B. Gejala DSO (Disturbances in Self-Organization)',
                'groups' => [
                    [
                        'name' => 'Affective Dysregulation (Disesgulasi Emosi)',
                        'items' => [
                            10 => 'Membutuhkan waktu sangat lama untuk meredakan emosi saat merasa marah atau sedih.',
                            11 => 'Merasa mati rasa secara emosional atau tidak mampu merasakan kebahagiaan.',
                        ]
                    ],
                    [
                        'name' => 'Negative Self Concept (Konsep Diri Negatif)',
                        'items' => [
                            12 => 'Merasa diri tidak berharga, gagal, atau seperti manusia perusak.',
                            13 => 'Merasa sangat bersalah, malu, atau menyalahkan diri sendiri secara berlebihan.',
                        ]
                    ],
                    [
                        'name' => 'Disturbances in Relationships (Gangguan Hubungan Interpersonal)',
                        'items' => [
                            14 => 'Merasa jauh, terasing, atau terputus dari orang-orang di sekitar Anda.',
                            15 => 'Sulit untuk merasa dekat secara emosional atau mempercayai orang lain.',
                        ]
                    ],
                    [
                        'name' => 'Functional Impairment (Dampak Gangguan Fungsi DSO)',
                        'items' => [
                            16 => 'Gejala DSO di atas mengganggu hubungan keluarga atau kehidupan rumah tangga.',
                            17 => 'Gejala DSO di atas mengganggu performa kerja atau pendidikan.',
                            18 => 'Gejala DSO di atas mengganggu hubungan sosial dan partisipasi bermasyarakat.',
                        ]
                    ]
                ]
            ]
        ];

        $data = [
            'title'        => 'Form ITQ (International Trauma Questionnaire) — ' . $victim['nama'],
            'victim'       => $victim,
            'existing'     => $existing,
            'itqQuestions' => $itqQuestions,
        ];

        return view('psikolog/ItqForm', $data);
    }

    /**
     * Store 18-item ITQ Instrument Answers
     */
    public function store($victimId)
    {
        $rules = [];
        for ($i = 1; $i <= 18; $i++) {
            $rules['item_' . $i] = [
                'rules'  => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[4]',
                'errors' => [
                    'required' => 'Pertanyaan nomor ' . $i . ' wajib dijawab.',
                ]
            ];
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $itqModel = new ItqAnswersModel();
        $existing = $itqModel->getByVictimId((int) $victimId);

        $data = [
            'victim_id'   => (int) $victimId,
            'psikolog_id' => session()->get('user_id') ?? 4,
            'created_at'  => date('Y-m-d H:i:s'),
        ];

        for ($i = 1; $i <= 18; $i++) {
            $data['item_' . $i] = (int) $this->request->getPost('item_' . $i);
        }

        if ($existing) {
            $itqModel->update($existing['id'], $data);
        } else {
            $itqModel->insert($data);
        }

        // Trigger Scoring Engine (SEGMEN 13) and redirect to ITQ Result Page
        $service = new ItqScoringService();
        $service->generate((int) $victimId);

        return redirect()->to('/itq/result/' . $victimId)
            ->with('success', 'Instrumen ITQ berhasil disimpan dan dihitung secara otomatis.');
    }

    /**
     * ITQ Scoring Results & Chart.js Visualization Page (SEGMEN 13, 14, 15)
     */
    public function result($victimId)
    {
        $victimModel = new VictimModel();
        $victim      = $victimModel->find($victimId);

        if (! $victim) {
            return redirect()->to('/psikolog/dashboard')->with('error', 'Penyintas tidak ditemukan.');
        }

        // Ensure ITQ score is calculated
        $scoringService = new ItqScoringService();
        $itqResult      = $scoringService->generate((int) $victimId);

        if (! $itqResult) {
            return redirect()->to('/itq/form/' . $victimId)->with('error', 'Silakan isi form ITQ terlebih dahulu.');
        }

        // Fetch user reviewer name
        $db = \Config\Database::connect();
        $reviewer = $db->table('users')->where('id', $itqResult['reviewed_by'])->get()->getRowArray();
        $itqResult['reviewed_by_name'] = $reviewer['name'] ?? session()->get('user_name') ?? 'Psikolog Jaga';

        // Fetch existing Clinical Action if any
        $clinicalModel  = new ClinicalActionModel();
        $clinicalAction = $clinicalModel->getByVictimId((int) $victimId);

        $data = [
            'title'          => 'Hasil ITQ Assessment & Grafik — ' . $victim['nama'],
            'victim'         => $victim,
            'itqResult'      => $itqResult,
            'clinicalAction' => $clinicalAction,
        ];

        return view('psikolog/ItqResult', $data);
    }

    /**
     * JSON Endpoint API for Chart.js 4-Chart Visualization (SEGMEN 14)
     */
    public function getChartData($victimId)
    {
        $itqModel = new ItqAnswersModel();
        $answers  = $itqModel->getByVictimId((int) $victimId);

        $resultModel = new ItqResultModel();
        $result      = $resultModel->getByVictimId((int) $victimId);

        if (! $answers || ! $result) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data ITQ belum lengkap.']);
        }

        // Chart 1: PTSD vs DSO Scores
        $chart1 = [
            'ptsd_score' => (int) $result['ptsd_score'],
            'dso_score'  => (int) $result['dso_score'],
        ];

        // Chart 2: PTSD Clusters Average Scores
        $reexpAvg   = round(((int)$answers['item_1'] + (int)$answers['item_2']) / 2, 2);
        $avoidAvg   = round(((int)$answers['item_3'] + (int)$answers['item_4']) / 2, 2);
        $threatAvg  = round(((int)$answers['item_5'] + (int)$answers['item_6']) / 2, 2);
        $impairPtsd = round(((int)$answers['item_7'] + (int)$answers['item_8'] + (int)$answers['item_9']) / 3, 2);

        $chart2 = [
            'labels' => ['Re-experiencing', 'Avoidance', 'Sense of Threat', 'Functional Impairment'],
            'data'   => [$reexpAvg, $avoidAvg, $threatAvg, $impairPtsd],
        ];

        // Chart 3: DSO Clusters Average Scores
        $affectAvg  = round(((int)$answers['item_10'] + (int)$answers['item_11']) / 2, 2);
        $selfAvg    = round(((int)$answers['item_12'] + (int)$answers['item_13']) / 2, 2);
        $relAvg     = round(((int)$answers['item_14'] + (int)$answers['item_15']) / 2, 2);
        $impairDso  = round(((int)$answers['item_16'] + (int)$answers['item_17'] + (int)$answers['item_18']) / 3, 2);

        $chart3 = [
            'labels' => ['Affective Dysregulation', 'Negative Self-Concept', 'Relationships Disturbance', 'Functional Impairment'],
            'data'   => [$affectAvg, $selfAvg, $relAvg, $impairDso],
        ];

        // Chart 4: Longitudinal Line Chart
        $followupModel = new LongitudinalFollowupModel();
        $followups     = $followupModel->getFollowupsByVictim((int) $victimId);

        $chart4 = [
            'has_data' => ! empty($followups),
            'labels'   => array_column($followups, 'hari'),
            'ptsd'     => array_column($followups, 'ptsd_score'),
            'dso'      => array_column($followups, 'dso_score'),
        ];

        return $this->response->setJSON([
            'status' => 'success',
            'chart1' => $chart1,
            'chart2' => $chart2,
            'chart3' => $chart3,
            'chart4' => $chart4,
        ]);
    }
}
