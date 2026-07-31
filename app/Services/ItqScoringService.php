<?php

namespace App\Services;

use App\Models\ItqAnswersModel;
use App\Models\ItqResultModel;

/**
 * Official ITQ (International Trauma Questionnaire) Scoring Engine
 * Implements Cloitre et al. ICD-11 diagnostic criteria algorithms for PTSD & DSO.
 */
class ItqScoringService
{
    /**
     * NOTE: This percentile and severity mapping is a local approximation for demo/prototype purposes.
     * It is NOT derived from an official normative study.
     * Please consult a qualified clinical psychologist or expert before deploying in real field operations.
     */
    private const SEVERITY_MAPPING = [
        0  => ['severity' => 'Minimal',     'percentile' => 5.00],
        1  => ['severity' => 'Minimal',     'percentile' => 10.00],
        2  => ['severity' => 'Minimal',     'percentile' => 18.00],
        3  => ['severity' => 'Mild',        'percentile' => 25.00],
        4  => ['severity' => 'Mild',        'percentile' => 32.00],
        5  => ['severity' => 'Mild',        'percentile' => 40.00],
        6  => ['severity' => 'Moderate',    'percentile' => 48.00],
        7  => ['severity' => 'Moderate',    'percentile' => 55.00],
        8  => ['severity' => 'Moderate',    'percentile' => 62.00],
        9  => ['severity' => 'Moderate',    'percentile' => 68.00],
        10 => ['severity' => 'Moderate',    'percentile' => 73.00],
        11 => ['severity' => 'Severe',      'percentile' => 78.00],
        12 => ['severity' => 'Severe',      'percentile' => 82.00],
        13 => ['severity' => 'Severe',      'percentile' => 86.00],
        14 => ['severity' => 'Severe',      'percentile' => 89.00],
        15 => ['severity' => 'Severe',      'percentile' => 92.00],
        16 => ['severity' => 'Very Severe', 'percentile' => 94.00],
        17 => ['severity' => 'Very Severe', 'percentile' => 95.50],
        18 => ['severity' => 'Very Severe', 'percentile' => 97.00],
        19 => ['severity' => 'Very Severe', 'percentile' => 98.00],
        20 => ['severity' => 'Very Severe', 'percentile' => 98.50],
        21 => ['severity' => 'Very Severe', 'percentile' => 99.00],
        22 => ['severity' => 'Very Severe', 'percentile' => 99.30],
        23 => ['severity' => 'Very Severe', 'percentile' => 99.70],
        24 => ['severity' => 'Very Severe', 'percentile' => 99.90],
    ];

