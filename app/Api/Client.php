<?php

namespace App\Api;

use Core\Controller;
use Orhanerday\OpenAi\OpenAi;

class Client extends Controller
{
    private readonly OpenAi $openAi;

    public function __construct(
        private readonly Integration $integration,
    )
    {
        $this->openAi = new OpenAi($this->integration->getToken());
    }

    public function sendPrompt(array $messages, int $count = 1, string $activitiesJson = '') : array
    {
        $systemMessage = [
            'role' => 'system',
            'content' => "Jsi inteligentní asistent pro vyhledávání a doporučování vzdělávacích aktivit. Tvým úkolem je najít aktivity, které nejlépe odpovídají potřebám a preferencím uživatele na základě jeho dotazu.\n\n" .
                "Dostupné aktivity jsou poskytnuty ve formátu JSON. Každá aktivita má následující vlastnosti:\n" .
                "- uuid: unikátní identifikátor aktivity\n" .
                "- activityName: název aktivity\n" .
                "- description: popis aktivity\n" .
                "- objectives: cíle aktivity\n" .
                "- classStructure: velikost skupiny (Individual, Group, All)\n" .
                "- edLevel: úroveň vzdělání (primarySchool, secondarySchool, highSchool)\n" .
                "- lengthMin: minimální délka aktivity v minutách\n" .
                "- lengthMax: maximální délka aktivity v minutách\n" .
                "- tools: potřebné pomůcky a vybavení\n\n" .
                "Při vyhledávání aktivit zvaž následující faktory:\n" .
                "- Velikost skupiny (Individual, Group, All)\n" .
                "- Úroveň vzdělání (primarySchool, secondarySchool, highSchool)\n" .
                "- Délka aktivity (v minutách)\n" .
                "- Cíle a zaměření aktivity\n" .
                "- Potřebné pomůcky a vybavení\n\n" .
                "Vrať pole UUID aktivit, které nejlépe odpovídají uživatelskému dotazu. Je naprosto zásadní, abys vracel POUZE UUID, které jsou přítomny v poskytnutém JSON. Nevymýšlej si žádná nová UUID. Nepiš nic jiného, pouze pole existujících UUID.\n\n" .
                "Dostupné aktivity:\n" . $activitiesJson
        ];

        $userMessage = [
            'role' => 'user',
            'content' => "Uživatelský dotaz: " . $messages[0]['content']
        ];

        $response = $this->openAi->chat(
            [
                'model' => 'gpt-3.5-turbo',
                'messages' => [$systemMessage, $userMessage],
                'n' => $count,
            ]
        );

        $decoded = json_decode($response);

        $replies = [];

        foreach ($decoded->choices as $choice) {
            $reply = $choice->message->content;
            // Převede řetězec na pole UUID
            $uuids = json_decode($reply);
            if (json_last_error() === JSON_ERROR_NONE && is_array($uuids)) {
                $replies[] = $uuids;
            }
        }

        return $replies;
    }}
