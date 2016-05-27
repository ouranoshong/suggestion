<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 16-5-27
 * Time: 下午3:20
 */

namespace Ace\Suggestion\Contracts\Indexer;


interface SuggestionHandle
{
    public function saveSuggestion(Suggestion $Suggestion);

    public function deleteSuggestion(Suggestion $Suggestion);

    public function checkSuggestion(Suggestion $Suggestion);

    public function saveSuggestions($suggestions);
    
}