    public function generate(int $victimId): ?array
    {
        $itqModel = new ItqAnswersModel();
        $answers  = $itqModel->getByVictimId($victimId);

        if (! $answers) {
            return null; // No ITQ answers recorded yet
        }

        // 1. PTSD Score (Items 1 - 6)
        $ptsdScore = (int)$answers['item_1'] + (int)$answers['item_2'] + 
                     (int)$answers['item_3'] + (int)$answers['item_4'] + 
                     (int)$answers['item_5'] + (int)$answers['item_6'];

        // 2. DSO Score (Items 10 - 15)
        $dsoScore  = (int)$answers['item_10'] + (int)$answers['item_11'] + 
                     (int)$answers['item_12'] + (int)$answers['item_13'] + 
                     (int)$answers['item_14'] + (int)$answers['item_15'];

        // 3. Functional Impairment
        $ptsdImpairment = ((int)$answers['item_7'] >= 2 || (int)$answers['item_8'] >= 2 || (int)$answers['item_9'] >= 2);
        $dsoImpairment  = ((int)$answers['item_16'] >= 2 || (int)$answers['item_17'] >= 2 || (int)$answers['item_18'] >= 2);

        // 4. Diagnostic Criteria Met
        $ptsdReexp  = ((int)$answers['item_1'] >= 2 || (int)$answers['item_2'] >= 2);
        $ptsdAvoid  = ((int)$answers['item_3'] >= 2 || (int)$answers['item_4'] >= 2);
        $ptsdThreat = ((int)$answers['item_5'] >= 2 || (int)$answers['item_6'] >= 2);
        $ptsdCriteriaMet = ($ptsdReexp && $ptsdAvoid && $ptsdThreat && $ptsdImpairment);

        $dsoAffect = ((int)$answers['item_10'] >= 2 || (int)$answers['item_11'] >= 2);
        $dsoSelf   = ((int)$answers['item_12'] >= 2 || (int)$answers['item_13'] >= 2);
        $dsoRel    = ((int)$answers['item_14'] >= 2 || (int)$answers['item_15'] >= 2);
        $dsoCriteriaMet  = ($dsoAffect && $dsoSelf && $dsoRel && $dsoImpairment);

        // 5. Severity & Percentile Mapping
        $ptsdMap = self::SEVERITY_MAPPING[min(24, max(0, $ptsdScore))];
        $dsoMap  = self::SEVERITY_MAPPING[min(24, max(0, $dsoScore))];

        // 6. Final Diagnosis
        if ($ptsdCriteriaMet && $dsoCriteriaMet) {
            $finalDiagnosis = 'Complex PTSD (CPTSD)';
        } elseif ($ptsdCriteriaMet) {
            $finalDiagnosis = 'PTSD';
        } else {
            $finalDiagnosis = 'No PTSD/CPTSD';
        }

        $reviewerName = session()->get('user_name') ?? 'Psikolog Jaga';

        // 7. Save/Update record in itq_result
        $resultModel = new ItqResultModel();
        $existing    = $resultModel->getByVictimId($victimId);

        $resultData = [
            'victim_id'         => $victimId,
            'ptsd_score'        => $ptsdScore,
            'ptsd_severity'     => $ptsdMap['severity'],
            'ptsd_percentile'   => $ptsdMap['percentile'],
            'ptsd_criteria_met' => $ptsdCriteriaMet ? true : false,
            'dso_score'         => $dsoScore,
            'dso_severity'      => $dsoMap['severity'],
            'dso_percentile'    => $dsoMap['percentile'],
            'dso_criteria_met'  => $dsoCriteriaMet ? true : false,
            'final_diagnosis'   => $finalDiagnosis,
            'reviewed_by'       => session()->get('user_id') ?? 4,
            'reviewed_at'       => date('Y-m-d H:i:s'),
        ];

        if ($existing) {
            $resultModel->update($existing['id'], $resultData);
        } else {
            $resultModel->insert($resultData);
        }

        return array_merge($resultData, [
            'reviewed_by_name' => $reviewerName,
        ]);
    }

