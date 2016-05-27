<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 16-5-27
 * Time: 下午2:24
 */

namespace Ace\Suggestion\ESDriver;


trait SuggestionHandle
{
    public function saveSuggestion(Suggestion $Suggestion) {
        if (!$Suggestion->_id) return false;

        return $this->Client()->index(array_merge(
            $this->generateSuggestionHeader($Suggestion),
            ['body'=> $this->generateSuggestionBody($Suggestion)]
        ));

    }

    public function deleteSuggestion(Suggestion $Suggestion) {

        if (!$Suggestion->_id) return false;

        return $this->Client()->delete(
            $this->generateSuggestionHeader($Suggestion)
        );
    }

    public function checkSuggestion(Suggestion $Suggestion){
        return $this->Client()->exists($this->generateSuggestionHeader($Suggestion));
    }

    public function saveSuggestions($suggestions) {
        $params = [];
        /**@var $Suggestion Suggestion */
        foreach((array)$suggestions as $Suggestion) {
            if (!$Suggestion->_id) continue;

            $params['body'][] = [
                'index' => $this->generateSuggestionHeader($Suggestion, '_')
            ];

            $params['body'][] = $this->generateSuggestionBody($Suggestion);

        }
        if ($params) {
            return $this->Client()->bulk($params);
        }
        return false;
    }

    public function generateSuggestionHeader(Suggestion $Suggestion, $prefix='') {
        return [
            $prefix.'index'=> self::name(),
            $prefix.'type'=> $Suggestion->type,
            $prefix.'id'=> strval($Suggestion->_id),
        ];
    }

    public function generateSuggestionBody(Suggestion $Suggestion) {
        $suggest = [];

        if (!$Suggestion->name) return $suggest;

        $suggest['input'] = (array)$Suggestion->tags;
        $suggest['weight'] = $Suggestion->priority;

        if (mb_strlen($Suggestion->name, 'utf-8') <= 18) {
            $suggest['input'][] = $Suggestion->name;
        }

        $suggest['input'] = array_unique($suggest['input']);
        $suggest['output'] = $Suggestion->format ? $Suggestion->format : $Suggestion->name;
        $suggest['payload'] = ['id'=> strval($Suggestion->_id)];
        
        return [
            'name' => $Suggestion->name,
            'suggest'=> $suggest
        ];
    }

    public function getSuggestions($prefix) {
        $suggestions = [];
        if ($prefix) {
            $Client = $this->Client();
            $response = $Client->search([
                'index' => self::name(),
                'body' => [
                    'size'=> 0,
                    'suggest' => [
                        'search-suggest' => [
                            'text' => $prefix,
                            'completion' => [
                                'size'=> 9,
                                'field' => 'suggest',
//                                "fuzzy" => [
//                                    "fuzziness" => 'AUTO'
//                                ]
                            ]
                        ]
                    ]
                ]
            ]);

            if (isset($response['suggest']) && isset($response['suggest']['search-suggest'])) {
                foreach((array)$response['suggest']['search-suggest'][0]['options'] as $suggestion) {
                    $suggestions[] = $suggestion;
                }
            }
        }
        return $suggestions;
    }
}