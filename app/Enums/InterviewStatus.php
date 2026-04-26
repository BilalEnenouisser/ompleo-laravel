<?php

namespace App\Enums;

enum InterviewStatus: string
{
    case Programme  = 'programme';
    case Confirme   = 'confirme';
    case EnAttente  = 'en_attente';
    case Annule     = 'annule';
    case Termine    = 'termine';

    /**
     * Human-readable French label for display / notifications.
     */
    public function label(): string
    {
        return match($this) {
            self::Programme => 'Programmé',
            self::Confirme  => 'Confirmé',
            self::EnAttente => 'En attente',
            self::Annule    => 'Annulé',
            self::Termine   => 'Terminé',
        };
    }

    /**
     * Comma-separated list for use in Laravel validation rules.
     * e.g. 'required|in:' . InterviewStatus::validationRule()
     */
    public static function validationRule(): string
    {
        return implode(',', array_column(self::cases(), 'value'));
    }
}