    /**
     * Calculates detailed subscale scores, percentiles, descriptors, and criteria
     * for displaying the 3 tables (Overall, PTSD Symptoms, DSO Symptoms).
     */
    public function getDetailedSubScores(int $victimId): ?array
    {
        $itqModel = new ItqAnswersModel();
        // Get the latest answer
        $answers = $itqModel->where('victim_id', $victimId)->orderBy('created_at', 'DESC')->first();
        if (!$answers) return null;

        // Subscale raw scores
        $reexp = (int)$answers['item_1'] + (int)$answers['item_2'];
        $avoid = (int)$answers['item_3'] + (int)$answers['item_4'];
        $threat = (int)$answers['item_5'] + (int)$answers['item_6'];
        $ptsdImp = (int)$answers['item_7'] + (int)$answers['item_8'] + (int)$answers['item_9'];

        $affect = (int)$answers['item_10'] + (int)$answers['item_11'];
        $self = (int)$answers['item_12'] + (int)$answers['item_13'];
        $rel = (int)$answers['item_14'] + (int)$answers['item_15'];
        $dsoImp = (int)$answers['item_16'] + (int)$answers['item_17'] + (int)$answers['item_18'];

        $ptsdTotal = $reexp + $avoid + $threat + $ptsdImp; // Wait, total score is only items 1-6 for PTSD, and 10-15 for DSO based on generate() method!
        // In generate(): PTSD = 1-6. Impairment is NOT added to total score.
        $ptsdScore = $reexp + $avoid + $threat;
        $dsoScore = $affect + $self + $rel;

        // Approximated Percentile Mapping for Subscales (Max 8)
        $perc8 = [0=>5, 1=>18, 2=>40, 3=>55, 4=>73, 5=>82, 6=>89, 7=>95, 8=>99];
        $sev8 = [0=>'Minimal', 1=>'Minimal', 2=>'Mild', 3=>'Moderate', 4=>'Moderate', 5=>'Severe', 6=>'Severe', 7=>'Very Severe', 8=>'Very Severe'];

        // Approximated Percentile Mapping for Subscales (Max 12)
        $perc12 = [0=>5, 1=>10, 2=>25, 3=>40, 4=>50, 5=>60, 6=>73, 7=>80, 8=>86, 9=>92, 10=>95, 11=>97, 12=>99];
        $sev12 = [0=>'Minimal', 1=>'Minimal', 2=>'Mild', 3=>'Mild', 4=>'Moderate', 5=>'Moderate', 6=>'Severe', 7=>'Severe', 8=>'Severe', 9=>'Very Severe', 10=>'Very Severe', 11=>'Very Severe', 12=>'Very Severe'];

        $ptsdMap = self::SEVERITY_MAPPING[min(24, max(0, $ptsdScore))];
        $dsoMap  = self::SEVERITY_MAPPING[min(24, max(0, $dsoScore))];

        $ptsdCriteriaMet = (((int)$answers['item_1'] >= 2 || (int)$answers['item_2'] >= 2) && 
                            ((int)$answers['item_3'] >= 2 || (int)$answers['item_4'] >= 2) && 
                            ((int)$answers['item_5'] >= 2 || (int)$answers['item_6'] >= 2) && 
                            ((int)$answers['item_7'] >= 2 || (int)$answers['item_8'] >= 2 || (int)$answers['item_9'] >= 2));

        $dsoCriteriaMet = (((int)$answers['item_10'] >= 2 || (int)$answers['item_11'] >= 2) && 
                           ((int)$answers['item_12'] >= 2 || (int)$answers['item_13'] >= 2) && 
                           ((int)$answers['item_14'] >= 2 || (int)$answers['item_15'] >= 2) && 
                           ((int)$answers['item_16'] >= 2 || (int)$answers['item_17'] >= 2 || (int)$answers['item_18'] >= 2));

        return [
            'overall' => [
                'ptsd' => ['score' => $ptsdScore, 'percentile' => $ptsdMap['percentile'], 'severity' => $ptsdMap['severity'], 'criteria' => $ptsdCriteriaMet],
                'dso' => ['score' => $dsoScore, 'percentile' => $dsoMap['percentile'], 'severity' => $dsoMap['severity'], 'criteria' => $dsoCriteriaMet],
            ],
            'ptsd_symptoms' => [
                'reexp' => ['score' => $reexp, 'percentile' => $perc8[$reexp], 'severity' => $sev8[$reexp], 'present' => ((int)$answers['item_1'] >= 2 || (int)$answers['item_2'] >= 2)],
                'avoid' => ['score' => $avoid, 'percentile' => $perc8[$avoid], 'severity' => $sev8[$avoid], 'present' => ((int)$answers['item_3'] >= 2 || (int)$answers['item_4'] >= 2)],
                'threat' => ['score' => $threat, 'percentile' => $perc8[$threat], 'severity' => $sev8[$threat], 'present' => ((int)$answers['item_5'] >= 2 || (int)$answers['item_6'] >= 2)],
                'impairment' => ['score' => $ptsdImp, 'percentile' => $perc12[$ptsdImp], 'severity' => $sev12[$ptsdImp], 'present' => ((int)$answers['item_7'] >= 2 || (int)$answers['item_8'] >= 2 || (int)$answers['item_9'] >= 2)],
            ],
            'dso_symptoms' => [
                'affect' => ['score' => $affect, 'percentile' => $perc8[$affect], 'severity' => $sev8[$affect], 'present' => ((int)$answers['item_10'] >= 2 || (int)$answers['item_11'] >= 2)],
                'self' => ['score' => $self, 'percentile' => $perc8[$self], 'severity' => $sev8[$self], 'present' => ((int)$answers['item_12'] >= 2 || (int)$answers['item_13'] >= 2)],
                'rel' => ['score' => $rel, 'percentile' => $perc8[$rel], 'severity' => $sev8[$rel], 'present' => ((int)$answers['item_14'] >= 2 || (int)$answers['item_15'] >= 2)],
                'impairment' => ['score' => $dsoImp, 'percentile' => $perc12[$dsoImp], 'severity' => $sev12[$dsoImp], 'present' => ((int)$answers['item_16'] >= 2 || (int)$answers['item_17'] >= 2 || (int)$answers['item_18'] >= 2)],
            ]
        ];
    }
}
